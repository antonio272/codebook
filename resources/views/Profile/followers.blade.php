@extends('layouts.app')

@section('content')
<div class="container mt-5">
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 mt-3 p-3" style="">
        @foreach ($usersfollower as $userx)

            <div class="row mb-3 p-3" style="background: #D9DCDC; border-radius: 5px">
                <div class="col-md-3">
                <a href="/profile/{{ $userx->id }}">
                    <img src="{{ $userx->user->profile->picture }}" alt="" class="rounded-circle"> 
                </a>
                </div>

                <div class="col-md-7">
                    <div class="d-flex justify-content-between align-items-baseline">
                        <div class="d-flex align-items-center pb-2">
                        <div class="h4">{{ $userx->username }}</div>
                        @if(Auth::id() != $userx->user->profile->id)
                        <follow-button user-id="{{ $userx->id }}" follows ="{{ (auth()->user()) ? auth()->user()->following->contains($userx->id) : false; }}"></follow-button>
                        @endif
                        @if(Auth::id() == $userx->user->profile->id)
                        
                        @endif
                        </div>
                    </div>
                </div>

            <div class="d-flex">
                <div class="p-1"><strong>{{ $userx->user->posts->count() }}</strong> posts</div>
                <div class="p-1"><strong>{{ $userx->user->profile->followers->count() }}</strong> followers</div>
                <div class="p-1"><strong>{{ $userx->user->following->count() }}</strong> following</div>
            </div><!---->

                <div class="profile mt-2">
                    <h2 class="h6 font-weight-bold">{{ $userx->name }}</h2>
                    <p>{{ $userx->user->profile->description }}</p>
                    <div>
                        <a href="//{{ $userx->user->profile->url }}">{{ $userx->user->profile->url }}</a>
                    </div>
                    
                </div>

            </div>
        
        @endforeach
    </div>
    <div class="col-md-3"></div>
</div>
</div>
@endsection

