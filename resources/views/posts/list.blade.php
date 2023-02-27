<x-app-layout>
<div class="mx-auto container mt-4">

    <div class="flex gap-4">
        <div class="flex-1">
            <div class="text-2xl ml-2 mt-4 mb-2">Recent Posts</div>
            <div class="">
                @foreach($posts as $post)
                    <div class="">
                        <div class="">
                            <div class="text-lg">{{$post->title}}</div>
                            @if($post->subtitle)
                                <div class="text-xs">{{$post->subtitle}}</div>
                            @endif
                            <div class="text-right w-full">
                                <div class="">{{$post->user->username}}</div>
                                <div class="">{{$post->updated_at->diffForHumans()}}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="w-1/5">xx</div>
    </div>

</div>
</x-app-layout>
