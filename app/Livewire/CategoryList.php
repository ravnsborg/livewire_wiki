<?php

namespace App\Livewire;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CategoryList extends Component
{
    public function render(): View
    {
        $categoryList = Category::where('entity_id', Auth::user()->preferred_entity_id)->orderBy('title')->get();

        return view('livewire.category-list', ['categoryList' => $categoryList]);
    }
}
