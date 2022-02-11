<?php

namespace App\Http\Livewire;


use App\Models\User;
use App\Models\Chat;
use App\Models\Idea;
use Livewire\Component;

class ShowMessages extends Component
{

    public $messages;
    public $message;
    public $user;
    public $fromUser;
    public $toUser;
    public $roomId;
    public $msg;
    public $data;
    public $idea;
    public $infos;

    public function getListeners(){
        return [
            "sendMessage"=>'addMessage',
           
        ];
    }
 
    public function mount(User $user, Chat $chat, $chatRoom , Idea $idea){
        $this->user = $user;
        $this->fromUser= auth()->user();
        $this->roomId= $chat->roomId;
        $this->data= Chat::all();
        $this->idea =$idea;
        $this->msg= $chatRoom;
        
        $this->infos= Chat::where('roomId',$chatRoom->roomId)->first();
        $this->messages = Chat::where('roomId',$chatRoom->roomId)->orderBy('created_at','desc')->take(8)->get()->reverse();;
        

    }
    public function addMessage($messageId,$roomId,$sender,$receiver){
        $this->messages->prepend(Chat::find($messageId));
        $this->messages = Chat::where('roomId',$roomId)->orderBy('created_at','desc')->take(8)->get()->reverse();
        
        $fromUser1= Chat::where('fromUser',$sender)->where('toUser',$receiver)->get();
        
        
        foreach($fromUser1 as $user1){
            $con =$user1::get()->contains('fromUser','=',auth()->user()->id);
        }
        


    }

    public function render()
    {
        
        return view('livewire.show-messages');
    }
}
