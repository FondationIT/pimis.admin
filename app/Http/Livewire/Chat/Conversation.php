<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation as ModelsConversation;
use App\Models\Fournisseur;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Conversation extends Component
{
    public $query;
    public $jobs = [];
    public $modelId;
    public $selectedIndex = 0;

    protected $listeners = ['sent' => '$refresh'];

    public function userConv($id){

        $this->modelId = $id;
        $this->emit('userConvMess',$this->modelId );
    }

    public function incrementIndex()
    {
        if ($this->selectedIndex === (count($this->jobs) - 1))
        {
            $this->selectedIndex = 0;
            return;
        }

        $this->selectedIndex++;
    }

    

    public function decrementIndex()
    {
        if ($this->selectedIndex === 0)
        {
            $this->selectedIndex = count($this->jobs) - 1;
            return;
        }

        $this->selectedIndex--;
    }

    public function resetIndex()
    {
        $this->reset('selectedIndex');
    }

    public function nullSearch(){
        $this->query = null;
    }
    
    public function render()
    {
        return view('livewire.chat.conversation', [
            'conversation' => 

            ModelsConversation::where(function ($q) {
                $q->where('to', Auth::user()->id)
                    ->orWhere('from', Auth::user()->id);
                })->get()->toArray()
        ]);
    }

    public function updatedQuery()
    {
        $this->resetIndex();
        
        $words = '%' . $this->query . '%';

        if (strlen($this->query) >= 1) {
            $this->jobs = User::where('name', 'like', $words)->get()->toArray();
        }
    }
    
}
