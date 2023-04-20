<x-app-layout>
    <div class="mx-auto container px-2 mt-4">
        <div class="flex-1 text-2xl ml-2 mt-4 mb-2">{{__("Notifications")}}</div>

        <div>
            <div class="flex flex-col space-y-4">
                @foreach($notifications as $notification)
                    <div class="border mx-2 p-4">
                        <div>{{$notification->content}}</div>
                        <div class="mt-2">{{$notification->created_at->diffForHumans()}}</div>
                    </div>
                @endforeach
            </div>
            <div>
                {{$notifications->links()}}
            </div>
        </div>
    </div>
</x-app-layout>
