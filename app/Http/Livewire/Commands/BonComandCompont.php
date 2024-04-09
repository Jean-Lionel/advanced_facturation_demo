<?php

namespace App\Http\Livewire\Commands;

use App\Models\Client;
use Livewire\Component;

class BonComandCompont extends Component
{
    public $founisseurs;
    public $search;

    public function render()
    {
        $this->getFournsseur(); //
        return view('livewire.commands.bon-comand-compont');
    }

    public function getFournsseur($name = ''){

        $this->founisseurs = Client::where(function($query) use ($name){
            if(isset($name)){
                $query->where('name', 'like', '%' . $name . '%')
                    ->orWhere('telephone', 'like', '%' . $name . '%')
                    ->orWhere('addresse', 'like', '%' . $name . '%')
                    ->orWhere('description', 'like', '%' . $name . '%')
                    //->orWhere('email', 'like', '%' . $name . '%')
                    ;
            }
        })->where('is_fournisseur','=',Client::$FOURNISSEUR)->get();

    }
}
