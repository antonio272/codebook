@extends('layouts.app')

@section('content')
<div class="container mt-5">
<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8"  style="background: #ffffff;">
    <article class="row">
        <figure class="col-md-5">
            <img src="{{ $post->photo }}" alt="" class="w-100">

             <!-- div icones apagar editar -->
             <div class="d-inline-flex">
                <div class="">
                    @if(Auth::id() == $post->user_id)
                        <!-- delete comment -->
                        <form></form><!-- se nao colocar form vazio náo reconhece o primeiro item -->
                        <form action="/post/{{ $post->id }}" method="POST" class="mb-3">
                        @csrf
                        @method('DELETE')
                        <!--<button type="submit" class="text-sm py-1 px-2 border border-gray-400 shadow-sm rounded-md hover:shadow-md">Delete</button>-->
                        <button type="submit" class="btn btn-link">
                        <i class="fa fa-trash-o" style="font-size:24px; color: black"></i>
                        </button>
                        </form>
                    @endif
                </div>
            </div>

        </figure>
        <div class="col-md-7">
            <div class="row">
                <div class="col-md-2">
                    <a href="/profile/{{
                        $post->user->profile->id }}">
                    <img src="{{ 
                    $post->user->profile->picture }}"
                    alt="" class="w-100">
                    </a>
                </div>
                <div class="col-md-10">
                    <div>
                        <strong>{{ $post->user->username }}</strong>
                        {{ $post->caption }}
                    </div>
                   <!-- <div>{{ date("j M Y H:i", strtotime($post->created_at)) }}</div>-->
                    <div class="mt-4">
                        <time datetime="{{ $post->created_at }}">{{ $post->created_at->diffForHumans() }}</time>
                    </div>
                </div>

                <div class="mt-4 d-flex">
                    <!-- icones likes comments -->
                    <like-button post-id="{{ $post->id }}" likes ="{{ $likes }}"></like-button><!---->
                    <i class="fa fa-comment-o" style="font-size:24px; margin-left: 15px" id="showcomm" aria-hidden="true"></i>
                </div>

                <dt class="ml-2 mt-3 text-align-center">{{ $likesCount }}   peoplelikes</dt>

                <div class="row d-flex">
                            @foreach ($likeguy as $lk)
                                <div style="width: fit-content; margin-top: auto; padding: 0">
                                <a href="/profile/{{ $lk->user->id }}">
                                <img src="{{ $lk->picture }}" alt="" class="rounded-circle"
                                            style="width: 35px; border: 1px solid rgba(128, 128, 128, 0.16);">
                                </a>
                                </div>
                                
                            @endforeach 
                            @foreach ($likeguy as $lk)
                            <div style="width: fit-content; margin-top: auto; margin-left: 5px; padding: 0">
                                <h2 class="h6 font-weight-bold mt-4">
                                    @if ( $lk->user->id != Auth::user()->id && $likesCount == 1)
                                    <strong>{{ $lk->user->name }} likes This</strong>

                                    @elseif ( $lk->user->id == Auth::user()->id && $likesCount == 1 )
                                    <strong>you</strong> likes This

                                    @elseif ( $lk->user->id == Auth::user()->id && $likesCount > 1 )
                                    <strong>you</strong> and <strong>{{ $likesCount - 1}} other people likes this</strong>

                                    @elseif ( $lk->user->id != Auth::user()->id && $likesCount > 1)
                                    <strong>{{ $lk->user->name }}</strong> and <strong>{{ $likesCount - 1}} other people likes this</strong>
                                    
                                    @else if ($lk->likeing->whereIn('user_id',Auth::user()->id)->pluck('user_id')->count() !=0 && $likesCount != 1)
                                    <strong>you</strong> and <strong>{{ $likesCount - 1}} other people likes this</strong>
                                    
                                    
                                    @endif

                                    
                                </h2>
                            </div>
                            @endforeach
                    
                </div>
                    
                <div class="col-md-12 my-3" >
                        @if ( $post->commentarios->count() == 0)
                        <p>This post has no comments</p>
                        @elseif ($post->commentarios->count() > 0)
                        <p>This post has <strong>{{ $post->commentarios->count() + $postsrepliescount }} comments</strong></p>
                        
                        

                        

                        @endif
                </div>
                    
                
                <!-- Add Comment -->
				<div class="card my-2" style="display: none" id="comm">
                    <div class="col-md-12">
                        <div class="row">
                            <div style="width: fit-content">
                            <a href="{{ url('/home') }}">   
                                    <img src="{{ Auth::user()->profile->picture }}" alt="" class="rounded-circle"
                                                style="width: 50px; border: 1px solid rgba(128, 128, 128, 0.16); margin: 5px">           
                            </a>
                            </div>
                            <div class="col-md-10 my-2">
                                <strong><p class="mr-2 font-bold">{{ Auth::user()->name }}</p></strong>
                                <form method="post"  action="/post/{{ $post->id }}/commentarios">
                                @csrf
                                <div class="col-md-12">
                                <div class="d-inline-flex">
                                <textarea name="commentario" class="form-control col-md-9" style="border: none" placeholder='Add Comment...'></textarea>
                                <input type="submit" class="btn btn-link p-0 col-md-3" style="text-decoration: none;"/>
                                </div>
                                </div>
                                </form>
                            </div>
                            
                        </div>
                    </div>
                    
				</div>
                        
				
                <div class="">
                    @foreach ($post->commentarios as $commentario)

                        <div class="flex mb-3"style="background: rgb(231, 231, 231); padding: 5px; border-radius: 5px; box-shadow: 5px 5px 2px lightgrey;">
                            <div class="row">
                                <div class="col-md-2">
                                    <a href="/profile/{{ $commentario->user->id }}">
                                    <img src="{{ $commentario->user->profile->picture }}" alt="" class="rounded-circle"
                                        style="width: 50px; border: 1px solid rgba(128, 128, 128, 0.16);">
                                    </a>
                                </div>
                                <div class="col-md-5">
                                    <strong><p class="mr-2 font-bold">{{ $commentario->user->name }}</p></strong>
                                    <p class="m-0 pt-2">{{ $commentario->commentario }}</p>
                                </div>
                                <div class="col-md-5">
                                    <p class="text-gray-600">{{$commentario->created_at->diffForHumans()}}</p>
                                    
                                    <!-- div icones apagar editar -->
                                    <div class="d-inline-flex">
                                        <div class="">
                                            @if(Auth::id() == $commentario->user_id || Auth::id() == $post->user_id)
                                                <!-- delete comment -->
                                                <form></form><!-- se nao colocar form vazio náo reconhece o primeiro item -->
                                                <form action="/commentarios/{{ $commentario->id }}" method="POST" class="mb-3">
                                                @csrf
                                                @method('DELETE')
                                                <!--<button type="submit" class="text-sm py-1 px-2 border border-gray-400 shadow-sm rounded-md hover:shadow-md">Delete</button>-->
                                                <button type="submit" class="btn btn-link">
                                                <i class="fa fa-trash-o" style="font-size:24px; color: black"></i>
                                                </button>
                                                </form>
                                            @endif
                                        </div>

                                        @if(Auth::id() == $commentario->user_id)
                                        <div class="">
                                        <!-- edit comment -->
                                        <button class="btn btn-link" style="text-decoration: none">
                                                <a href="/post/{{ $post->id }}/commentarios/{{ $commentario->id }}/edit" style="color: black; text-decoration: none" class="text-sm py-1 px-2 border border-gray-400 shadow-sm rounded-md hover:shadow-md">
                                                Edit
                                                </a>
                                        </button>
                                        </div>
                                    <!--
                                    <div class="">
                                    <a href="/post/{{ $post->id }}/commentarios/{{ $commentario->id }}/edit" style="text-decoration: none" class="text-sm py-1 px-2 border border-gray-400 shadow-sm rounded-md hover:shadow-md">Edit</a>
                                    </div>
                                    -->
                                    @endif 
                                        <!-- replies button -->
                                        <button class="text-sm mt-1 border border-gray-400 shadow-sm hover:shadow-md" id="reply-btn" style="text-decoration: none;height: fit-content; color: black"
                                        onclick="showReplyForm('{{$commentario->id}}','{{$commentario->user->name}}')">
                                                Reply    
                                        </button>
                                        

                                        
                                      
                                    </div>
                                </div>
                            </div>

                            <!-- form reply -->

                            <div class="card my-2" id="reply-form-{{$commentario->id}}" style="display: none">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div style="width: fit-content">
                                        <a href="{{ url('/home') }}">   
                                                <img src="{{ Auth::user()->profile->picture }}" alt="" class="rounded-circle"
                                                            style="width: 50px; border: 1px solid rgba(128, 128, 128, 0.16); margin: 5px">           
                                        </a>
                                        </div>
                                        <div class="col-md-8 my-2" style="">
                                            <strong><p class="mr-2 font-bold mb-0">{{ Auth::user()->name }}</p></strong>
                                            <p class="date">{{date('D, d M Y H:i')}}</p>
                                            <form method="post"  action="/commentarios/{{ $commentario->id }}/commentario-reply">
                                            @csrf
                                            <div class="col-md-12">
                                            <div class="d-inline-flex">
                                            <textarea id="reply-form-{{$commentario->id}}-text" 
                                            name="commentario" class="form-control col-md-9" 
                                            style="border: none" placeholder='Add Reply...'></textarea>
                                            <input type="submit" class="btn btn-link p-0 col-md-3" style="text-decoration: none;"/>
                                            </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            @foreach ($commentario->replies as $reply)

                            <div class="flex mb-3"style="background: rgb(245, 244, 244); padding: 5px; border-radius: 5px; box-shadow: 5px 5px 2px lightgrey;">
                                <div class="row">
                                    <div class="col-md-2">
                                        <a href="/profile/{{ $reply->user->id }}">
                                        <img src="{{ $reply->user->profile->picture }}" alt="" class="rounded-circle"
                                            style="width: 50px; border: 1px solid rgba(128, 128, 128, 0.16);">
                                        </a>
                                    </div>
                                    <div class="col-md-5">
                                        <strong><p class="mr-2 font-bold">{{ $reply->user->name }}</p></strong>
                                        <p class="m-0 pt-2">{{ $reply->commentario }}</p>
                                    </div>
                                <div class="col-md-5">
                                    <p class="text-gray-600">{{$reply->created_at->diffForHumans()}}</p>
                                    
                                    <!-- div icones apagar editar -->
                                    <div class="d-inline-flex">
                                        <div class="">
                                            @if(Auth::id() == $reply->user_id || Auth::id() == $post->user_id)
                                                <!-- delete comment -->
                                                <form></form><!-- se nao colocar form vazio náo reconhece o primeiro item -->
                                                <form action="/commentario-reply/{{ $reply->id }}" method="POST" class="mb-3">
                                                @csrf
                                                @method('DELETE')
                                                <!--<button type="submit" class="text-sm py-1 px-2 border border-gray-400 shadow-sm rounded-md hover:shadow-md">Delete</button>-->
                                                <button type="submit" class="btn btn-link">
                                                <i class="fa fa-trash-o" style="font-size:24px; color: black"></i>
                                                </button>
                                                </form>
                                            @endif
                                        </div>

                                    @if(Auth::id() == $reply->user_id)
                                    <div class="">
                                    <!-- edit comment -->
                                    <button class="btn btn-link" style="text-decoration: none">
                                            <a href="/post/{{ $post->id }}/commentarios/{{ $commentario->id }}/commentario-reply/{{ $reply->id }}/edit" style="color: black; text-decoration: none" class="text-sm py-1 px-2 border border-gray-400 shadow-sm rounded-md hover:shadow-md">
                                            Edit
                                            </a>
                                    </button>
                                    </div>
                                    <!--
                                    <div class="">
                                    <a href="/post/{{ $post->id }}/commentarios/{{ $commentario->id }}/edit" style="text-decoration: none" class="text-sm py-1 px-2 border border-gray-400 shadow-sm rounded-md hover:shadow-md">Edit</a>
                                    </div>
                                    -->
                                    @endif 
                                     <!--replies button--> 
                                     <!-- replies button -->
                                     <button class="text-sm mt-1 border border-gray-400 shadow-sm hover:shadow-md" id="reply-btn" style="text-decoration: none;height: fit-content; color: black"
                                        onclick="showReplyForm('{{$commentario->id}}','{{$reply->user->name}}')">
                                                Reply    
                                        </button>
                                    
                                      
                                </div>
                               
                                </div>
                                </div>

                                <!-- form reply -->

                        </div>


                            @endforeach


                        </div>
                            
                            
                            <!--arrobaempty--> <!--nao funciona com foreach, empty posts 
                            <p>This post has no comments</p>-->

                           <!-- //replies -->

                            
                            
                           
                                
                @endforeach
                </div>


                
            </div>  
                               
         

                        
            
        </div>
    </article>
    </div>
    </div>
    <!--<div class="col-md-2"></div>-->
</div>
@endsection