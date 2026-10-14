<?php

namespace App\Livewire;

use App\Models\Entity;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EntityForm extends Component
{
    #[Validate('required|min:2')]
    public string $entityTitle = '';

    public function save(): void
    {
        $this->validate();

        Entity::create([
            'title' => $this->entityTitle,
            'user_id' => Auth::user()->id,
        ]);

        $this->redirect('/');
    }

    public function render(): View
    {
        return view('livewire.entity-form');
    }
}
