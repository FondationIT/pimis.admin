<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{
   
    public function render()
    {
        return view('livewire.chat.index');
    }
}
