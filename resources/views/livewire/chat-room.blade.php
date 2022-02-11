<div>


    <div>{{$user->name}}</div>
    <div class="w-10/12 h-175 bg-white">
        <div>
            @foreach ($messages as $message)
                <p>{{$message->body}}</p>
            @endforeach
        </div>
    </div>
    <div>
        <form action="" class="flex">
            <textarea wire:model.defer="message" name="" id="" cols="80" rows="5"></textarea>
            <button wire:click.prevent="send">send</button>
        </form>
    </div>
   {{$user->name}}
</div>
