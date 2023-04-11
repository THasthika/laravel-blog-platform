<x-app-layout>
    <div class="container mx-auto px-2 mt-4">
        @if($post)
            <livewire:show-post :post="$post" />
        @else
            <div>Post Not Found!</div>
        @endif
    </div>
</x-app-layout>
