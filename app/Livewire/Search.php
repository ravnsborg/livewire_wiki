<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Search extends Component
{
    public $searchText = '';

    public function render(): View
    {
        $this->reset('searchText');

        return view('livewire.search');
    }
}
