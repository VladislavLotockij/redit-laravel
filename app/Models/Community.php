<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Community extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'creator_id',
        'name',
        'description',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'community_user');
    }

    public function subscribe(User $user)
    {
        $this->followers()->attach($user);
        $this->increment('followers_count');
    }
    public function unsubscribe(User $user)
    {
        $this->followers()->detach($user);

        $this->decrement('followers_count');
    }
}
