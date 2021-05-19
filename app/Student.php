<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
class Student extends Authenticatable
{
    use Notifiable,HasRoles;
    protected $guard = 'student';

    protected $guarded =[];

    public function file()
    {
        return $this->belongsTo('App\File');
    }
    public function studentClass()
    {
        return $this->belongsTo('App\Course','class_id');
    }
}
