<x-app-layout>
    <div class="container mx-auto px-2 mt-4">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block mb-4">
                <strong>{{ $message }}</strong>
            </div>
        @endif
        @if($post)
            <article>
                <div class="mb-4">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <h1 class="text-2xl">
                                {{$post->title}}
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
                @if($post->cover_image)
                    <div class="w-full my-4">
                        <img class="w-full object-cover max-h-60" alt="Post Cover" src="{{asset('storage'.$post->cover_image)}}"/>
                    </div>
                @endif
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
