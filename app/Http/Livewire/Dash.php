<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Dash extends Component
{
    public $unreadCount = 0;

    protected $listeners = [
        'dashUpdated' => '$refresh',
        'unreadCountResponse'
    ];

    public function getUnread()
    {
        $this->emit('requestUnreadCount');
    }

    public function unreadCountResponse($count)
    {
        $this->unreadCount = $count;
    }

    public function render()
    {
        return view('livewire.dash');
    }
}
