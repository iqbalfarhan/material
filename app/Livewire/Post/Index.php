<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.post.index', [
            'datas' => Post::get()
        ]);
    }
}