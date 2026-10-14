<?php

namespace App\Livewire;

use App\Models\Article;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

#[On('favorite-list:refresh-favorites')]
class FavoriteList extends Component
{
    public function render(): View
    {
        $favoriteArticles = Article::where('is_favorite', 1)->orderBy('title')->get();

        return view('livewire.favorite-list', ['favoriteArticleList' => $favoriteArticles]);
    }
}
