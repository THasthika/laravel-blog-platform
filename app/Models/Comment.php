<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    use HasUuids, HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function up_votes(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Comment', 'comment_user_vote')->wherePivot('vote_type', 'UP');
    }

    public function down_votes(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Comment', 'comment_user_vote')->wherePivot('vote_type', 'DOWN');
    }

    public function votes(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Comment', 'comment_user_vote');
    }

    public function upVote($user)
    {
        $this->votes()->attach($this->id, ['vote_type' => 'UP', 'user_id' => $user->id]);
    }

    public function downVote($user)
    {
        $this->votes()->attach($this->id, ['vote_type' => 'DOWN', 'user_id' => $user->id]);
    }

    public function removeVote($user)
    {
        $this->votes()->detach(['comment_id' => $this->id, 'user_id' => $user->id]);
    }
}
