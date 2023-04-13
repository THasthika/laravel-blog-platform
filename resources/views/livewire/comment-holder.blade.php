<div class="mt-3">
    <div>Comments</div>
    <hr/>
    <div class="mt-2">
        <form wire:submit.prevent="post_comment">
            <textarea class="textarea textarea-bordered w-full" placeholder="Write a comment..." wire:model.debounce.500ms="new_comment"></textarea>
            <button type="submit" class="btn btn-sm btn-secondary">Post Comment</button>
        </form>
    </div>
    <div>
        @foreach($comments as $comment)
            <div class="border my-2 p-2">
                <div class="flex">
                    <div class="flex-1">
                        {{$comment->content}}
                    </div>
                    @if($comment->user_id == Auth::user()->id)
                        <div>
                            <button class="btn btn-sm btn-ghost" wire:click="delete_comment('{{$comment->id}}')">
                                <x-icon-trash/>
                            </button>
                        </div>
                    @endif
                </div>
                <div class="text-right">
                    <div class="">{{$comment->user->username}}</div>
                    <div class="">{{$comment->created_at->diffForHumans()}}</div>
                </div>
            </div>
        @endforeach
    </div>
    <div>{{$comments->links()}}</div>
</div>
