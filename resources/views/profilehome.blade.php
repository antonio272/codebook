@extends('layouts.app')

@section('content')

    
    <!-- profile info -->
    
    <div class="row d-flex mt-5" >
        <div class="col-md-3"></div>
        <div class="col-md-3" style="background: linear-gradient(0deg, rgba(255,255,255,1) 2%, rgba(255,255,255,1) 6%, rgba(247,247,247,1) 17%, rgba(69,65,81,1) 19%, rgba(45,40,58,1) 65%, rgba(23,26,27,1) 100%, rgba(27,22,41,1) 100%, rgba(70,137,173,1) 100%, rgba(177,191,193,1) 100%);">
            <div class="col-md-3 mt-3">
                teste
                <img src="{{ Auth::user()->profile->picture }}" alt="" class="rounded-circle"> 
            </div>
        </div>

        <div class="col-md-3 p-o"style="background: linear-gradient(0deg, rgba(255,255,255,1) 2%, rgba(255,255,255,1) 6%, rgba(247,247,247,1) 17%, rgba(69,65,81,1) 19%, rgba(45,40,58,1) 65%, rgba(23,26,27,1) 100%, rgba(27,22,41,1) 100%, rgba(70,137,173,1) 100%, rgba(177,191,193,1) 100%);">
            <div class="d-flex mt-5">
                <div class="h4 ms-auto">{{ Auth::user()->username }}</div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
    
   
    <!-- --> 

    <div class="row d-flex mt-2" style=""> 
    <div class="col-md-3"></div> 
            <!-- direcionar -->
    <div class="follows text-black col-sm-6" style="background: yellow"> 
    <div class="row d-flex">
    <div class="col-md-2 m-2" style="background: #D9DCDC; border-radius: 5px;">
    <a class="dropdown-item" href="/profile/edit"> {{ __('Edit Profile') }}</a>
    </div> 
    <div class="col-md-2 m-2" style="background: #D9DCDC; border-radius: 5px;">
    <a class="dropdown-item" href="/profile/{{ Auth::user()->id }}"> {{ __('My Posts') }}</a>
    </div> 
    <div class="col-md-2 m-2" id="btnButton" style="background: #D9DCDC; border-radius: 5px;">
    <button class="dropdown-item">{{ __('Find Friends') }}</button>
    
    </div>
    <!-- div icones apagar editar -->
    <div class="d-inline-flex">
        <div class="">
            @if(Auth::id() == auth()->user()->profile->user_id)
                <!-- delete comment -->
                <form></form><!-- se nao colocar form vazio náo reconhece o primeiro item -->
                <form action="/profile/{{ auth()->user()->profile->id }}" method="POST" class="mb-3">
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

    </div>
    </div>
    </div>
    <!-- --> 

    <div class="row d-flex mt-3"> 
    <div class="col-md-3"></div> 
            <!-- follow people -->
    <div class="follows text-black col-sm-6 border-top border-2  border-bottom border-2" style="background: #ffffff"> 
            <div class="pl-3 mt-3 ">
                <h5>
                    <strong>
                    following ({{ $countu }} people)
                    </strong>
                </h5>
            </div>
            <div class="container-fluid">      
            <div class="row d-flex">
            @foreach ($usersf as $userf)
                <div class="col-sm-3 mb-3">
                <a href="/profile/{{ $userf->id }}" style="text-decoration: none; color:black">
                <img src="{{ $userf->picture }}" alt="" style="border-radius: 5px; width: fit-content">
                </a>
                </div>
               
            @endforeach
            </div>
            </div>

    </div>
    </div>
    <!-- --> 

    <!-- search 
    <div class="row d-flex mt-3"> 
    <div class="col-md-3"></div>
    <div class="col-md-6">
    <form class="form-inline my-2 my-lg-0" type="get" action="{{ url('/search') }}">
        <input class="form-control mr-sm-2" name="namesearch" type="search" placeholder="Search people">
        --<button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>--
        <button class="dropdown-item my-2 my-sm-0" style="background: #D9DCDC; border-radius: 5px;" type="submit">Search</button>
    </form>
    </div>
    <div class="col-md-3"></div>

    -->


    <div class="col-md-3"></div>
    <div class="row" id="show" style="display: none;"> 
    <div class="col-md-3"></div> 
            <!-- follow people sugestion-->
    <div class="follows text-black col-sm-6 border-top border-2  border-bottom border-2" style="background: #9DA09F"> 
            <!-- search -->
            
            <form class="form-inline my-2 my-lg-0" type="get" action="{{ url('/search') }}">
                <div class="row">
                <div class="col-md-8 my-2 py-2">
                <div class="search" style="position: relative;box-shadow: 0 0 40px rgba(51, 51, 51, .1)"> <i class="fa fa-search" style="position: absolute;top: 12px;left: 4px"></i> <input type="search" name="namesearch" class="form-control ps-4" placeholder="Search people...">
                     <button class="btn btn-primary" style="position: absolute;top: 3px;right: 5px;height: 30px;width: 115px;background: blue; text-align:center"type="submit">Search</button> </div>
                    
                </div>
                    <!--<div class="form"><input type="search" name="namesearch" class="form-control form-input" placeholder="Search people..."></div>
                        <input class="col-sm-3 mr-sm-2 "  type="search" placeholder="Search people ...">
                    <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
                    <button class="dropdown-item my-4 col-sm-3" style="background: #D9DCDC; border-radius: 5px; width:fit-content" type="submit">Search</button>-->  
                </div> 
            </form>

            <div class="pl-3 mt-3 ">
                <h5>
                    <strong>
                    following sugestion ({{ $usersugestionuser->count() }} people)
                    </strong>
                </h5>
            </div>
            <div class="container-fluid">      
            <div class="row d-flex">
           <!-- @foreach ($usersugestion as $usersug)
                <div class="col-sm-2 mb-3">
                <a href="/profile/{{ $usersug->id }}" style="text-decoration: none; color:black">
                            <img src="{{ $usersug->picture }}" alt="" style="border-radius: 5px; width: 80px">
                            </a>
                            
                            
                </div>
            
            @endforeach-->
            @foreach ($usersugestionuser as $usersuguser)
                <div class="col-sm-2 mb-3">
                <a href="/profile/{{ $usersuguser->profile->id }}" style="text-decoration: none; color:black">
                            <img src="{{ $usersuguser->profile->picture }}" alt="" style="border-radius: 5px; width: 80px">
                            </a>
                            <!--<strong>
                            following {{$usersuguser->following->count()}} people
                            </strong>
                            {{ $usersuguser->following->pluck('user_id') }}-->
                            <div class="h6">
                            <strong>
                            {{ $usersuguser->following->whereIn('user_id',$users)->pluck('user_id')->count() }} common followers
                            </strong>
                            </div>
                            
                            @if ( $usersuguser->following->whereIn('user_id',Auth::user()->id)->pluck('user_id')->count() !=0)
                                <div class="h6"><strong>"Follows you!"</strong></div>
                                 @elseif ( $usersuguser->following->whereIn('user_id',Auth::user()->id)->pluck('user_id')->count() ==0)
                                 <div class="h6"><strong>"Not Follows you!"</strong></div>
                            @endif
                            <!--if !empty return 
                            
                            {{ $usersuguser->following->whereIn('user_id',Auth::user()->id)->pluck('user_id') }}-->

                            <!--@foreach ($usersuguser->following->pluck('user_id') as $comumfoto)
                            <img src="{{ $comumfoto }}" alt="" style="border-radius: 5px; width: 20px">
                            
                            
                            @endforeach-->
                            
                            
                </div>
            
            @endforeach
            </div>
            </div>

    </div>
    </div>
    <!-- --> 


