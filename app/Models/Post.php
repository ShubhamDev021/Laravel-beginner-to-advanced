<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'title', 'description', 'is_active', 'is_published', 'deleted_at'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
