<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostVote extends Model
{
    use HasFactory;

//    protected $primaryKey = ['post_id', 'user_id'];

    protected $fillable = [
        'post_id',
        'user_id',
        'vote_type'
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
