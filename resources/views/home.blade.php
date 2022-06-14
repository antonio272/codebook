@extends('layouts.app')

@section('content')
<div class="container mt-5">
<div class="row">
        <div class="col-md-3">
            <img src="{{ Auth::user()->profile->picture }}" alt="" class="rounded-circle"> 
        </div>
        <div class="col-md-7">
            <h1>{{ Auth::user()->username }}</h1>
            <dl class="d-flex">
                <dt>387</dt>
                <dd class="pl-1 pr-4">posts</dd>
                <dt>42.8m</dt>
                <dd class="pl-1 pr-4">followers</dd>
                <dt>9</dt>
                <dd class="pl-1 pr-4">following</dd>
            </dl>
            <div class="profile">
                <h2 class="h6 font-weight-bold">{{ Auth::user()->name }}</h2>
                <p>{{ Auth::user()->profile->description }}</p>
                <div>
                    <a href="//{{ Auth::user()->profile->url }}">{{ Auth::user()->profile->url }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row posts mt-5">
    @foreach (Auth::user()->posts as $post)
        <div class="col-md-4">
            <img class="w-100" src="{{ $post->photo }}" alt="{{ $post->caption }}" srcset="">
        </div>
    @endforeach
    </div>
</div>
@endsection