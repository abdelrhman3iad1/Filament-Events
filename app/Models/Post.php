<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Post extends Model 
{
    use Notifiable;
    protected $fillable = [
        'user_id' , 'title','content','image'
    ] ;

    public function user(){
        return $this->belongsTo(User::class);
    }
}
