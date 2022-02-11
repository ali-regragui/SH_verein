<?php

namespace App\Http\Livewire;


use App\Models\User;
use App\Models\Idea;
use Illuminate\Support\Facades\DB;
use App\Models\Chat;
use Livewire\Component;

class ChatList extends Component
{
    
    public $message;
    public $user;
    public $fromUser;
    public $toUser;
    public $roomId;
    public $messages;
    public $idea;
    public $conversations;


    public function mount(){
        
        $this->fromUser= auth()->user();
        
        $this->conversations = Chat::with('idea')->with('sender')->with('receiver')->where('fromUser',$this->fromUser->id)
            ->OrWhere('toUser',$this->fromUser->id)
            ->get()->unique('roomId');
            $test = Chat::where('fromUser',$this->fromUser->id)
            ->OrWhere('toUser',$this->fromUser->id)
            ->first()->orderBy('created_at','Desc');
        
    }
    public function render()
    {
        return view('livewire.chat-list');
    }
}
