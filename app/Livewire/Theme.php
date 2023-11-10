<?php

namespace App\Livewire;

use Livewire\Component;

class Theme extends Component
{
    public $status = true;

    public function render()
    {
        if(session()->get('theme') == 'dark')
            $this->status = false;
        return view('livewire.theme', ['status' => $this->status]);
    }

    public function clicked($theme)
    {
        if ($theme === 'dark') {
            session(['theme' => 'light']);
            $this->status = true;
        } else {
            session(['theme' => 'dark']);
            $this->status = false;
        }            
    }
}
