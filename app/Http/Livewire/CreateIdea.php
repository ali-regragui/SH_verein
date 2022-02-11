<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\WithAuthRedirects;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Vote;
use Illuminate\Http\Response;
use Livewire\WithFileUploads;
use Livewire\Component;

class CreateIdea extends Component
{
    use WithAuthRedirects;
    use WithFileUploads;

    public $title;
    public $category = 1;
    public $description;
    public $images=[];
    public $li;
    public $list= [];
    public $z=array();

    protected $rules = [
        'title' => 'required|min:4',
        'description' => 'required|min:4',
        
    ];
    public function mount(){


    }

    public function createIdea()
    {
        if($this->images){
            foreach( $this->images as $image){
                //
                $imageName =basename(md5($image->getClientOriginalName()).md5(rand(10,50)).'.'.$image->getClientOriginalExtension());
                $image->storeAs('public',$imageName);
               
                array_push($this->list,$imageName);
            }
        }

        $imagesList=implode('-',$this->list);
        
        if (auth()->guest()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $this->validate();

        $idea = Idea::create([
            'user_id' => auth()->id(),
            'category_id' => $this->category,
            'status_id' => 1,
            'title' => $this->title,
            'description' => $this->description,
            'images'=>$imagesList
        ]);

        $idea->vote(auth()->user());

        session()->flash('success_message', 'Beitrag wurde erstellt');

        $this->reset();

        return redirect()->route('idea.index');
    }

    public function render()
    {
        return view('livewire.create-idea', [
            'categories' => Category::all(),
        ]);
    }
}
