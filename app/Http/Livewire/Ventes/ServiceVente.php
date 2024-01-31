<?php

namespace App\Http\Livewire\Ventes;

use Livewire\Component;

class ServiceVente extends Component
{
    public $table_length = [];
    public $description = [];
    public function render()
    {
        return view('livewire.ventes.service-vente');
    }

    public function saveValue(){
        dd($this->description);
    }

    public function addColumn(){
        $this->table_length[] = count($this->table_length )  +1;
    }
    public function removeItem($id){
        $this->table_length= array_filter($this->table_length, function($v) use ($id) {
            return $v != $id;
        });
        $this->description= array_filter($this->description, function($v) use ($id) {
            return $v != $id;
        }, ARRAY_FILTER_USE_KEY);

    }
}
