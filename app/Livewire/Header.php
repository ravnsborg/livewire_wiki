<?php

namespace App\Livewire;

use App\Models\Entity;
use App\Models\Link;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Header extends Component
{
    public $links = [];

    public $selectedEntity = [];

    public $entities = [];

    public $selectedEntityId = null;

    /*
     * Refresh entity and reload page to that entity's content
     */
    public function refreshEntity(int $entityId): void
    {
        // Only update if entity id exists
        $entity = Entity::find($entityId);
        if ($entity) {
            $user = User::where('preferred_entity_id', Auth::user()->preferred_entity_id)->first();
            $user->preferred_entity_id = $entityId;
            $user->save();
        }

        $this->redirect('/');
    }

    public function mount(): void
    {
        $this->entities = Entity::select('title', 'id')->where('user_id', Auth::user()->id)->orderBy('title')->get();
        $this->selectedEntity = $this->entities->find(Auth::user()->preferred_entity_id);
        $this->selectedEntityId = $this->selectedEntity->id;
        $this->links = Link::orderBy('title')->get();
    }

    public function render(): View
    {
        return view('livewire.header');
    }
}
