<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostFileUploader extends Model
{
    protected $guarded = [];

    public function file()
    {
        return $this->belongsTo('App\File','file_id');
    }
}
