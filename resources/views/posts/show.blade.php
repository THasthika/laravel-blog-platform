<x-app-layout>
    <div class="container mx-auto px-2 mt-4">
        @if($post)
            <article>
                <div class="mb-4">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <h1 class="text-2xl">
                                {{$post->title}}
                                @if(Auth::user() && Auth::user()->id == $post->user_id)
                                    <a href="{{route('post.edit', ['id' => $post->id])}}">(Edit)</a>
                                @endif
                            </h1>
                            @if($post->subtitle)
                                <h2 class="text-md">{{$post->subtitle}}</h2>
                            @endif
                        </div>
                        <div>
                            <livewire:post-voter :post="$post" />
                        </div>
                    </div>
                    <hr/>
                </div>
                <div class="mb-20">
                    {!! $post->content !!}
                </div>
                <livewire:comment-holder :post="$post" />
            </article>
        @else
            <div>Post Not Found!</div>
        @endif
    </div>
</x-app-layout>
