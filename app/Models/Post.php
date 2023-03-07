<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use HasUuids, HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function reactions(): BelongsToMany
    {
        return $this->belongsToMany(Reaction::class);
    }

    public function addReaction($user, $reaction)
    {
        $this->reactions()->attach($this->id, ['user_id' => $user->id, 'reaction_id' => $reaction->id]);
    }

    public function removeReaction($user)
    {
        $this->reactions()->detach(['user_id' => $user->id, 'post_id' => $this->id]);
    }

    public function getReactionCounts() : Collection
    {
        return $this->reactions()->selectRaw('reaction_id, count(*) as reaction_count')->groupBy(['reaction_id', 'post_id'])->get();
    }
}
