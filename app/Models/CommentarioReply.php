<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentarioReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'commentario_id',
        'user_id',
        'commentario',
        'id',
        
    ];
    

    public function commentario(){
        return $this->belongsTo(Commentario::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
