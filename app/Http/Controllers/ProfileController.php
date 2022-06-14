<?php

namespace App\Http\Controllers;
//use App\Models\Post;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

use Illuminate\Support\Facades\Cache;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
       
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    /**/public function show(Profile $profile)
    {
        $user = User::findOrfail( $profile->user_id );
        //dd($user);

        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        $postCount =Cache::remember(
            'count.posts.'.$user->id,
           now()->addSeconds(30),
            function () use($user) {
              return $user->posts->count();
          }); 

        $followersCount =Cache::remember(
            'count.followers.'.$user->id,
           now()->addSeconds(30),
            function () use($user) {
              return $user->profile->followers->count();
          });

        $followingCount =Cache::remember(
            'count.following.'.$user->id,
           now()->addSeconds(30),
            function () use($user) {
              return $user->following->count();
          }); 

        

        $followingFriend = $user->following()->pluck('profiles.user_id');
          //dd($followingFriend);

        
        $followguy = Profile::whereIn('user_id',$followingFriend)->with('user')->latest()->paginate(6);
        //dd($followguy);
          


        return view("profile.show", compact('user','follows', 'postCount', 'followersCount', 'followingCount', 'followguy'));
        

        return view("profile.show", ["user" => $user]);

       




    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        $this->middleware("auth");
        /*dd(Image::class);*/
        if(empty(auth()->user())){
            return redirect("/login");
        }

        $profile = auth()->user()->profile;

        return view("profile.edit", ["profile" => $profile]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        $this->middleware("auth");

        $data = request()->validate([
            "description" => ["required", "max:255"],
            "url" => ["url", "max:255"],
            "picture" => ["image"]

        ]); 

        $imagePath = auth()->user()->profile->picture;

        if(!empty($data["picture"])){
            /*fazemos o upload da imagem, recebemos a localização final e adicionamos 
            o caminho com o "storage" para ficar completo*/
            $imagePath = "/storage/". request("picture")->store("profiles", "public");

            /*
            podemos ajustar a imagem para um tamanho especifico ou outra alteração
            para isso, instalamos o Intervention Facades
            1) composer require intervention/image 
            2) colocar no topo do controller:
            use intervention\image\ImageManagerStatic as Image;
            3) no caso abaixo, como concatenámos uma barra no inicio do imagePath, temos
            que a retirar para o Image::make(), usando o comando ltrim()*/
            

            Image::make( public_path( ltrim($imagePath, '/') ) )->fit(150, 150)->save();
        }


        auth()->user()->profile()->update([
            "description" => $data["description"],
            "url" => $data["url"],
            "picture" => $imagePath
        ]);

        return redirect("/home");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile,User $user)
    {
        
        
        $profile->delete();
        
        return redirect()->to('/login');
        
    }

    public function search(User $user, Profile $profile){
        $search_text = $_GET['namesearch'];
        //$findprofile = User::where('name','LIKE', '%'.$search_text. '%')->first();
        $findprofile = User::where('name','LIKE', '%'.$search_text. '%')->get();
    
        return view('profile.search', compact('findprofile'));
    }












}
