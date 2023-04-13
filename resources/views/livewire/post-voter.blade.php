<div class="flex items-center space-x-2">
    @if(Auth::user())
        @if($this->allowUpVote)
            <button class="btn btn-ghost btn-sm" wire:click="up_vote"><x-icon-up-vote/></button>
        @else
            <button class="btn btn-ghost btn-sm" title="Revoke Vote" wire:click="remove_vote"><x-icon-x-mark/></button>
        @endif
        <div class="font-bold">
            {{$post->voteCount}}
        </div>
        @if($this->allowDownVote)
            <button class="btn btn-ghost btn-sm" wire:click="down_vote"><x-icon-down-vote/></button>
        @else
            <button class="btn btn-ghost btn-sm" title="Revoke Vote" wire:click="remove_vote"><x-icon-x-mark/></button>
        @endif
    @else
        <div>
            {{$post->voteCount}}
        </div>
    @endif
</div>
