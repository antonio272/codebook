@extends('layouts.app')

@section('content')
<div class="container mt-5">
<div class="row">
<div class="col-md-3"></div>
<div class="col-md-6" style="background: #ffffff;">
<div class="row">
        <div class="col-md-3">
        @if(Auth::id() != $user->profile->id)
        <a href="">
            <img src="{{ $user->profile->picture }}" alt="" class="rounded-circle"> 
        </a>
        @elseif(Auth::id() == $user->profile->id)
        <a href="{{ url('/home') }}">
            <img src="{{ $user->profile->picture }}" alt="" class="rounded-circle"> 
        </a>
        @endif
        </div>
        <div class="col-md-7">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-center pb-2">
                <div class="h4">{{ $user->username }}</div>
                @if(Auth::id() != $user->profile->id)
                <follow-button user-id="{{ $user->id }}" follows ="{{ $follows }}"></follow-button>
                @endif
                @if(Auth::id() == $user->profile->id)
                <div class="col-md-4 m-2" style="background: #D9DCDC; border-radius: 5px;">
                <a class="dropdown-item" href="/post/create">{{ __('Create Post') }}</a>
                </div>
                <div class="col-md-4" style="background: #D9DCDC; border-radius: 5px;">
                <a class="dropdown-item" href="/profile/edit">{{ __('Edit Profile') }}</a>
                </div>
                @endif
            </div>
            </div>

            <div class="d-flex">
                <div class="p-1"><strong>{{ $postCount }}</strong> posts</div>
                <a href='/profile/{{ $user->profile->id }}/followers' style="text-decoration: none; color:black">
                <div class="p-1"><strong>{{ $followersCount }}</strong> followers</div>
                </a>
                <a href='/profile/{{ $user->profile->id }}/following' style="text-decoration: none; color:black">
                <div class="p-1"><strong>{{ $followingCount }}</strong> following</div>
                </a>
            </div>

            <div class="profile mt-2">
                <h2 class="h6 font-weight-bold">{{ $user->name }}</h2>
                <p>{{ $user->profile->description }}</p>
                <div>
                    <a href="//{{ $user->profile->url }}">{{ $user->profile->url }}</a>
                </div>
                
                </div>

        </div>
    </div>

    <div class="follows mt-5 p-3 text-black" style="background: #E4E8E6">
            <div class="pl-3 mt-2 mb-3 ">
                <h5>
                    <strong>
                    following ({{ $followingCount }} people)
                    </strong>
                </h5>
            </div>   
            <div class="row d-flex">
                        @foreach ($followguy as $fg)
                            <div class="col-sm-2">
                            <a href="/profile/{{ $fg->user->id }}">
                            <img src="{{ $fg->picture }}" alt="" class="rounded-circle" style="width: 100px">
                            </a>
                            <h2 class="h6 font-weight-bold mt-4">{{ $fg->user->name }}</h2>
                            </div>
                            
                        @endforeach 
            </div>
    </div>

    <div class="row posts mt-5">
    @foreach ($user->posts as $post)
        <div class="col-md-4 mt-4">
            <a href="/post/{{ $post->id }}">
            <img class="w-100" src="{{ $post->photo }}" alt="{{ $post->caption }}" srcset="">
            </a>
            
        </div>
    @endforeach
    </div>
    </div>
    </div>
    <div class="col-md-3"></div>
</div>
@endsection
