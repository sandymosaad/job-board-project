<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

// to use many-many relationship
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Post;

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
        'phone',
        'password',
        'type',
        'image'
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
        'password' => 'hashed',
    ];
    //user has post relation

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    //user apply post relation
    public function appliedPosts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'applications', 'user_id', 'post_id')
            ->withPivot('resume', 'status')
            ->withTimestamps();
    }

    public function isEmployer(): bool
    {
        return $this->type === 'employer';
    }



    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}