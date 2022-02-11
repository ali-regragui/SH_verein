@extends('layouts.app')
@section('testB')
    
    <div class="flex  flex-row shadow-xl border-2 rounded-xl lg:w-10/12 h-5/6 md:w-11/12 w-9/12" >
        @if (\Route::current()->getName()== 'chat.view')
            <div class=" h-full bg-white shadow-lg  lg:w-1/3  md:w-1/2 w-2/6">
                <livewire:chat-list  />
            </div>
            
        @elseif (\Route::current()->getName()== 'chat.show')
            <div class="  h-full bg-white shadow-lg lg:w-1/3  md:w-1/2 w-2/6">
                <livewire:chat-list  />
            </div>
            <div class="border-l-2 border-gray-300 w-2/3  " >   
                <div class="w-full h-90p  bg-white">
                    <livewire:show-messages :idea="$idea" :chatRoom="$chatRoom"  :user="$user" />
                </div>
                <div class="w-full h-10p bg-gray-200" >
                    <livewire:send-message :idea="$idea" :chatRoom="$chatRoom" :user="$user" />
                </div>
            
            </div>
            
        @endif
    </div>
    

  
<script>

    addEventListener('DOMContentLoaded', function() {

        Echo.channel('msg')
            .listen('ChatEvent', (e) => {
                
                livewire.emit('sendMessage',e.message.id,e.message.roomId,e.message.fromUser,e.message.toUser )
                console.log(e.message);
                


            });


    })

</script>
@endsection