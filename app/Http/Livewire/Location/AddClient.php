<?php

namespace App\Http\Livewire\Location;

use App\Models\Client;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;

class AddClient extends Component
{
    public $maison;
    public $clientName;
    public $searchableClients = [];


    public function mount($maison_id){
        $this->maison = $maison_id;
    }
    public function render()
    {
        $clients =  [];
        return view('livewire.location.add-client');
    }

    public function updatedClientName(){
        $c = new Client();
        $columns = Schema::getColumnListing($c->getTable());
        $query = Client::query();
        $search = $this->clientName;
        $resultat =  $query->where(function ($q) use ($columns, $search) {
            foreach ($columns as $column) {
                $q->orWhere($column, 'LIKE', '%' . $search . '%');
            }
        })->take(5)->get();

        $this->searchableClients =   $resultat;
       
    }

    public function searchClient(){
        //dd("Searching for");
    }

    public function addClientToMaison($clientID){

        dd($clientID);
    }
}
