<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class Stories extends Component
{
    public $name;
    public $role;
    public $quote;
    public $achievement;
    public $image_path;
    public $rating = 5;
    public $is_featured = false;
    public $is_published = true;
    
    public $editingStoryId = null;
    public $isEditing = false;
    public $confirmingDelete = false;
    public $deleteId = null;
    
    protected $rules = [
        'name' => 'required|string|max:255',
        'role' => 'required|string|max:255',
        'quote' => 'required|string',
        'achievement' => 'required|string|max:255',
        'image_path' => 'nullable|string|max:255',
        'rating' => 'required|integer|min:1|max:5',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
    ];
    
    public function render()
    {
        $stories = \App\Models\Story::latest()->paginate(10);
        
        return view('livewire.admin.stories', [
            'stories' => $stories,
        ]);
    }
    
    public function edit($id)
    {
        $this->resetValidation();
        $this->isEditing = true;
        $this->editingStoryId = $id;
        
        $story = \App\Models\Story::findOrFail($id);
        $this->name = $story->name;
        $this->role = $story->role;
        $this->quote = $story->quote;
        $this->achievement = $story->achievement;
        $this->image_path = $story->image_path;
        $this->rating = $story->rating;
        $this->is_featured = $story->is_featured;
        $this->is_published = $story->is_published;
    }
    
    public function save()
    {
        $this->validate();
        
        \App\Models\Story::updateOrCreate(
            ['id' => $this->editingStoryId],
            [
                'name' => $this->name,
                'role' => $this->role,
                'quote' => $this->quote,
                'achievement' => $this->achievement,
                'image_path' => $this->image_path,
                'rating' => $this->rating,
                'is_featured' => $this->is_featured,
                'is_published' => $this->is_published,
            ]
        );
        
        $this->reset(['name', 'role', 'quote', 'achievement', 'image_path', 'rating', 'is_featured', 'is_published', 'editingStoryId', 'isEditing']);
        session()->flash('message', 'Success Story saved successfully.');
    }
    
    public function confirmDelete($id)
    {
        $this->confirmingDelete = true;
        $this->deleteId = $id;
    }
    
    public function delete()
    {
        \App\Models\Story::findOrFail($this->deleteId)->delete();
        $this->reset(['confirmingDelete', 'deleteId']);
        session()->flash('message', 'Success Story deleted successfully.');
    }
    
    public function cancel()
    {
        $this->reset(['name', 'role', 'quote', 'achievement', 'image_path', 'rating', 'is_featured', 'is_published', 'editingStoryId', 'isEditing', 'confirmingDelete', 'deleteId']);
        $this->resetValidation();
    }
}
