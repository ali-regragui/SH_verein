<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/help-2.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/help-2.png') }}">
        <link rel="manifest" href="/site.webmanifest">

        <title>{{ 'SeniorenHilfe Verein' }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <livewire:styles />

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans bg-wheat text-gray-900 text-sm">
        <header class="flex flex-col w-full h-20 bg-violetC md:flex-row items-center justify-between px-8 py-4">
            <div class="flex ">
                <a href="/"><img src="{{ asset('img/help-2.png') }}" alt="logo"></a>
                <div class="text-center text-5xl  font-extrabold ml-4 mt-2">
                    <strong class="bg-clip-text text-white bg-gradient-to-r from-green-400 to-blue-500">SeniorenHilfe</strong>
                </div>
            </div>


            <div class="flex items-center mt-2 md:mt-0">
                @if (Route::has('login'))
                    <div class="px-6 py-4">
                        @auth
                            <div class="flex items-center space-x-4">

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <a class="text-white" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Abmelden') }}
                                    </a>
                                </form>

                                <div>
                                    <a href="{{route('chat.view')}}">
                                        <svg xmlns="http://www.w3.org/2000/svg"  style ="color:#a3a3a3;"class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z" />
                                            <path d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z" />
                                        </svg>
                                    </a>

                                </div>
                                <livewire:comment-notifications />

                            </div>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-white font-semibold underline">Einloggen</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 text-sm text-white font-semibold underline">Registrieren</a>
                            @endif
                        @endauth
                    </div>
                @endif
                @auth

                    @if (auth()->user()->image == null)
                        <a href="{{route('profil.index')}}">
                            <img src="{{ asset('img/user_anonym.png') }}" alt="avatar" class="w-10 h-10 rounded-full">
                        </a>

                     @else
                        <a href="{{route('profil.index')}}">
                            <img src="{{ asset('storage/Profil/'.Auth()->user()->image) }}" alt="avatar" class="w-10 h-10 rounded-full">
                        </a>

                    @endif

                @endauth
            </div>
        </header>


        @if (\Route::current()->getName()== 'profil.index')


            <div class="flex justify-center h-screen w-screen bg-wheat ">
                <div class=" flex items-center justify-center h-90p  flex-row lg:w-10/12  md:w-11/12 w-9/12">
                    @yield('testA')
                </div>
            </div>


        @elseif (\Route::current()->getName()== 'chat.show')
            <div class="flex justify-center w-screen bg-wheat ">
                <div class=" flex justify-center items-center h-screen  flex-row lg:w-10/12  md:w-11/12 w-9/12">
                    @yield('testB')
                </div>
            </div>
        @elseif (\Route::current()->getName()== 'chat.view')
            <div class="flex justify-center w-screen  ">
                <div class=" flex justify-center items-center h-screen  flex-row lg:w-10/12  md:w-11/12 w-9/12">
                    @yield('testB')
                </div>
            </div>
        @else



            <main class="container mx-auto max-w-custom flex flex-col md:flex-row">

                <div class="w-70 mx-auto md:mx-0 md:mr-5">
                    <div
                        class="bg-white md:sticky md:top-8 border-2 border-violetC rounded-xl mt-16"
                        style="
                            border-image-source: linear-gradient(to bottom, rgba(50, 138, 241, 0.22), rgba(99, 123, 255, 0));
                                border-image-slice: 1;
                                background-image: linear-gradient(to bottom, #ffffff, #ffffff), linear-gradient(to bottom, rgba(241, 50, 241, 0.22), rgba(99, 123, 255, 0));
                                background-origin: border-box;
                                background-clip: content-box, border-box;
                        "
                    >

                        <div class="text-center px-6 py-2 pt-6">
                            <h3 class="font-semibold text-base">Beitrag Erstellen</h3>
                            <p class="text-xs mt-4">
                                @auth
                                    Erstellen Sie einen neuen Beitrag
                                @else
                                    Loggen Sie sich ein, um einen einen Beitrag zu erstellen
                                @endauth
                            </p>
                        </div>

                        <livewire:create-idea />
                    </div>
                </div>
                <div class="w-full px-2 md:px-0 md:w-175">


                    <div class="mt-8">
                        {{ $slot }}
                    </div>
                </div>
            </main>
        @endif

        {{-- @endif --}}

        @if (session('success_message'))
            <x-notification-success
                :redirect="true"
                message-to-display="{{ (session('success_message')) }}"
            />
        @endif

        @if (session('error_message'))
            <x-notification-success
                type="error"
                :redirect="true"
                message-to-display="{{ (session('error_message')) }}"
            />
        @endif

        <livewire:scripts />
    </body>


</html>
