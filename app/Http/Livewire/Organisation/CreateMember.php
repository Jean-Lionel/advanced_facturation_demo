<?php

namespace App\Http\Livewire\Organisation;

use Livewire\Component;

class CreateMember extends Component
{
    public $organisation;

    public function mount($organisation){
        $this->organisation = $organisation;
    }

    public function render()
    {
        return view('livewire.organisation.create-member');
    }

    public function increment(){
        dd("Bonjour ");
    }
}
