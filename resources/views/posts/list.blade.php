<x-app-layout>
<div class="mx-auto container px-2 mt-4">

    <div class="md:flex gap-4">
        <div class="md:flex-1">
            <div class="text-right pr-2 pt-2">
                <a href="{{route('post.create')}}" class="btn">Post +</a>
            </div>
            <div class="text-2xl ml-2 mt-4 mb-2">{{__("All Posts")}}</div>
            <div class="">
                @foreach($posts as $post)
                    <a href="{{route('post.show', ['id' => $post->id])}}" class="mx-4 mt-2">
                        <div class="card shadow-md hover:cursor-pointer">
                            <div class="card-title px-4 pt-2">
                                <div class="text-lg">{{$post->title}}</div>
                            </div>
                            <div class="card-body">
                                @if($post->subtitle)
                                    <div class="text-xs">{{$post->subtitle}}</div>
                                @endif
                                <div class="text-right w-full">
                                    <div class="">{{$post->user->username}}</div>
                                    <div class="">{{$post->updated_at->diffForHumans()}}</div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="md:w-1/5 mt-4 md:mt-0">
            <div class="card shadow-md m-2">
                <div class="card-title">Sidebar</div>
                <div class="card-body">xxx</div>
            </div>
        </div>
    </div>

</div>
</x-app-layout>
