<div>
    @auth
        <form wire:submit.prevent="createIdea" action="#" method="POST" class="space-y-4 px-4 py-6">
            <div>
                <input wire:model.defer="title" type="text" class="w-full text-sm bg-wheat border-none rounded-xl placeholder-gray-900 px-4 py-2" placeholder="Titel" required>
                @error('title')
                    <p class="text-red text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            
            <div>
                <textarea wire:model.defer="description" name="idea" id="idea" cols="30" rows="4" class="w-full bg-wheat rounded-xl border-none placeholder-gray-900 text-sm px-4 py-2" placeholder="Beschreibung" required></textarea>
                @error('description')
                    <p class="text-red text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-center justify-between space-x-3">
                <button

                    class="flex items-center justify-center w-1/2 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3"
                >
                    <svg class="text-gray-600 w-4 transform -rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                    </svg>
                    
                    <label for="file">Bilder</label>
                    <input type="file" name="image" wire:model.defer="images" multiple required>
                    @error('Images')
                    <p class="text-red text-xs mt-1">{{ $message }}</p>
                    @enderror
                </button>

                <button
                    type="submit"
                    class="flex items-center justify-center w-1/2 h-11 text-xs bg-violetC text-white font-semibold rounded-xl border border-violetC hover:bg-red-200 transition duration-150 ease-in px-6 py-3"
                >
                    <span class="ml-1">Erstellen</span>
                </button>
            </div>
        </form>
    @else
        <div class="my-6 text-center">
            <a
                wire:click.prevent="redirectToLogin"
                href="{{ route('login') }}"
                class="inline-block justify-center w-1/2 h-11 text-xs bg-violetC text-white font-semibold rounded-xl border border-violetC hover:bg-violet-hover transition duration-150 ease-in px-6 py-3"
            >
                Anmelden
            </a>
            <a
                wire:click.prevent="redirectToRegister"
                href="{{ route('register') }}"
                class="inline-block justify-center w-1/2 h-11 text-xs bg-wheat font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3 mt-4"
            >
                Registrieren
            </a>
        </div>
    @endauth
</div>
