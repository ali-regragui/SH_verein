<?php

namespace App\Http\Livewire;
use App\Events\ChatEvent;
use App\Models\User;
use App\Models\Chat;
use Livewire\Component;

class ChatRoom extends Component
{
    public $message;
    public $user;
    public $fromUser;
    public $toUser;
    public $roomId;
    public $messages;


    public function mount(User $user, Chat $chat){
        $this->user = $user;
        $this->fromUser= auth()->user();
        $this->roomId= $chat->roomId;
        $this->messages = Chat::all();






    }

    public function listeners(){
        return [
            'sendMessage'=>'$refresh',
            // "echo:msg:,ChatEvent"=>'showMsg',


        ];

    }

    public function send(){



        $isChatRoomExists = Chat::where('fromUser',$this->fromUser->id)->where('toUser',$this->user->id)->exists();
        $getChatRoom = Chat::where('fromUser',$this->fromUser->id)->where('toUser',$this->user->id)->first();

        if(!$isChatRoomExists){
           $newRoomId= md5(rand(10,50).$this->fromUser->id.$this->user->id);
           $newMassage= New Chat;
            $newMassage->roomId =$newRoomId;
            $newMassage->fromUser= $this->fromUser->id;
            $newMassage->toUser= $this->user->id;
            $newMassage->body= $this->message;
            $newMassage->save();


        }else{
            $newMassage= New Chat;
            $newMassage->roomId =$getChatRoom->roomId;
            $newMassage->fromUser= $this->fromUser->id;
            $newMassage->toUser= $this->user->id;
            $newMassage->body= $this->message;
            $newMassage->save();
            // dd($getChatRoom->roomId);
        }
        // dd($newMassage->fromUser);
        event(new ChatEvent($newMassage));
        $chatitems=Chat::all();
        $this->emit('AddMessage',$newMassage->id);
        $this->message = '';
        // dump($chatitems);
        // $this->emit('sendMessage');
        // dd($this->message);
    }
    public function showMsg(){
        dd('fff');
    }
    public function render()
    {
        return view('livewire.chat-room');
    }
}
