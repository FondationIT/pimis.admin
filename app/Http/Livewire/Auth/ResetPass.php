<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ResetPass extends Component
{
    public $state = [];
    public function submit()
    {
        Validator::make($this->state, [
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ])->validate();

        DB::beginTransaction(8);

        try {
            User::find(Auth::user()->id)->update([
                'password' => Hash::make($this->state['password']),
            ]);

            DB::commit();
            $this->reset('state');
        } catch (\Throwable $th) {
            DB::rollBack();
        }
        
        
    }

    public function render()
    {
        return view('livewire.auth.reset-pass');
    }
}
