<x-app-layout>

    <div class="container mx-auto px-2 mt-4">
        @if($post)
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
            </article>
        @else
            <div>Post Not Found!</div>
        @endif
    </div>

</x-app-layout>
