<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable=["use_id","content"];

    public function user(){
        return $this->belongsTo("App\User","use_id");
    }
}
