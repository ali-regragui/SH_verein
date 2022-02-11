
  <div  >

    <div class="">
        <div class="w-full h-14 flex  bg-gray-200 pt-4 pl-8 ">
            <div class="basis-1/12 bg-">

                @if ($infos->fromUser != auth()->user()->id)
                    <h4 class="text-xl font-serif font-semibold ">
                        {{$infos->sender->name}}
                    </h4>

                @elseif ($infos->toUser != auth()->user()->id)

                    <h4 class="text-xl font-serif font-bold ">
                        {{$infos->receiver->name}}
                    </h4>
                    @endif
            </div>
            <div class="w-11/12 flex justify-end ">
                <h6 class="text-xl font-semibold ">{{$infos->idea->title}}</h6>
            </div>
        </div>
    </div>
    <div class="overflow-y bg-white p-8">

        @foreach ($messages as $message)
            @if ($message->body != null)
                @if ($message->fromUser === auth()->user()->id)


                    <div class="max-w-4xl mx-auto py-1 flex relative flex-row-reverse ">


                        <div class="flex flex-col ">
                            @if (auth()->user()->image == null)
                                <a href="#">
                                    <img src="{{ asset('img/user_anonym.png') }}" alt="avatar" class="w-10 h-10 rounded-full">

                                </a>
                                <p class="text-center">{{auth()->user()->name}}</p>

                            @else
                                <a href="#">
                                    <img src="{{ asset('storage/Profil/'.auth()->user()->image) }}" alt="avatar" class="w-10 h-10 rounded-full">
                                </a>
                                <p class="text-center">{{auth()->user()->name}}</p>

                            @endif
                        </div>
                        <div class="pr-2 text-right">
                            <div class=" text-green-900 p-5 rounded-2xl rounded-tr-none" style="background-color: rgb(187 247 208)">
                                <p>{{$message->body}}</p>
                            </div>
                        </div>
                    </div>


                @elseif ($message->fromUser != auth()->user()->id)

                    <div class="max-w-4xl mx-auto py-1 flex flex-row ">
                        <div class=" flex flex-col mx-2">
                            @if ($message->sender->image == null or $message->sender->id=='' )
                                <a href="#">
                                    <img src="{{ asset('img/user_anonym.png') }}" alt="avatar" class="w-10 h-10 rounded-full">
                                </a>
                                <p class="text-center">{{$message->sender->name}}</p>
                            @else
                                <a href="#">
                                    <img src="{{ asset('storage/Profil/'.$message->sender->image) }}" alt="avatar" class="w-10 h-10 rounded-full">
                                </a>
                                <p class="text-center">{{$message->sender->name}}</p>
                            @endif
                        </div>

                            <div class="">
                                <div class="bg-gray-100  p-5 rounded-2xl rounded-tl-none">
                                    <p>{{$message->body}}</p>
                                </div>
                            </div>

                    </div>

                @endif


            @endif

        @endforeach



    </div>
</div>
