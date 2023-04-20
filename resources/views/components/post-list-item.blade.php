<a href="{{route('post.show', ['id' => $post->id])}}" class="mx-4 mt-2">
    <div class="card shadow-md border hover:cursor-pointer">
        <div class="card-body md:flex md:flex-row">
            <div class="md:flex-1">
                <div class="text-lg font-bold">{{$post->title}}</div>
                @if($post->subtitle)
                    <div class="text-xs">{{$post->subtitle}}</div>
                @endif
            </div>
            <div class="text-right md:text-left">
                <div class="">{{$post->user->username}}</div>
                <div class="">{{$post->created_at->diffForHumans()}}</div>
            </div>
        </div>
    </div>
</a>
