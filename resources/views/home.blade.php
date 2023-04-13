<x-app-layout>
    <div class="container mx-auto px-2 mt-4">
        <div id="latest-posts">
            <div>
                <div class="flex-1 text-2xl">{{__("Latest Posts")}}</div>
            </div>
            <div class="">
                @foreach($latest_posts as $post)
                    <x-post-list-item :post="$post" />
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
