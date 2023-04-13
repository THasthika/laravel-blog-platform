<x-app-layout>
    <div class="mx-auto container px-2 mt-4">
        <div class="text-2xl">{{__("Edit Post")}}
            @if(Auth::user()->id == $post->user_id)
                <a href="{{route('post.show', ['id' => $post->id])}}">(Preview)</a>
            @endif
        </div>
        <livewire:post-editor :categories="$categories" :post="$post" :isNew="false" />
    </div>
</x-app-layout>
