<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentarioRequest;
use App\Models\Post;
use App\Models\User;
use App\Models\Commentario;
use App\Models\CommentarioReply;

use Illuminate\Http\Request;

class CommentarioReplyController extends Controller
{
    
    public function store(Commentario $commentario, CommentarioRequest $request)
    {   $data = $request->validated();
        $commentarioReply = new CommentarioReply();

        $commentarioReply->commentario_id = $commentario->id;
        $commentarioReply->user_id = $request->user()->id;
        $commentarioReply->commentario = $data["commentario"];
        $commentarioReply->save();
        
        
        return redirect()->back();
        
    }

    public function edit(Post $post, Commentario $commentario, $id)
    {
        
        $commentarioReply = CommentarioReply::findorfail($id);
        return view('commentario.editreply', compact('commentarioReply','commentario', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Post $post, Commentario $commentario, CommentarioReply $commentarioReply, CommentarioRequest $request)
    {
        
        $this->middleware("auth");
        $data = $request->validated();

        $commentarioReply->commentario_id = $commentario->id;
        $commentarioReply->id = $commentarioReply->id;
        $commentarioReply->user_id=$request->user()->id;
        $commentarioReply->commentario = $data["commentario"];
        $commentarioReply->update(); 
        
        return redirect()->route('post.show', $post->id);
        
    }


    public function destroy(CommentarioReply $commentarioReply){

        $commentarioReply->delete();
        return redirect()->back();
    }
}
