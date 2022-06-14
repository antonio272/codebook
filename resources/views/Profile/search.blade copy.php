@extends('layouts.app')

@section('content')
<div class="container mt-5">
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
    {{ $findprofile }}
        <!--<div class="row">
        <div class="col-md-3">
        <a href="{{ url('/') }}">
            <img src="{{ $findprofile->profile->picture }}" alt="" class="rounded-circle"> 
        </a>
        </div>
        <div class="col-md-7">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-center pb-2">
                <div class="h4">{{ $findprofile->username }}</div>
                @if(Auth::id() != $findprofile->profile->id)
                <follow-button user-id="{{ $findprofile->id }}" follows ="{{ $follows }}"></follow-button>
                @endif
                @if(Auth::id() == $findprofile->profile->id)
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
                <div class="p-1"><strong>{{ $followersCount }}</strong> followers</div>
                <div class="p-1"><strong>{{ $followingCount }}</strong> following</div>
            </div>

            <div class="profile mt-2">
                <h2 class="h6 font-weight-bold">{{ $findprofile->name }}</h2>
                <p>{{ $findprofile->profile->description }}</p>
                <div>
                    <a href="//{{ $findprofile->profile->url }}">{{ $findprofile->profile->url }}</a>
                </div>
                
                </div>

        </div>-->
    </div>
    <div class="col-md-3"></div>
</div>
</div>
@endsection