<x-app-layout>
    <div class="mx-auto container px-2 mt-4">
        <div class="flex-1 text-2xl ml-2 mt-4 mb-2">{{__("Dashboard")}}</div>

        <div class="card border shadow">
            <livewire:user-analytics-graph :user="Auth::user()" />
        </div>

        <div class="card border shadow mt-2">
            <livewire:user-post-list :user="Auth::user()" />
        </div>
    </div>
</x-app-layout>
