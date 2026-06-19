<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class BlogPage extends Component
{
    public $selectedPost = null;

    public function openPost($postId)
    {
        $this->selectedPost = Post::find($postId);
    }

    public function closePost()
    {
        $this->selectedPost = null;
    }

    public function render()
    {
        $posts = Post::with('admin')
            ->orderByDesc('is_pinned')
            ->orderByDesc('created_at')
            ->get();

        return view('livewire.blog-page', [
            'posts' => $posts
        ])->layout('livewire.layout.home.master');
    }
}
