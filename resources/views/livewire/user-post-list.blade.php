<div class="p-4">
    <div class="text-lg">{{__("My Posts")}}</div>

    <div class="flex flex-col space-y-4 mt-4">

        @foreach($user_posts as $post)
            <div class="border rounded">
                <div class="pt-2 px-2 flex justify-between">
                    <div class="flex space-x-2">
                        <div class="flex space-x-1" title="View Count">
                            <x-icon-eye/>
                            <span>{{$post->view_count}}</span>
                        </div>
                        <div class="flex space-x-1" title="Up Vote Count">
                            <x-icon-up-vote/>
                            <span>{{$post->up_vote_count}}</span>
                        </div>
                        <div class="flex space-x-1" title="Down Vote Count">
                            <x-icon-down-vote/>
                            <span>{{$post->down_vote_count}}</span>
                        </div>
                    </div>
                    <div>
                        <a href="{{route('post.show', ['id' => $post->id])}}" class="btn btn-ghost btn-sm" title="{{__("View Post")}}">
                            <x-icon-eye/>
                        </a>
                        <a href="{{route('post.edit', ['id' => $post->id])}}" class="btn btn-ghost btn-sm" title="{{__("Edit Post")}}">
                            <x-icon-edit/>
                        </a>
                        <button wire:click="triggerDelete('{{$post->id}}')" class="btn btn-ghost btn-sm text-error" title="{{__("Delete Post")}}">
                            <x-icon-trash/>
                        </button>
                    </div>
                </div>
                <div class="p-4 md:flex md:flex-row">
                    <div class="md:flex-1">
                        <div class="text-lg font-bold">{{$post->title}}</div>
                        @if($post->subtitle)
                            <div class="text-xs">{{$post->subtitle}}</div>
                        @endif
                    </div>
                    <div class="text-right md:text-left">
                        <div class="">{{$post->created_at->diffForHumans()}}</div>
                    </div>
                </div>
            </div>
        @endforeach

        {{$user_posts->links()}}

    </div>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            @this.on('triggerPostDelete', post_id => {
                Swal.fire({
                    title: 'Are You Sure?',
                    html: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                }).then((result) => {
                    if (result.value) {
                        @this.call('deletePost', post_id);
                    }
                });
            });
        })
    </script>

</div>
