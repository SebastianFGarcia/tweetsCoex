<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'user_id',
        'tweets_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function tweet(){
        return $this->belongsTo(Tweet::class);
    }
    
}
