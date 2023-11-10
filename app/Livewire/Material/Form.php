<?php

namespace App\Livewire\Material;

use App\Models\Material;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads, LivewireAlert;

    public $material;
    public $title;
    public $material_id;
    public $description;
    public $url;
    public $thumbnail;
    public $tags;

    public function simpan()
    {
        $valid = $this->validate([
            "title" => "required",
            "description" => "required",
            "url" => "required",
            "tags" => "required",
        ]);

        $valid['tags'] = array_map('trim', explode(',', $this->tags));

        if ($this->thumbnail) {
            $filename = $this->thumbnail->hashName('user');
            $image = Image::make($this->thumbnail)->fit(500)->encode('jpg', 100);

            Storage::put($filename, $image);

            $valid['thumbnail'] = $filename;
        }

        if ($this->material) {
            $this->material->update($valid);
            $this->flash('success', "Berhasil menambahkan material");
            return redirect()->route('material.show', $this->material->id);
        } else {
            $material = Material::create($valid);
            $this->flash('success', "Berhasil menambahkan material");
            return redirect()->route('material.show', $material->id);
        }


    }

    public function mount()
    {
        if ($this->material) {
            $this->material = Material::find($this->material);

            $this->title = $this->material->title;
            $this->description = $this->material->description;
            $this->url = $this->material->url;

            if ($this->material->tags) {
                $this->tags = implode(', ', $this->material->tags);
            }
        }
    }


    public function render()
    {
        return view('livewire.material.form');
    }
}
