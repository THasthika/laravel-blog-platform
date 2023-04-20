<div id="post-edit-container">
    <form wire:submit.prevent="save">
        @if (session()->has('success'))
            <div class="alert alert-success mt-2">
                {{ session('success') }}
            </div>
        @endif
        <div>
            <div class="form-control w-full">
                <label class="label" for="post-title">
                    <span class="label-text">Cover Image</span>
                </label>
                <input type="file" wire:model="postCoverImage" class="file-input w-full max-w-xs" />
                @error('postCoverImage')
                <label class="label">
                    <span class="label-text text-error">{{ $message }}</span>
                </label>
                @enderror
                @if($post->cover_image)
                    <div class="w-full my-4 relative">
                        <div class="absolute right-0">
                            <button type="button" wire:click="$emit('triggerCoverDelete')" class="btn-error">
                                <x-icon-trash/>
                            </button>
                        </div>
                        <img class="w-full object-cover max-h-60" alt="Post Cover" src="{{asset('storage'.$post->cover_image)}}"/>
                    </div>
                @endif
            </div>
        </div>
        <div class="md:flex md:space-x-2">
            <div class="form-control w-full">
                <label class="label" for="post-title">
                    <span class="label-text">Title</span>
                </label>
                <input type="text" wire:model="post.title" id="post-title" placeholder="Title" class="input input-bordered w-full" />
                @error('post.title')
                <label class="label">
                    <span class="label-text text-error">{{ $message }}</span>
                </label>
                @enderror
            </div>
            <div class="form-control w-full">
                <label class="label" for="post-subtitle">
                    <span class="label-text">Subtitle</span>
                </label>
                <input type="text" wire:model="post.subtitle" id="post-subtitle" placeholder="Subtitle" class="input input-bordered w-full" />
                @error('post.subtitle')
                <label class="label">
                    <span class="label-text text-error">{{ $message }}</span>
                </label>
                @enderror
            </div>
        </div>
        <div class="md:flex md:space-x-2">
            <div class="form-control w-full">
                <label class="label" for="post-category">
                    <span class="label-text">Category</span>
                </label>
                <select id="post-category" class="select select-bordered" wire:model="post.category_id">
                    <option disabled selected>Category</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                @error('post.category_id')
                <label class="label">
                    <span class="label-text text-error">{{ $message }}</span>
                </label>
                @enderror
            </div>
            <div class="form-control w-full">
                <label class="label" for="post-tags">
                    <span class="label-text">Tags</span>
                </label>
                <div class="relative">
                    <input type="text" id="post-tags" wire:model="tags" placeholder="Tags" class="input input-bordered w-full" />
                </div>
            </div>
        </div>
        <div class="mt-4">
            <div wire:ignore>
                <textarea wire:model="post.content" name="content" id="editor">{{$initialPostContent}}</textarea>
            </div>
            @error('post.content')
            <label class="label">
                <span class="label-text text-error">{{ $message }}</span>
            </label>
            @enderror
        </div>
        <div class="mt-4">
            <button class="btn btn-primary" type="submit">Save</button>
        </div>
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            ClassicEditor
                .create(document.querySelector('#editor'), {
                    toolbar: ['undo', 'redo', '|', 'heading', '|', 'bold', 'italic', '|', 'numberedList', 'bulletedList']
                })
                .then(editor => {
                    editor.model.document.on('change:data', () => {
                    @this.set('post.content', editor.getData());
                    })
                })
                .catch(error => {
                    console.error(error);
                });

        @this.on('triggerCoverDelete', () => {
            Swal.fire({
                    title: 'Are You Sure?',
                    html: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                }).then((result) => {
                    if (result.value) {
                        @this.call('deleteCoverImage');
                    }
                });
            });
        });
    </script>
    </script>
</div>
