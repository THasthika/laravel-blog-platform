<div class="flex items-center space-x-2">
    @if(Auth::user())
        @if($this->allowUpVote)
            <button title="Vote Up" class="btn btn-ghost btn-sm" wire:click="up_vote"><x-icon-up-vote/></button>
        @else
            <button title="Remove Vote" class="btn btn-ghost btn-sm" title="Revoke Vote" wire:click="remove_vote"><x-icon-x-mark/></button>
        @endif
        <div class="font-bold flex space-x-1 items-center">
            <span>Vote Count:</span><span>{{$post->voteCount}}</span>
        </div>
        @if($this->allowDownVote)
            <button title="Vote Down" class="btn btn-ghost btn-sm" wire:click="down_vote"><x-icon-down-vote/></button>
        @else
            <button title="Remove Vote" class="btn btn-ghost btn-sm" title="Revoke Vote" wire:click="remove_vote"><x-icon-x-mark/></button>
        @endif
    @else
        <div class="font-bold flex space-x-1 items-center">
            <span>Vote Count:</span><span>{{$post->voteCount}}</span>
        </div>
    @endif
</div>
