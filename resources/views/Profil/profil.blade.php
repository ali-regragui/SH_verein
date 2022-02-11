{{-- <x-app-layout>

    <div>dddd</div>
</x-app-layout> --}}



@extends('layouts.app')
@section('testA')


    <div class="w-11/12 h-90p flex items-center justify-center   ">
        <div class="  w-5/6 h-90p flex items-center justify-center  mx-auto py-0 md:py-16">
            
            <div class="w-7/12 h-90p shadow-xl border-2 rounded-2xl bg-white space-y-6">
                <div class="flex justify-between items-top">
                  <div class="space-y-4">
                      <div class="text-2xl font-serif font-bold px-10 pt-5 ">
                          Profil
                      </div>
                    <div>

                        <div class="flex">
                            <div class="px-10 pt-3 ">
                                @if (auth()->user()->image == null or auth()->user()->image=='' )
                                        
                                <img src="{{ asset('img/user_anonym.png') }}" alt="avatar" class="w-32 h-32 rounded-xl">
                
                                        
                                        
                                @else
                                    
                                    <img src="{{ asset('storage/Profil/'.auth()->user()->image) }}" alt="avatar" class="w-32 h-32  rounded-xl">
                                    
                                @endif
                            </div>
                            <div class="pt-24 px-5">
                                <button class="modal-open text-xs bg-violetC text-white font-semibold rounded-xl border border-violetC hover:bg-red-200 transition duration-150 ease-in px-6 py-3">Profil bearbeiten</button>
                             </div>
                        </div>
                        <div class="px-10">
                            <p class="text-2xl font-serif font-semibold pt-6"> {{ucfirst(auth()->user()->name)}} </p>
                        </div>
                        
                    </div>
                    <div>
                        <div class="px-10 pb-1">

                            <p class="font-medium text-sm text-gray-600"> Anrede:</p>
                        </div>
                      <div class="px-12 pb-1">
            
                          @if(Auth()->user()->anrede== null)
            
                              <p> Unbekannt</p>
                          @else
                            <p class=""> {{Auth()->user()->anrede}} </p>
                          @endif  
            
                      </div>
                      <div class="px-10 pb-1">

                          <p class="font-medium text-sm text-gray-600"> Email:</p>
                      </div>
                        
                      <div class="px-12 pb-1">

                          <p> {{Auth()->user()->email}} </p>
                      </div>
                      
                      <div class="px-10 pb-1">
                          <p class="font-medium text-sm text-gray-600"> Aktiv Seit:</p>
                      </div>
                      <div class="px-12 pb-1">

                          <p>  {{auth()->user()->created_at->diffForHumans()}}</p>
                      </div>
                      
                    </div>
                  </div>
                  <div class="space-y-2">
                    <div>
                     
                     <div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
                        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
            
                        <div class="modal-container bg-white w-full md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
            
                            <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
                                <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                                </svg>
                                <span class="text-sm">(Esc)</span>
                            </div>
            
                            
                            <div class="modal-content  py-4  px-6">
                                <!--Title-->
                                <div class="flex justify-between items-center pb-3">
                                    <p class="flex items-center justify-center text-center text-2xl font-bold  ">Profil bearbeiten</p>
                                    <div class="modal-close cursor-pointer z-50">
                                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                                        </svg>
                                    </div>
                                </div>
                                
                                <form action="{{ route('profil.edit') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class=" flex justify-center items-center pb-2 border-b-2 border-violetC">
                                        @if (Auth()->user()->image==null)
                                            <div class="">
                                                <img id="showImg" src="{{ asset('img/user_anonym.png') }}" class=" object-scale-down rounded-xl h-48 w-ful ">
                                            </div>
                                        @else
                                            <div>
                                                <img id="showImg" src="{{ asset('storage/Profil/'.Auth()->user()->image) }}" class=" object-scale-down h-48 w-ful ">
                                            </div>
                                        @endif
                
                                    </div>
            
                                    <div class="border-t-2 flex  pt-6">
                                        <div

                                            class="flex items-center justify-center w-1/2 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3"
                                        >
                                            <svg class="text-gray-600 w-4 transform -rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                            </svg>
                                            
                                            <label for="file">Bild</label>
                                            <input type="file" id="file" name="image"  onchange="ImgUpload(event)"style="display: none;" >
                                            
                                        </div>
            
                                        
            
                                    </div>
                                                        {{-- class="bg-white md:sticky md:top-8 border-2 border-violetC rounded-xl mt-16"
                                            style="
                                                border-image-source: linear-gradient(to bottom, rgba(50, 138, 241, 0.22), rgba(99, 123, 255, 0));
                                                    border-image-slice: 1;
                                                    background-image: linear-gradient(to bottom, #ffffff, #ffffff), linear-gradient(to bottom, rgba(241, 50, 241, 0.22), rgba(99, 123, 255, 0));
                                                    background-origin: border-box;
                                                    background-clip: content-box, border-box;
                                            " --}}
                                    <div class="flex py-2 ">
                                        <label class="text-lg  font-semibold pr-10" for="Anrede">Anrede</label>
                                        
                                        <div class="flex justify-center">
                                            <div class="mb-3 xl:w-96">
                                                <select name="anrede" id="" class="form-select appearance-none
                                                    block
                                                    w-1/2
                                                    px-3
                                                    py-1.5
                                                    text-base
                                                    font-normal
                                                    text-gray-700
                                                    bg-wheat bg-clip-padding bg-no-repeat
                                                    border border-solid border-violetC
                                                    rounded
                                                    transition
                                                    ease-in-out
                                                    m-0
                                                    focus:text-gray-700 focus:bg-white focus:border-violetC focus:outline-none" aria-label="Default select example">
                                                    <option value="unbekannt" selected>auswählen</option>
                                                    <option value="Frau">Frau</option>
                                                    <option value="Herr">Herr</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex py-2 ">
                                        <label class="text-lg  font-semibold pr-12"  for="name">Name</label>
                                        
                                        <input class="w-1/2  bg-wheat border-violetC rounded m-0 placeholder-gray-900 " name="name"  type="text"  value="{{ Auth()->user()->name}}"  >
                                        @error('Name')
                                            <p class="text-red text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="flex py-2 " >
                                        <label class="text-lg  font-semibold pr-14" for="Email">Email</label>
                                        <span class="w-1/2  bg-wheat border border-solid border-violetC rounded m-0 placeholder-gray-900 px-3 py-2" >{{Auth()->user()->email}}</span>
                                    </div>
                                    <div class="flex justify-end  pt-2">
                                        <button class="text-lg bg-violetC text-white font-semibold rounded-xl border border-violetC hover:bg-red-200 transition duration-150 ease-in px-6 py-3" type="submit" >Bestätigen</button>
                                        {{-- <button class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400">Abbrechen</button> --}}
                                    </div>
            
                                </form>
            
                                <!--Footer-->
                                {{-- <div class="flex justify-end pt-2">
                                    <button class="px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2" wire:click.prevent="update_profil">Bestätigen</button>
                                    <button class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400">Abbrechen</button>
                                </div> --}}
            
                            </div>
                        </div>
                    
                  </div>
                </div>
            </div>
            
        </div>
        
    
    </div>
{{-- </div> --}}

{{-- let inputField = document.getElementById('logo')
    let file = inputField.files[0]
    let reader = new FileReader();
    reader.onloadend = () => {
        window.livewire.emit('fileUpload', reader.result)
    }
    reader.readAsDataURL(file); --}}
{{-- <div>
<select name="Anrede" id="">
    <option value="auswählen">auswählen</option>
    <option value="Herr">Herr</option>
    <Option value="Frau">Frau</Option>
</select>
</div> --}}
{{-- window.livewire.on('newFileNow', () => {
    alert('ffffff')
}) --}}

<script>

var openmodal = document.querySelectorAll('.modal-open')
for (var i = 0; i < openmodal.length; i++) {
  openmodal[i].addEventListener('click', function(event){
    event.preventDefault()
    toggleModal()
  })
}

const overlay = document.querySelector('.modal-overlay')
overlay.addEventListener('click', toggleModal)

var closemodal = document.querySelectorAll('.modal-close')
for (var i = 0; i < closemodal.length; i++) {
  closemodal[i].addEventListener('click', toggleModal)
}

document.onkeydown = function(evt) {
  evt = evt || window.event
  var isEscape = false
  if ("key" in evt) {
    isEscape = (evt.key === "Escape" || evt.key === "Esc")
  } else {
    isEscape = (evt.keyCode === 27)
  }
  if (isEscape && document.body.classList.contains('modal-active')) {
    toggleModal()
  }
};


function toggleModal () {
//   const body = document.querySelector('body')
  const modal = document.querySelector('.modal')
  modal.classList.toggle('opacity-0')
  modal.classList.toggle('pointer-events-none')
  body.classList.toggle('modal-active')
}



// Bild hochladen und Aneigen
    var ImgUpload = function(event) {
        var image = document.getElementById('showImg');
        image.src = URL.createObjectURL(event.target.files[0]);
    };

</script>

<script>

    document.addEventListener('livewire:load', () => {
        window.livewire.on('newFileNow', () => {


            let inputField = document.getElementById('file')
            let file = inputField.files[0]
            let reader = new FileReader();
            reader.onloadend = () => {
                window.livewire.emit('fileUpload', reader.result)
            }
            reader.readAsDataURL(file);

        })
    });
</script>

@endsection
