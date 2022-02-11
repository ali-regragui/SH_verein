<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\Vote;
use App\Models\User;
use App\Models\Chat;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('idea.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function show(Idea $idea)
    {
        return view('idea.show', [
            'idea' => $idea,
            'votesCount' => $idea->votes()->count(),
            'backUrl' => url()->previous() !== url()->full() && url()->previous() !== route('login')
                ? url()->previous()
                : route('idea.index'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function edit(Idea $idea)
    {
        return view('test');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user,Idea $idea ,$conversation)
    {
        
        
        $messages=Chat::all();
        $isChatRoomExists = Chat::where('fromUser',auth()->user()->id)->where('toUser',$user->id)->where('ideaId',$idea->id)
            ->OrWhere('fromUser',$user->id)
            ->where('toUser',auth()->user()->id)
            ->where('ideaId',$idea->id)->exists();
        $getChatRoom =Chat::where('fromUser',auth()->user()->id)->where('toUser',$user->id)->where('ideaId',$idea->id)->OrWhere('fromUser',$user->id)->where('toUser',auth()->user()->id)->where('ideaId',$idea->id)->first();

        if(!$isChatRoomExists and auth()->user()->id != $user->id){
            
                $newRoomId= md5(rand(10,50).auth()->user()->id.$user->id);
                $chatRoom= New Chat;
                $chatRoom->ideaId= $idea->id;
                $chatRoom->roomId =$conversation;
                $chatRoom->fromUser= auth()->user()->id;
                $chatRoom->toUser= $user->id;
                $chatRoom->save();

        }else if(auth()->user()->id === $user->id){
            $chatRoom= Chat::where('roomId',$conversation)->first();
           
        }else{
            
            $chatRoom= Chat::where('ideaId',$idea->id)->where('fromUser',auth()->user()->id)
                ->where('toUser',$user->id)
                ->Orwhere('ideaId',$idea->id)
                ->where('fromUser',$user->id)
                ->where('toUser',auth()->user()->id)
                ->first();

        }
        
        return view('idea.showChat',['user'=>$user,'chatRoom'=>$chatRoom,'idea'=>$idea]);
    }
    /**
     * 
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function chatView(Request $request, User $user,Idea $idea ){

        return view('idea.showChat');
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function destroy(Idea $idea)
    {
        //
    }
}
