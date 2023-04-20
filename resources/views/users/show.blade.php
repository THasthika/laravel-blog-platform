<x-app-layout>
    <div class="container mx-auto">
        <div class="mt-4 mx-4">
            <div class="text-2xl">{{$user->username}}</div>
        </div>
        <div class="md:flex mt-4 mx-4">
            <div class=" max-w-200">
                <img class="border" src="{{$user->imageUrl}}"/>
            </div>
            <div class="text-center md:text-left">
                <div class="my-4">
                    <span class="ml-4 mr-2">Username:</span>
                    <span class="font-bold">{{$user->username}}</span>
                </div>
                <div class="my-4">
                    <span class="ml-4 mr-2">Name:</span>
                    <span class="font-bold">
                        <span>{{$user->first_name}}</span>
                        <span>{{$user->last_name}}</span>
                    </span>
                </div>
                <div class="my-4">
                    <span class="ml-4 mr-2"># of Posts:</span>
                    <span class="font-bold">{{$post_count}}</span>
                </div>
            </div>
        </div>
        <div>
            <div class="p-4">
            <div class="text-lg">{{__("Posts")}}</div>
            <div>
                @if(sizeof($user_posts) > 0)
                    @foreach($user_posts as $post)
                        <x-post-list-item :post="$post" />
                    @endforeach
                @else
                    <div class="border rounded text-center font-bold p-8">
                        <div>No Posts...</div>
                    </div>
                @endif
                {{$user_posts->links()}}
            </div>
        </div>
    </div>
</x-app-layout>
