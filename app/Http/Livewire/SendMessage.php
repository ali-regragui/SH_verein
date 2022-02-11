<?php

namespace App\Http\Livewire;

use App\Events\ChatEvent;
use App\Models\User;
use App\Models\Idea;
use App\Models\Chat;

use Livewire\Component;

class SendMessage extends Component
{
    public $text;
    public $user;
    public $fromUser;
    public $toUser;
    public $roomId;
   
    public $idea;

    protected $rules = [
        'text' => 'required|min:1',
    ];
    public function mount(User $user,Idea $idea, Chat $chat,$chatRoom){
        $this->user = $user;
        $this->fromUser= auth()->user();
        $this->roomId= $chatRoom->roomId;
        $this->idea= $idea->id;
    }
    
    public function listeners(){
        return [
            'sendMessage'=>'$refresh',
        ];

    }

    public function send(){

        $this->validate();
        $newMassage= New Chat;
        $newMassage->roomId =$this->roomId;
        $newMassage->ideaId =$this->idea;
        $newMassage->fromUser= $this->fromUser->id;
        $newMassage->toUser= $this->user->id;
        $newMassage->body= $this->text;
        $newMassage->save();
        event(new ChatEvent($newMassage));


        $this->emit('AddMessage',$newMassage);
        $this->text = '';
        
    }
    public function render()
    {
        return view('livewire.send-message');
    }
}
