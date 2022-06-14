<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;

class FollowsController extends Controller
{
    public function __construct() {
        $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    
    public function store(User $user) {

        return auth()->user()->following()->toggle( $user->profile );

    }

    public function following(User $user, Profile $profile) {
        $user = User::findOrfail( $profile->user_id );
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        $usersfo = $user->following()->pluck('profiles.user_id');
        //perfis pertencentes aos users q o user autentificado está a seguir
        $usersfff = Profile::whereIn('user_id',$usersfo)->latest()->get();

        return view("profile.following", compact('usersfff','follows'));

    }
    public function follower(User $user, Profile $profile) {
        $user = User::findOrfail( $profile->user_id );
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        
        $ufollow = $user->profile->followers()->pluck('users.id');
        //dd($ufollow);
        
        $usersfollower = Profile::whereIn('user_id',$ufollow)->latest()->get();
        //dd($usersfollower);

        return view("profile.followers", compact('usersfollower','follows'));

    }
}
