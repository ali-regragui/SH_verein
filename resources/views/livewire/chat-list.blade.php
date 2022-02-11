
<div class="w-full  ">
    <div class="flex">
        <div class="w-full h-14 flex bg-gray-200 pt-4 pl-8 ">
            <h4 class="text-xl font-serif font-semibold ">
                Nachrichten
            </h4>

            <div class="pl-3 pt-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" style="color: #7c57b4" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z" />
                    <path d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z" />
                </svg>
            </div>

        </div>
    </div>
    <div class=" flex flex-col  bg-white   rounded p-5 mx-auto ">

        <!-- Items -->
        @foreach ($conversations->reverse() as $conversation)

            @if ($conversation->fromUser!= auth()->user()->id)
                <a href="{{route('chat.show',[$conversation->idea->user, $conversation->idea->id,$conversation->roomId])}}" class="  odd:bg-gray-50 flex gap-3 items-center font-semibold text-gray-800 p-3 hover:bg-gray-100  border-b rounded-md hover:cursor-pointer">

                    @if ($conversation->sender->image == null or $conversation->sender->image=='' )

                        <img src="{{ asset('img/user_anonym.png') }}" alt="avatar" class="w-10 h-10 rounded-full">


                    @else

                        <img src="{{ asset('storage/Profil/'.$conversation->sender->image) }}" alt="avatar" class="w-10 h-10 rounded-full">

                    @endif
                    <div class="flex flex-col">

                            <div>
                                {{$conversation->sender->name}}
                            </div>
                            <div class="text-gray-600 text-sm font-normal">
                                {{$conversation->idea->title}}
                            </div>



                    </div>
                </a>
            @elseif ($conversation->toUser!= auth()->user()->id)
                <a href="{{route('chat.show',[$conversation->idea->user, $conversation->idea->id ,$conversation->roomId])}}" class="odd:bg-gray-50 flex gap-3 items-center font-semibold text-gray-800 p-3 hover:bg-gray-100  border-b rounded-md hover:cursor-pointer">



                    @if ($conversation->receiver->image == null or $conversation->receiver->image=='' )

                        <img src="{{ asset('img/user_anonym.png') }}" alt="avatar" class="w-10 h-10 rounded-full">


                    @else

                        <img src="{{ asset('storage/Profil/'.$conversation->receiver->image) }}" alt="avatar" class="w-10 h-10 rounded-full">

                    @endif
                    <div class="flex flex-col">

                            <div>
                                {{$conversation->receiver->name}}
                            </div>
                            <div class="text-gray-600 text-sm font-normal">
                                {{$conversation->idea->title}}
                            </div>



                    </div>
                </a>
            @endif
        @endforeach





    </div>
</div>

{{-- <div class="w-full text-center pt-10">
    <a class="font-bold bg-indigo-500 shadow-lg text-white p-5 rounded-md hover:bg-indigo-600 active:bg-indigo-700" href="https://www.instagram.com/uibox.one/" target="_blank">
     Follow me please
    </a>
</div> --}}
