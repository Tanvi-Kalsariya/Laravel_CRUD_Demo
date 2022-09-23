<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HideShow extends Component
{
    public $data;
    public function render()
    {
        return view('livewire.hide-show');
    }
    public function archive()
    {
        $this->data = "<h1>Hello Aamir</h1>";
    }public function delete()
    {
        $this->data = "";
    }
}
