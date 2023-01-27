<?php

namespace App\Http\Livewire\Pimis;
use App\Models\User;

use Livewire\Component;

class UsersTable extends Component
{

    protected $listeners = [
        'allUpdated'=> '$refresh'
    ];

    public function render()
    {
        return view('livewire.pimis.users-table',[
            'users' => User::where("active", "1")->orderBy("id", "DESC")->paginate(3),
        ]);
    }
}
