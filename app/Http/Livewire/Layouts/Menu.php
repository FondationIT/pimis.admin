<?php

namespace App\Http\Livewire\Layouts;

use Livewire\Component;

class Menu extends Component
{
    protected $listeners = ['refreshMenu' => '$refresh'];
    public function render()
    {
        return view('livewire.layouts.menu');
    }
}
