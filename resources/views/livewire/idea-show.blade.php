<div class="idea-and-buttons container">

    <div class="idea-container bg-white rounded-xl flex mt-4">
        <div class="flex flex-col md:flex-row flex-1 px-4 py-6">
            <div class="flex-none mx-2">
                @if ($idea->user->image == null)
                <a href="#">
                    <img src="{{ asset('img/user_anonym.png') }}" alt="avatar" class="w-10 h-10 rounded-full">
                </a>

                @else
                    <a href="#">
                        <img src="{{ asset('storage/Profil/'.$idea->user->image) }}" alt="avatar" class="w-10 h-10 rounded-full">
                    </a>

                @endif
            </div>
            <div class="w-full mx-2 md:mx-4">
                <h4 class="text-xl font-semibold mt-2 md:mt-0">
                    {{ $idea->title }}
                </h4>
                <div class="text-gray-600 mt-3">
                    @admin
                        @if ($idea->spam_reports > 0)
                            <div class="text-red mb-2">Spam Anzahl: {{ $idea->spam_reports }}</div>
                        @endif
                    @endadmin
                    {!! nl2br(e($idea->description)) !!}
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

                <div class="flex flex-col md:flex-row md:items-center justify-between mt-6">
                    <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                        <div class="hidden md:block font-bold text-gray-900">{{ $idea->user->name }}</div>
                        <div class="hidden md:block">&bull;</div>
                        <div>{{ $idea->created_at->diffForHumans() }}</div>

                        <div>&bull;</div>
                        <div class="text-gray-900">{{ $idea->comments()->count() }} Kommentare</div>
                    </div>
                    <div
                        class="flex items-center space-x-2 mt-4 md:mt-0"
                        x-data="{ isOpen: false }"
                    >

                        @auth
                        <div class="relative">
                            <button
                                class="relative bg-gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in py-2 px-3"
                                @click="isOpen = !isOpen"
                            >
                                <svg fill="currentColor" width="24" height="6"><path d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)"></svg>
                            </button>
                            <ul
                                class="absolute w-44 text-left font-semibold bg-white shadow-dialog rounded-xl z-10 py-3 md:ml-8 top-8 md:top-6 right-0 md:left-0"
                                x-cloak
                                x-show.transition.origin.top.left="isOpen"
                                @click.away="isOpen = false"
                                @keydown.escape.window="isOpen = false"
                            >
                                @can('update', $idea)
                                <li>
                                    <a
                                        href="#"
                                        @click.prevent="
                                            isOpen = false
                                            $dispatch('custom-show-edit-modal')
                                        "
                                        class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3"
                                    >
                                        Beitrag bearbeiten
                                    </a>
                                </li>
                                @endcan

                                @can('delete', $idea)
                                <li>
                                    <a
                                        href="#"
                                        @click.prevent="
                                            isOpen = false
                                            $dispatch('custom-show-delete-modal')
                                        "
                                        class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3"
                                    >
                                        Beitrag Löschen
                                    </a>
                                </li>
                                @endcan

                                <li>
                                    <a
                                        href="#"
                                        @click.prevent="
                                            isOpen = false
                                            $dispatch('custom-show-mark-idea-as-spam-modal')
                                        "
                                        class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3"
                                    >
                                        Beitrag Melden
                                    </a>
                                </li>

                                @admin
                                    @if ($idea->spam_reports > 0)
                                    <li>
                                        <a
                                            href="#"
                                            @click.prevent="
                                                isOpen = false
                                                $dispatch('custom-show-mark-idea-as-not-spam-modal')
                                            "
                                            class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3"
                                        >
                                             Meldung Löschen
                                        </a>
                                    </li>
                                    @endif
                                @endadmin
                            </ul>
                        </div>
                        @endauth
                    </div>

                    <div class="flex items-center md:hidden mt-4 md:mt-0">
                        <div class="bg-gray-100 text-center rounded-xl h-10 px-4 py-2 pr-8">
                            <div class="text-sm font-bold leading-none @if($hasVoted) text-blue @endif">{{ $votesCount }}</div>

                        </div>
                        @if ($hasVoted)
                            <button wire:click.prevent="vote" style="" class=" " >
                                <svg xmlns="http://www.w3.org/2000/svg" class=" border-none h-5 w-5 " style="color: rgb(157, 255, 0)"  viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                  </svg>
                            </button>

                            @else
                            <button wire:click.prevent="vote" >
                                <svg xmlns="http://www.w3.org/2000/svg" class="border-none h-6 w-6  " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end idea-container -->

    <div class="buttons-container flex items-center justify-between mt-6">
        <div class="flex flex-col md:flex-row items-center space-x-4 md:ml-6">
            <livewire:add-comment :idea="$idea" />
        </div>

        <div class="hidden md:flex items-center space-x-3">
            <div class="bg-white font-semibold text-center rounded-xl px-3 py-2">
                <div class="text-xl leading-snug @if($hasVoted) text-violetC @endif">{{ $votesCount }}</div>

            </div>
            @if ($hasVoted)
                            <button wire:click.prevent="vote" style="" class=" " >
                                <svg xmlns="http://www.w3.org/2000/svg" class=" border-none h-8 w-8 " style="color: #7c57b4"  viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                  </svg>
                            </button>

                            @else
                            <button wire:click.prevent="vote" >
                                <svg xmlns="http://www.w3.org/2000/svg" class="border-none h-8 w-8  " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                        @endif
        </div>
    </div> <!-- end buttons-container -->
</div>
