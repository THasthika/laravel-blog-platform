<article>
    <div class="mb-4">
        <h1 class="text-4xl">{{$post->title}}</h1>
        @if($post->subtitle)
            <h2 class="text-lg">{{$post->subtitle}}</h2>
        @endif
        <hr/>
    </div>
    <div>
        {{$post->content}}
    </div>
    <div class="flex mt-5">
        <div class="flex flex-col text-center">
            <span>{{__("Votes")}}</span>
            @if(Auth::user())
                @if($this->allowUpVote)
                    <x-secondary-button wire:click="up_vote"><x-icon-up-vote/></x-secondary-button>
                @else
                    <x-secondary-button title="Revoke Vote" wire:click="remove_vote"><x-icon-x-mark/></x-secondary-button>
                @endif
                <div>
                    {{$post->voteCount}}
                </div>
                @if($this->allowDownVote)
                    <x-secondary-button wire:click="down_vote"><x-icon-down-vote/></x-secondary-button>
                @else
                    <x-secondary-button title="Revoke Vote" wire:click="remove_vote"><x-icon-x-mark/></x-secondary-button>
                @endif
            @else
                <div>
                    {{$post->voteCount}}
                </div>
            @endif
        </div>

    </div>
</article>
