<div
    x-data
    @click="
        const clicked = $event.target
        const target = clicked.tagName.toLowerCase()

        const ignores = ['button', 'svg', 'path', 'a']

        if (! ignores.includes(target)) {
            clicked.closest('.idea-container').querySelector('.idea-link').click()
        }
    "
    class="idea-container hover:shadow-card transition duration-150 ease-in bg-white rounded-xl flex cursor-pointer"
>

    <div class="flex flex-col md:flex-row flex-1 px-2 py-6">
        <div class="flex-none mx-2 md:mx-0">

            @if ($idea->user->image==null)
                <a href="#">
                    <img src="{{ asset('img/user_anonym.png') }}" alt="avatar" class="w-10 h-10 rounded-full">
                </a>

            @else

                <a href="#">
                    <img src="{{ asset('storage/Profil/'.$idea->user->image) }}" alt="avatar" class="w-10 h-10 rounded-full">
                </a>
            @endif

        </div>

        <div class="w-full flex flex-col justify-between mx-2 md:mx-4">
            <h4 class="text-xl font-serif font-semibold pb-6 mt-2 md:mt-0">
                <a href="{{ route('idea.show', $idea) }}" class="idea-link hover:underline"><span>{{ $idea->user->name }}</span></span></a>
            </h4>
            <div>
                <strong class="text-lg font-semibold mt-2 md:mt-0">
                    <a href="{{ route('idea.show', $idea) }}" class="idea-link hover:underline">{{ $idea->title }}</a>
                </strong>
            </div>
            <div class="text-gray-600 mt-3 line-clamp-3">
                @admin
                    @if ($idea->spam_reports > 0)
                        <div class="text-red mb-2">Spam Anzahl: {{ $idea->spam_reports }}</div>
                    @endif
                @endadmin
                {{ $idea->description }}
            </div>
            <div class="pt-6">
                @if ($images!= null)
                    <div class=" flex w-11/12 h-64 bg-gray-100 shadow-md  rounded-2xl ">

                            <div class="w-3/5 h-full pr-2 ">
                                @foreach ($imagesList as $image )

                                    <div class="flex">
                                        @if ($loop->first)
                                            <div class="">
                                                <img src="{{ asset('storage/'.$image) }}" alt="avatar" class="w-screen rounded-l-2xl h-64">
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <div class="grid grid-rows-2 w-2/5  h-full  ">
                                @foreach ($imagesList as $image )

                                    <div class="flex relative">
                                        @if ($loop->iteration == 2 )
                                            <div class="">
                                                <img src="{{ asset('storage/'.$image) }}" alt="avatar" class="absolute inset-x-0 bottom-0 pb-1 rounded-tr-2xl w-screen h-32  ">
                                            </div>
                                        @elseif ($loop->iteration == 3)
                                            <div class="">
                                                <img src="{{ asset('storage/'.$image) }}" alt="avatar" class="w-screen h-32 rounded-br-2xl pt-1 ">
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>


                    </div>
                @endif
            </div>

            <div class="flex flex-col md:flex-row md:items-center sm:flex justify-between ">
                <div class="flex md:flex">
                    <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2 mr-8 mt-8">
                        <div class="text-center">
                            <div class="font-semibold text-2xl @if ($hasVoted) text-violetC @endif">{{ $votesCount }}</div>
                        </div>
                        <div >
                            @if ($hasVoted)
                                <button wire:click.prevent="vote" style="" class=" " >
                                    <svg xmlns="http://www.w3.org/2000/svg" class=" border-none h-10 w-10 " style="color: #7c57b4"  viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                      </svg>
                                </button>

                                @else
                                <button wire:click.prevent="vote" >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="border-none h-8 w-8  " style="color: #7c57b4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </button>
                            @endif
                        </div>





                    </div>
                    <div
                        x-data="{ isOpen: false }"
                        class="flex  items-center space-x-2 mt-8
                        :mt-0"
                    >
                        <div>{{ $idea->created_at->diffForHumans() }}</div>
                        <div>&bull;</div>
                        <div wire:ignore class="text-gray-900">{{ $idea->comments_count }} Kommentare</div>
                    </div>
                </div>
                <div>
                    <div>
                        @auth
                            @if ($idea->user->id!=auth()->user()->id)
                                <button class=" ">
                                    @php
                                        $conversationId= md5(rand(10,50).auth()->user()->id.$idea->user)
                                    @endphp
                                    {{-- {{}} --}}
                                    <a href="{{route('chat.show',[$idea->user, $idea->id,$conversationId])}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" style="color: #7c57b4" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z" />
                                            <path d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z" />
                                        </svg>
                                    </a>
                                </button>
                            @endif
                        @else
                            <button class=" ">
                                <a href="{{ route('login') }}" >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" style="color: #7c57b4" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z" />
                                        <path d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z" />
                                    </svg>
                                </a>
                            </button>
                        @endauth

                    </div>

                </div>



            </div>
        </div>

    </div>

</div>

