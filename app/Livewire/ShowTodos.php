<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Todo;

class ShowTodos extends Component
{
    public $todos, $search, $title, $description, $todo_id;
    public $show = 'actived';
    public $isOpen = false;
    public $message;

    public function render()
    {
        $searchTerm = '%' . $this->search . '%';
        $this->todos = Todo::where('user_id', auth()->user()->id)
            ->where(function ($query) use ($searchTerm) {
                $query->where('title', 'like', $searchTerm)
                    ->orWhere('description', 'like', $searchTerm);
            });

        switch ($this->show) {
            case 'actived':
                $this->todos = $this->todos->where('completed', 0);
                break;
            case 'completed':
                $this->todos = $this->todos->where('completed', 1);
                break;
            case 'deleted':
                $this->todos = $this->todos->onlyTrashed();
                break;
            case 'all':
                $this->todos = $this->todos->withTrashed();
                break;
        }
        $this->todos = $this->todos->get();

        return view('livewire.show-todos');
    }

    public function openModal()
    {
        $this->resetErrorBag();
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function create()
    {
        $this->resetCreateForm();
        $this->openModal();
    }

    public function edit($id)
    {
        // get todo by id and current user id
        $todo = Todo::withTrashed()->where('id', $id)->where('user_id', auth()->user()->id)->first();

        $this->todo_id = $id;
        $this->title = $todo->title;
        $this->description = $todo->description;

        // open modal
        $this->openModal();
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
        ]);

        Todo::withTrashed()->updateOrCreate(['id' => $this->todo_id], [
            'title' => $this->title,
            'description' => $this->description,
            'user_id' => auth()->user()->id
        ]);

        $this->message = $this->todo_id ? 'Todo updated successfully.' : 'Todo created successfully.';

        $this->closeModal();
        $this->resetCreateForm();
    }

    public function delete($id)
    {
        $todo = Todo::withTrashed()->where('id', $id)->where('user_id', auth()->user()->id)->first();
        $todo->trashed() ? $todo->restore() : $todo->delete();
        
        $this->message = $todo->trashed() ? 'Todo deleted Successfully.' : 'Todo restored Successfully.';
    }

    public function complete($id)
    {
        $todo = Todo::where('id', $id)->where('user_id', auth()->user()->id)->first();
        $todo->update(['completed' => !$todo->completed]);
        
        $this->message = $todo->completed ? 'Todo completed Successfully.' : 'Todo activated Successfully.';
    }

    private function resetCreateForm()
    {
        $this->todo_id = null;
        $this->title = '';
        $this->description = '';
    }
}
