<x-app-layout>
    <div class="mx-auto container px-2 mt-4">
        <div class="text-2xl">{{__("Create Post")}}</div>
        <livewire:post-editor :categories="$categories" :isNew="true" />
    </div>
</x-app-layout>
