<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;
    //use Commentable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'caption', 'photo',
    ];

    public function user() {
        return $this->belongsTo( User::class );
    }

    public function likes() {
        return $this->belongsToMany( User::class );
    }

    public function commentarios() {
        return $this->hasMany( Commentario::class );
    }

    
}
