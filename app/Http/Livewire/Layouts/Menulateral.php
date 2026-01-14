<?php

namespace App\Http\Livewire\Layouts;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Menulateral extends Component
{
    public $canAccess=[];
    public $roleLabel;

    public function mount()
    {
        /** Add table permission to replace the menu and make it easier to add user to access a feature or not */
        // $this->canAccess = Auth::user()->getAllPermissions()->pluck('name')->toArray();
        $this->roleLabel = getUserRole();
    }

    public function render()
    {

        return view('livewire.layouts.menulateral');
    }
}
