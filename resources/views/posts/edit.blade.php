<x-app-layout>
    <div class="mx-auto container px-2 mt-4">
        <div class="text-2xl flex items-center space-x-2">
            <span>
                {{__("Edit Post")}}
            </span>
            @if(Auth::user()->id == $post->user_id)
                <a title="Preview" href="{{route('post.show', ['id' => $post->id])}}"><x-icon-eye/></a>
            @endif
        </div>
        <livewire:post-editor :categories="$categories" :post="$post" :isNew="false" />
    </div>
</x-app-layout>
