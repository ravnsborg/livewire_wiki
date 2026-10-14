<?php

namespace App\Livewire;

use App\Models\Article;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class ArticleList extends Component
{
    public $articles = [];

    public $searchString = '';

    public $favorites = [];

    public function mount(): void
    {
        // Load favorite states, e.g., from database
        $this->favorites = Article::all()->pluck('is_favorite', 'id')->toArray();
    }

    public function render(): View
    {
        return view('livewire.article-list', [$this->articles]);
    }

    public function highlightMatch(string $text): ?string
    {
        if (! $this->searchString || strlen($this->searchString) < 3) {
            return $text;
        }

        $escaped = preg_quote($this->searchString, '/');

        return preg_replace(
            "/($escaped)/i",
            // '<span style="background-color: yellow; class="bg-green-100  text-yellow-300 font-semibold">$1</span>',
            '<span style="background-color: greenyellow; class="bg-green-100  text-yellow-300 font-semibold">$1</span>',
            $text // escape before highlighting
        );
    }

    #[On('article-list:articles-by-category')]
    public function getCategoryArticles(int $id): void
    {
        session()->flash('message', 'Post successfully updated.');
        $this->loadArticles('category_id', $id);
    }

    #[On('article-list:favorite-article')]
    public function getFavoriteArticlesByArticleId($id): void
    {
        session()->flash('message', 'Post successfully updated.');
        $this->loadArticles('id', $id);
    }

    #[On('article-list:search-keyword')]
    public function getArticlesByString(string $str): void
    {
        $this->searchString = $str;
        $this->reset('articles');
        $this->articles = Article::where('body', 'LIKE', '%'.$this->searchString.'%')
            ->orWhere('title', 'LIKE', '%'.$this->searchString.'%')
            ->get();
    }

    #[On('article-list:article')]
    public function getArticle(int $id): void
    {
        $this->reset('articles');
        $this->loadArticles('id', $id);
    }

    private function loadArticles(string $fieldName, int $fieldValue): void
    {
        $this->reset('articles');
        $this->articles = Article::where($fieldName, $fieldValue)->orderBy('title')->get();
    }

    /*
     * User updating favorite value.
     * Refresh favorite list component to update page contents
     */
    public function updateFavorite(int $articleId): void
    {
        $this->favorites[$articleId] = ! $this->favorites[$articleId];

        // Optionally persist the change in the database
        $article = Article::find($articleId);
        $article->is_favorite = $this->favorites[$articleId];
        $article->save();

        $this->dispatch('favorite-list:refresh-favorites');
    }
}
