<?php

namespace App\Livewire;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CategoryForm extends Component
{
    #[Validate('required|min:2')]
    public string $categoryTitle = '';

    #[Validate('required|min:2')]
    public string $articleTitle = '';

    #[Validate('required|min:2')]
    public string $articleContent = '';

    public ?int $entityId = null;

    public function mount(): void
    {
        $this->entityId = Auth::user()->preferred_entity_id;
    }

    /*
     * Create new category and its child article
     */
    public function save(): void
    {
        $this->validate();

        Category::create([
            'title' => $this->categoryTitle,
            'entity_id' => $this->entityId,
        ])->articles()->create([
            'title' => $this->articleTitle,
            'body' => $this->articleContent,
        ]);

        $this->redirect('/');
    }

    public function render(): View
    {
        return view('livewire.category-form');
    }
}
