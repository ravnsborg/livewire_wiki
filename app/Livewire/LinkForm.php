<?php

namespace App\Livewire;

use App\Models\Link;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class LinkForm extends Component
{
    use WithPagination;

    public $url = '';

    public $title = '';

    public $editingId = null;

    public $showForm = false;

    protected $rules = [
        'url' => 'required|url|max:255',
        'title' => 'required|string|max:255',
    ];

    public function render()
    {
        return view('livewire.link-form', [
            'urls' => Link::where('entity_id', Auth::user()->preferred_entity_id)
                ->latest()
                ->paginate(10),
        ]);
    }

    public function create()
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->editingId) {
            $url = Link::findOrFail($this->editingId);
            $url->update([
                'url' => $this->url,
                'title' => $this->title,
                'entity_id' => Auth::user()->preferred_entity_id,
            ]);
            session()->flash('message', 'URL updated successfully.');
        } else {
            Link::create([
                'url' => $this->url,
                'title' => $this->title,
                'entity_id' => Auth::user()->preferred_entity_id,
            ]);
            session()->flash('message', 'URL created successfully.');
        }

        $this->resetForm();
    }

    public function edit($id)
    {
        $url = Link::where('entity_id', Auth::user()->preferred_entity_id)->findOrFail($id);
        $this->editingId = $url->id;
        $this->url = $url->url;
        $this->title = $url->title;
        $this->showForm = true;
    }

    public function delete($id)
    {
        Link::where('entity_id', Auth::user()->preferred_entity_id)
            ->findOrFail($id)
            ->delete();
        session()->flash('message', 'URL deleted successfully.');
    }

    public function cancel()
    {
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->reset(['url', 'title', 'editingId', 'showForm']);
        $this->resetValidation();
    }
}
