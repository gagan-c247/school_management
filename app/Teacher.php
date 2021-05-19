<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
class Teacher extends Authenticatable
{
    use Notifiable,HasRoles;
    protected $guard = 'teacher';

    protected $guarded = [];

    public function file()
    {
        return $this->belongsTo('App\File');
    }
}
