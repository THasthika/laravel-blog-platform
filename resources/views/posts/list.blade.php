<x-app-layout>
<div class="mx-auto container px-2 mt-4">
    <div class="flex items-center">
        <div class="flex-1 text-2xl">{{__("All Posts")}}</div>
        <div class="pr-2 pt-2">
            <a href="{{route('post.create')}}" class="btn">Post +</a>
        </div>
    </div>
    <div class="">
        @foreach($posts as $post)
            <x-post-list-item :post="$post" />
        @endforeach
    </div>
    <div class="mt-2 mb-4">
        {{ $posts->links() }}
    </div>
</div>
</x-app-layout>
