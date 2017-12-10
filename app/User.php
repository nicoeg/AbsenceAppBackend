<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'api_token', 'group_id', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'teacher' => 'boolean'
    ];

    public function AbsenceMessages() {
        return $this->hasMany(AbsenceMessage::class);
    }

    public function Attendances() {
        return $this->hasMany(Attendance::class);
    }

    public function groups() {
        return $this->belongsToMany(Group::class, 'group_user');
    }
}
