@extends('layouts.app')

@section('content')
<div class="container mt-5">
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 mt-3 p-3" style="">
        @foreach ($findprofile as $find)

            <div class="row mb-3 p-3" style="background: #D9DCDC; border-radius: 5px">
                <div class="col-md-3">
                <a href="/profile/{{ $find->id }}">
                    <img src="{{ $find->profile->picture }}" alt="" class="rounded-circle"> 
                </a>
                </div>

                <div class="col-md-7">
                    <div class="d-flex justify-content-between align-items-baseline">
                        <div class="d-flex align-items-center pb-2">
                        <div class="h4">{{ $find->username }}</div>
                        @if(Auth::id() != $find->profile->id)
                        <follow-button user-id="{{ $find->id }}" follows ="{{ (auth()->user()) ? auth()->user()->following->contains($find->id) : false; }}"></follow-button>
                        @endif
                        @if(Auth::id() == $find->profile->id)
                        <div class="col-md-4 m-2" style="background: #D9DCDC; border-radius: 5px;">
                        <a class="dropdown-item" href="/post/create">{{ __('Create Post') }}</a>
                        </div>
                        <div class="col-md-4" style="background: #D9DCDC; border-radius: 5px;">
                        <a class="dropdown-item" href="/profile/edit">{{ __('Edit Profile') }}</a>
                        </div>
                        @endif
                        </div>
                    </div>
                </div>

            <div class="d-flex">
                <div class="p-1"><strong>{{ $find->posts->count() }}</strong> posts</div>
                <div class="p-1"><strong>{{ $find->profile->followers->count() }}</strong> followers</div>
                <div class="p-1"><strong>{{ $find->following->count() }}</strong> following</div>
            </div><!---->

                <div class="profile mt-2">
                    <h2 class="h6 font-weight-bold">{{ $find->name }}</h2>
                    <p>{{ $find->profile->description }}</p>
                    <div>
                        <a href="//{{ $find->profile->url }}">{{ $find->profile->url }}</a>
                    </div>
                    
                </div>

            </div>
        
        @endforeach
    </div>
    <div class="col-md-3"></div>
</div>
</div>
@endsection