<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    public function postfileuploader()
    {
       return $this->hasmany('App\PostFileUploader')->with('file');
    }
}
