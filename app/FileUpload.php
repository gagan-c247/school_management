<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{
    protected $guarded = [];

    public function file()
    {
        return $this->belongsTo('App\File');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
