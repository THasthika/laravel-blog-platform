<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Optional;
use Livewire\Component;
use PhpParser\Node\NullableType;

class PostEditor extends Component
{

    public Post $post;
    public bool $isNew = false;
    public Collection $categories;

    protected $rules = [
        'post.title' => 'required|string|min:6',
        'post.subtitle' => '',
        'post.category_id' => 'required',
        'post.content' => 'required|string'
    ];

    public string $tags = "";

    public string $initialPostContent = "";

    public function mount() {
        if ($this->isNew) {
            $this->post = new Post();
            $this->post->category_id = $this->categories[0]->id;
            return;
        }

        $this->initialPostContent = $this->post->content;

        $tags = $this->post->tags()->pluck('name')->toArray();
        $this->tags = join(',', $tags);
    }

    public function createNewTags($tags) {
        $existing_tags = Tag::query()->whereIn('name', $tags)->pluck('name')->toArray();
        $new_tags = array_diff($tags, $existing_tags);

        foreach ($new_tags as $tag) {
            $t = new Tag(['name' => trim($tag)]);
            $t->save();
        }
    }

    public function cleanInputTags() {
        $tags = [];
        $tag_sep = explode(",", strtolower($this->tags));
        foreach ($tag_sep as $tag) {
            $tags[] = $tag;
        }
        return $tags;
    }

    public function removeTags($existing_tags, $tags) {
        $tags_to_remove = array_diff($existing_tags, $tags);
        $this->post->tags()->whereIn('name', $tags_to_remove)->delete();
    }

    public function addTags($existing_tags, $tags) {
        $tags_to_add = array_diff($tags, $existing_tags);
        $tag_models_to_add = Tag::query()->whereIn('name', $tags_to_add)->get();
        $this->post->tags()->saveMany($tag_models_to_add);
    }

    public function save() {
        $this->validate();

        DB::transaction(function() {
            $this->post->user_id = Auth::user()->id;

            // update post
            $this->post->save();

            // update tags
            $tags = $this->cleanInputTags();
            $existing_tags = $this->post->tags()->pluck('name')->toArray();
            $this->createNewTags($tags);
            $this->removeTags($existing_tags, $tags);
            $this->addTags($existing_tags, $tags);

        });

        if ($this->isNew) {
            $this->redirect(route('post.show', ['id' => $this->post->id]));
        }

        session()->flash('message', 'Post successfully saved.');
    }

    public function render()
    {
        return view('livewire.post-editor');
    }
}
