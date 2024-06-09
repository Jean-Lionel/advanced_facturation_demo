<?php

namespace App\Http\Livewire\Location;

use App\Models\Client;
use App\Models\ClientMaison;
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
        $clients =  ClientMaison::with('client')
        ->whereHas('client')
        ->where('maisonlocation_id',$this->maison)->get();
        return view('livewire.location.add-client', [
            'clients' => $clients
        ]);
    }
    
    public function updatedClientName(){
        $search = $this->clientName;
        if(strlen($search) > 0){ 
            $c = new Client();
            $columns = Schema::getColumnListing($c->getTable());
            $query = Client::query();
            $resultat =  $query->where(function ($q) use ($columns, $search) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $search . '%');
                }
            })->take(5)->get();
            $this->searchableClients =   $resultat;
        }else{
            $this->searchableClients = [];
        }
    }
    
    public function searchClient(){
        //dd("Searching for");
    }
    
    public function addClientToMaison($clientID){
        
        $check = ClientMaison::where('client_id', $clientID)
        ->where('maisonlocation_id', $this->maison)
        ->first();
        
        if( !$check ){
            ClientMaison::create([
                'client_id' => $clientID,
                'maisonlocation_id' => $this->maison,
            ]);
        }
        
    }
}
