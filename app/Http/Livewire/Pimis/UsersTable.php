<?php

namespace App\Http\Livewire\Pimis;
use App\Models\User;

use Livewire\Component;

use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class UsersTable extends LivewireDatatable
{

    public $model = User::class;
    public $modelId;

    protected $listeners = [
        'usersUpdated'=> '$refresh'
    ];

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function edit($modelId){
        $this->modelId = $modelId;
        $this->emit('editUser',$this->modelId );
    }
    public function deleteUser($modelId){
        $this->modelId = $modelId;
        User::find($this->modelId)->update([
            'active' => 0,
        ]);
    }

    public function restoreUser($modelId){
        $this->modelId = $modelId;
        User::find($this->modelId)->update([
            'active' => 1,
        ]);
    }

    public function columns()
    {
        return [
            Column::name('name')
                ->label('Name'),

            Column::name('email')
                ->label('Username'),

            Column::name('role')
                ->label('Role'),

            BooleanColumn::name('active')
                ->label('State'),

            Column::callback(['id', 'name','role','active'], function ($id, $name,$role,$active) {

                $delete = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="deleteUser(' . $id . ')"><i class="icon-trash txt-danger"></i></a>';
                $edit = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600 rounded" wire:click="edit(' . $id . ')" data-toggle="modal" data-target="#nUserModalForms"><i class="icon-pencil"></i></a>';
                if ($role == 'Sup') {
                    $delete = '<span>Is the sper user</span>';
                    $edit = '';
                }elseif ($active == false) {
                    $delete = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="restoreUser(' . $id . ')"><i class="icon-action-undo txt-danger"></i></a>';
                }
                    return '<div class="flex space-x-1 justify-around">'.$edit . $delete .'</div>';
            })->unsortable(),


        ];
    }
}
