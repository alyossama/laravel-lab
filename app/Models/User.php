<?php

namespace App\Models;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
    ];


    public function post()
    {
        return $this->hasMany(Post::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
}
