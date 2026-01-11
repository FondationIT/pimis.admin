<?php

namespace App\Http\Livewire\Layouts;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Menulateral extends Component
{
    
    public $roleLabel;

    public function mount()
    {
        $this->roleLabel = getUserRole();
    }

    public function render()
    {

        return view('livewire.layouts.menulateral');
    }
}
