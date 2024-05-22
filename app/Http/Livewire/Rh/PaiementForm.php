<?php

namespace App\Http\Livewire\Rh;

use App\Models\PayementAgent;
use App\Models\Taux;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class PaiementForm extends Component
{
    public $state = [];

    public function submit()
    {
        Validator::make($this->state, [
            'type' => ['required', 'string', 'max:255'],
            'month' => ['required', 'string', 'max:255'],
        ])->validate();

			$reference = 'PYMT-AG-'.$this->state['month'].''.Auth::user()->id.''.rand(100000,999999);
		$taux = Taux::firstWhere('active',true)->get();
        PayementAgent::create([
            'reference' => $reference,
            'month' => $this->state['month'],
            'type' => $this->state['type'],
			'taux' => $taux[0]->id,
            'signature' => Auth::user()->id,
        ]);

        $this->reset('state');
        $this->dispatchBrowserEvent('formSuccess');
        $this->emit('paieAUpdated');
    }

    public function render()
    {
        return view('livewire.rh.paiement-form');
    }
}
