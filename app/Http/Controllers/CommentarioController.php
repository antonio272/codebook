<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentarioRequest;
use App\Models\Post;
use App\Models\User;
use App\Models\Commentario;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;

class CommentarioController extends Controller
{
    public function __construct() {
        $this->middleware("auth");
    }

    /*public function create()
    {
        return view("post.create");
    }*/
    
    public function store(Post $post, CommentarioRequest $request)
    {   
        
        
        $data = $request->validated();
        $commentario = new Commentario();

        $commentario->post_id = $post->id;
        $commentario->user_id=$request->user()->id;
        $commentario->commentario = $data["commentario"];
        $commentario->save();
        
        // Success message
       
        return redirect()->back();
       
    }

    public function edit(Post $post, $id)
    {
        $commentario = Commentario::findorfail($id);
        return view('commentario.edit', compact('commentario', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Post $post, Commentario $commentario, CommentarioRequest $request)
    {
        
        $this->middleware("auth");
        $data = $request->validated();
        
       $commentario->post_id = $post->id;
        $commentario->id = $commentario->id;
        $commentario->user_id=$request->user()->id;
        $commentario->commentario = $data["commentario"];
        $commentario->update(); 
        
        return redirect()->route('post.show', $post->id);
    }


    public function destroy(Commentario $commentario){

        $commentario->delete();
        return redirect()->back();
    }

   
}
