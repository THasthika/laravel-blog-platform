<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Post extends Model
{
    use HasUuids, HasFactory;

    public function getVoteCountAttribute(): int
    {
        $votes = $this->votes()->select(['vote_type'])->pluck('vote_type')->toArray();
        $up_vote_count = 0;
        $down_vote_count = 0;
        foreach ($votes as $vote) {
            if ($vote == 'UP') {
                $up_vote_count += 1;
            } else {
                $down_vote_count += 1;
            }
        }
        return $up_vote_count - $down_vote_count;
    }

    public function getUpVoteCountAttribute(): int
    {
        return $this->votes()->where('vote_type', 'UP')->count();
    }

    public function getDownVoteCountAttribute(): int
    {
        return $this->votes()->where('vote_type', 'DOWN')->count();
    }

    public function getViewCountAttribute(): int
    {
        return $this->views()->count();
    }



    public function canUpVoteBy($user_id): bool
    {
        $x = $this->votes()->where(['user_id' => $user_id, 'post_id' => $this->id, 'vote_type' => 'UP'])->count();
        return $x == 0;
    }

    public function canDownVoteBy($user_id): bool
    {
        $x = $this->votes()->where(['user_id' => $user_id, 'post_id' => $this->id, 'vote_type' => 'DOWN'])->count();
        return $x == 0;
    }

    public function upVoteBy($user)
    {
        $this->votes()->insert(['vote_type' => 'UP', 'user_id' => $user->id, 'post_id' => $this->id]);
    }

    public function downVoteBy($user)
    {
        $this->votes()->insert(['vote_type' => 'DOWN', 'user_id' => $user->id, 'post_id' => $this->id]);
    }

    public function removeVoteBy($user)
    {
        $this->votes()->where(['post_id' => $this->id, 'user_id' => $user->id])->delete();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): HasOne
    {
        return $this->hasOne(Category::class);
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function votes(): HasMany
    {
        return $this->hasMany(PostVote::class);
    }

    public function views(): HasMany
    {
        return $this->hasMany(PostView::class);
    }

}
