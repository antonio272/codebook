<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Commentario;
use App\Models\CommentarioReply;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class PostController extends Controller
{   

    public function __construct() {
        $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post, Profile $profile, User $user, Commentario $commentario, CommentarioReply $commentarioReply)
    {   
        $users = auth()->user()->following()->pluck('profiles.user_id');
        //dd($users);

        $countu = $users->count();
        //dd($countu);
        
        $posts = Post::whereIn('user_id',$users)->with('user')->latest()->paginate(5);
        //dd($posts);
        $usersf = Profile::whereIn('user_id',$users)->latest()->paginate(4);
        //dd($usersf);
        $usersugestion = Profile::where('user_id','!=',(auth()->id()))
        ->whereNotIn('user_id',$users)->get();
        //dd($usersugestion);

        $usersugestionuser = User::where('id','!=',(auth()->id()))
        ->whereNotIn('id',$users)->get();
        //dd($usersugestionuser);

        $usercf = Profile::whereIn('user_id',$usersugestion)->get();
        //dd($usercf);
        
        $commentariosshowid = CommentarioReply::all();
        
        
    return view('post.index', compact('posts', 'usersf', 'users', 'commentariosshowid','usersugestion', 'usersugestionuser', 'countu'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("post.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            "caption" => ["required", "min:3", "max:1000"],
            "photo" => ["required"]
        ]);

        $imagePath = "/storage/" . request("photo")->store("posts", "public");

        Image::make( public_path( ltrim($imagePath, '/') ) )->fit(1200, 1200)->save();

        $post = auth()->user()->posts()->create([
            "caption" => $data["caption"],
            "photo" => $imagePath

        ]);
        
        return redirect("/post/" . $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, Commentario $commentario, CommentarioReply $commentarioReply)
    {
        
        $post = Post::findOrfail( $post->id );
        //dd($post);
        $likes = (auth()->user()) ? auth()->user()->likeing->contains($post->id) : false;
        //dd($likes);
        $likesCount = $post->likes->count();

        $commentarios = $post->commentarios()->get();
        
        $likeingFriend = $post->likes()->pluck('post_user.user_id');
          //dd($followingFriend);
        
        $likeguy = Profile::whereIn('user_id',$likeingFriend)->with('user')->latest()->paginate(1);
        //dd($followguy);
          
         //::::::::::::  count replies ::::::::::::::::::::::::::::
         //::::::::::::::::::::::::::::::::::::::::::::::::::::::::
         
        $commentariosshowid = $post->commentarios()->pluck('id');
        $posts = CommentarioReply::whereIn('commentario_id',$commentariosshowid)->get();
        $postsrepliescount = CommentarioReply::whereIn('commentario_id',$commentariosshowid)->count();
    

    return view("post.show", compact('post','postsrepliescount', 'commentarios', 'likes', 'likesCount', 'likeingFriend', 'likeguy'/**/));
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, Profile $profile)
    {
        
        $post->delete();
        $profile = auth()->user()->profile->id;

        return redirect("/profile/" . $profile);


    }









    //teste
    /*public function comments()
    {
      $posts=Auth::user()->posts;
      $comments=Auth::user()->comments;
      return view('post.comments', compact('post','comments'));
    }*/
}
