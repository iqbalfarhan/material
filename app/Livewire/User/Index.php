<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public function delete(User $user)
    {
        $user->delete();
    }

    public function render()
    {
        return view('livewire.user.index', [
            'datas' => User::get()
        ]);
    }
}
