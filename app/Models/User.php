<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'firstName',
        'lastName'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'fullName'
    ];

    public function getFullNameAttribute()
    { return "{$this['firstName']} {$this['lastName']}"; }

    public function skills()
    { return $this->belongsToMany(Skill::class, 'users_skills', 'userId', 'skillId'); }

    public function vacations()
    { return $this->hasMany(Vacation::class, 'userId', 'id'); }

    public function department()
    { return $this->belongsTo(Department::class); }

    public function departments()
    { return $this->hasMany(Department::class, 'managerId', 'id'); }
}
