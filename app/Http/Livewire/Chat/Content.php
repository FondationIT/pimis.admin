<?php

namespace App\Http\Livewire\Chat;

use App\Http\Livewire\Chat\Conversation as ChatConversation;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Carbon\Carbon;

class Content extends Component
{
    public $message;
    public $user;
    public $conversation;
    public $content =[];
    protected $listeners = ['sent' => '$refresh','userConvMess'];

    

    public function userConvMess($id){

        $this->user = User::where('id', $id)->get();
        $this->content = [];
        if($this->user[0]){

            if(Conversation::where(function ($query) {
                $query->where('from', Auth::user()->id)
                    ->where('to', $this->user[0]->id);
            })->orWhere(function ($query) {
                $query->where('from', $this->user[0]->id)
                    ->where('to', Auth::user()->id);
            })->exists())
            {

                $this->conversation = Conversation::where(function ($query) {
                    $query->where('from', Auth::user()->id)
                        ->where('to', $this->user[0]->id);
                })->orWhere(function ($query) {
                    $query->where('from', $this->user[0]->id)
                        ->where('to', Auth::user()->id);
                });

                $this->conversation = $this->conversation->get();
                $this->content = Message::where('conversation_id',$this->conversation[0]->id)->get();
            }
        
        }

    }

    public function sendMessage()
    {
        if($this->checkSpam()) {

            $this->conversation = Conversation::where(function ($query) {
                $query->where('from', '=', auth()->user()->id)
                      ->where('to', '=', $this->user);
            })->orWhere(function ($query) {
                $query->where('from', '=', $this->user)
                      ->where('to', '=', auth()->user()->id);
            })->get();

            if(Conversation::where('from', Auth::user()->id)->where('to', $this->user[0]->id)->exists() || Conversation::where('from', $this->user[0]->id)->where('to', Auth::user()->id)->exists())
            {


                $this->conversation = Conversation::where(function ($query) {
                    $query->where('from', Auth::user()->id)
                          ->where('to', $this->user[0]->id);
                })->orWhere(function ($query) {
                    $query->where('from', $this->user[0]->id)
                          ->where('to', Auth::user()->id);
                })->get();

                Message::create([
                    'user_id' => Auth::user()->id,
                    'conversation_id' => $this->conversation[0]->id,
                    'content' => $this->message
                ]);
            }else{
                
                Conversation::create([
                    'from' => Auth::user()->id,
                    'to' => $this->user[0]->id
                ]);

                $this->conversation = Conversation::where('from', Auth::user()->id)->where('to', $this->user[0]->id)->get();

                Message::create([
                    'user_id' => Auth::user()->id,
                    'conversation_id' => $this->conversation[0]->id,
                    'content' => $this->message
                ]);
            }
    
            $this->message = '';
            $this->content = Message::where('conversation_id',$this->conversation[0]->id)->get();
            $this->emit('sent');
        }
        
    }

    private function checkSpam()
    {
        $response = Message::whereBetween('created_at', [\Carbon\Carbon::now()->subMinutes(0.1)->toDateTimeString(), \Carbon\Carbon::now()])->where('user_id', auth()->user()->id)->get();
        
        if (!$response->isEmpty()) {
            $this->emit('flash-message', 'Vous ne pouvez pas poster plus d\'un message par minute', 'warning');
            return false;
        } else {
            return true;
        }
    }

    public function render()
    {
        return view('livewire.chat.content');
    }
}
