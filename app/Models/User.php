<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function post() {
        return $this->hasOne(Post::class, 'user_id', 'id')->where('title', 'test')->withDefault(['key' => 'Laravel post']);
    }

    public function postComment() {
        return $this->hasOneThrough(Comment::class, Post::class);
    }

    public function posts() {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    public function postComments() {
        return $this->hasManyThrough(Comment::class, Post::class);
    }

    public function roles() {
        return $this->belongsToMany(Role::class);
    }
}
