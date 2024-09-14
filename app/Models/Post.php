<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

// to use many-many relationship
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\User;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'deadline',
        'workType',
        'location',
        'skills',
        'salaryRange',
        'benefites',
        'logo',
        'category',
        'user_id'
    ];

    //user has post relation
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    //user apply post relation
    public function applicants(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'applications', 'post_id', 'user_id')->withPivot('resume', 'status')->withTimestamps();
    }



    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}