<div class="row d-flex"> 
<div class="col-md-3"></div>
<div class="col-md-6" style="background:  #D9DCDC">
    <!-- follow people posts -->
    <div class="container">
        @foreach ($posts as $post)
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6" style="background: #fff; margin: 10px 0px; padding: 5px 5px 5px 5px;border-radius: 5px;">
                <div class="mb-3" style="background: #fff; border-radius: 5px;">
                    <div class="row">
                    <div class="col-sm-12">
                            <div class="d-flex align-items-center pt-2">
                                <div>
                                    <img src="{{ $post->user->profile->picture }}" alt="" class="rounded-circle" style="width:50px;border: 1px solid #80808029;">
                                </div>
                                <div class="pl-3">
                                    <h6>
                                        <strong>
                                            <a href="/profile/{{ $post->user->id }}" style="text-decoration: none; color:black">{{ $post->user->username }}</a>
                                        </strong>
                                    </h6>
                                </div>
                            
                            </div>
                            <div class="pt-2">
                                <p>{{ $post->caption }}</p>
                            </div>
                    </div>    
                    </div>    
        
                    
                    <div class="row">
                        <div class="col-sm-12">
                        <a href="/profile/{{ $post->user->id }}">
                        <img src="{{ $post->photo }}" alt="" class="w-100">
                            </a>
                        </div>
                    
                    </div>
                    <!--
                    <div class="row d-flex mt-3">
                    <like-button class="col-sm-2" post-id="{{ $post->id }}" likes ="{{ $likes }}"></like-button>
                    <dt class="col-sm-2 text-align-center"><a href="/post/{{ $post->id }}"> {{$post->likes->count()}} </a> likes</dt>
                    
                    <dt class="col-sm-4 ml-2 text-align-center"><i class="fa fa-comment-o" aria-hidden="true"></i><a href="/post/{{ $post->id }}"> {{$post->commentarios->count()}} </a> comments</dt>
                    </div>
                    -->
                    <div class="mt-4 d-flex">
                    <!-- icones likes comments -->
                    <like-button post-id="{{ $post->id }}" likes ="{{ $likes }}"></like-button><!---->
                    <dt class="col-sm-2 text-align-center" style="width: fit-content; margin-left: 10px;"><a style="text-decoration: none; color: black" href="/post/{{ $post->id }}" > {{$post->likes->count()}}  likes</a></dt>
                    <i class="fa fa-comment-o" style="font-size:24px; margin-left: 25px" id="showcomm" aria-hidden="true"></i>
                    <dt class="col-sm-4 ml-2 text-align-center" style="width: fit-content; margin-left: 10px"><a style="text-decoration: none; color:black" href="/post/{{ $post->id }}"> {{$post->commentarios->count()}} comments </a></dt>
                    </div>
                    
               
                   
                </div>     
            </div>
            <div class="col-sm-3"></div>
        </div> 
        <!-- --> 
    @endforeach 

    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            
            {{$posts->links("pagination::bootstrap-4")}}
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    
    
@endsection