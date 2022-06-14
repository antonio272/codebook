
@extends('layouts.app')

@section('content')
<div class="container mt-5">
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 mt-3 p-3" style="">
        @foreach ($usersfff as $user)

            <div class="row mb-3 p-3" style="background: #D9DCDC; border-radius: 5px">
                <div class="col-md-3">
                <a href="/profile/{{ $user->id }}">
                    <img src="{{ $user->user->profile->picture }}" alt="" class="rounded-circle"> 
                </a>
                </div>

                <div class="col-md-7">
                    <div class="d-flex justify-content-between align-items-baseline">
                        <div class="d-flex align-items-center pb-2">
                        <div class="h4">{{ $user->username }}</div>
                        @if(Auth::id() != $user->user->profile->id)
                        <follow-button user-id="{{ $user->id }}" follows ="{{ (auth()->user()) ? auth()->user()->following->contains($user->id) : false; }}"></follow-button>
                        @endif
                        @if(Auth::id() == $user->user->profile->id)
                        
                        @endif
                        </div>
                    </div>
                </div>

            <div class="d-flex">
                <div class="p-1"><strong>{{ $user->user->posts->count() }}</strong> posts</div>
                <div class="p-1"><strong>{{ $user->user->profile->followers->count() }}</strong> followers</div>
                <div class="p-1"><strong>{{ $user->user->following->count() }}</strong> following</div>
            </div><!---->

                <div class="profile mt-2">
                    <h2 class="h6 font-weight-bold">{{ $user->name }}</h2>
                    <p>{{ $user->user->profile->description }}</p>
                    <div>
                        <a href="//{{ $user->user->profile->url }}">{{ $user->user->profile->url }}</a>
                    </div>
                    
                </div>

            </div>
        
        @endforeach
    </div>
    <div class="col-md-3"></div>
</div>
</div>
@endsection



