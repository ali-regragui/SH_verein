<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;
use Livewire\WithFileUploads;
class ProfilSite extends Component
{
    // use WithFileUploads;
    public $img;
    public $anrede;
    public $name;

    public $user;
    public $email;
    public $photo;

    // protected $listeners  =['profilWasUpdated'=>'$refresh'];
    protected $listeners = [
        'fileUpload'     => 'updateImage',
    ];
    protected $rules = [
        'name' => 'required|min:4',
        // 'fileName' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
        // 'category' => 'required|integer|exists:categories,id',
        // 'description' => 'required|min:4',
    ];
    public function mount(User $user){

        $this->user = $user;
        // $this->img =$user->image;
        // $this->anrede = $user->anrede;
        $this->name = $user->name;
        $this->email = $user->email;
        // $this->img_pfad= $user->image_pfad;


    }
    // public function newFileNow(){

    // }
    // public function update($imageData)
    // {
    //         $date = Carbon::now()->toDateString();
    //         ## MAKE IMAGE UNIQUE NAME ##
    //         $imageName = 'app-logo-' . $date . '-' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];

    //         $logo = Image::make($imageData)->save($imageData->explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1]);
    //         ## PUT IMAGE IN USERS DIRECTORY ##
    //         Storage::disk('public')->put('users/'.$imageName,$logo);
    // }
    public function updateImage($imageData){
        // dd($image);
        // $z = base64_encode(file_get_contents($imageData->file('image')));
        // $data = substr($imageData, 0, strpos($imageData, ';')+1);
        // $data = base64_decode($data);
        // Storage::disk('public')->put("test.png", $data);
        // $this->img =$z;

        // dd();
        // $newFile = $this->img->store('public');
        // $date = Carbon::now()->toDateString();
        //     ## MAKE IMAGE UNIQUE NAME ##
        //     $imageName = 'app-logo-' . $date . '-' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
        //     $logo = User::make($imageData)->save($imageData->explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1]);
        //     Storage::disk('public')->put('users/'.$imageName,$logo);
        // $this->user->update([
        //     'image' => '1111',

        // ]);
        $this->img = $imageData;


    }

    public function update_profil(){
        // $this->validate();
        // $newFile = $this->fileName->store('public');
        $this->user->update([
            'name' => $this->name,

        ]);
        $image_64 = $this->img ;//your base64 encoded data

        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf

        $replace = substr($image_64, 0, strpos($image_64, ',')+1);

        // find substring fro replace here eg: data:image/png;base64,

        $image = str_replace($replace, '', $image_64);

        $image = str_replace(' ', '+', $image);

        $imageName = Str::random(10).'.'.$extension;
        // $this->img =base64_decode($image);
        Storage::disk('public')->put($imageName, base64_decode($image));
        // dd($this->name);
        // $this->emit('profilWasUpdated', $this->user);

     }
    public function render()
    {
        return view('livewire.profil-site');
    }
}
