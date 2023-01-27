<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Agent;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;


class AgentDatatables extends LivewireDatatable
{
    public $model = Agent::class;

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function columns()
    {
        return [
            Column::name('matricule')
                ->label('Matricule'),

            Column::name('firstname')
                ->label('Name'),

            Column::name('phone')
                ->label('Phone'),

            Column::name('email')
                ->label('Email'),

            Column::callback(['id', 'firstname'], function ($id, $name) {
                return view('table-actions', ['id' => $id, 'firstname' => $name]);
            })->unsortable()
        ];
    }
}
