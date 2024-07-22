<?php

namespace App\Http\Livewire\Rapports;

use App\Models\OrderInteret;
use Carbon\Carbon;
use Livewire\Component;

class RapportRevenu extends Component
{
    public $startDate;
    public $endDate;
    public $revenues;

    public function mount(){
        $this->endDate = Carbon::tomorrow()->format('Y-m-d');
        $this->startDate = Carbon::yesterday()->format('Y-m-d');
    }
    public function render()
    {
       $this->searchInteret();
        return view('livewire.rapports.rapport-revenu');
    }

   private function searchInteret(){
        
        $intererts = OrderInteret::whereBetween('created_at', [
            $this->startDate, $this->endDate
        ])->get()->map->description ?? [];
        $result = [
            "Informaticien" =>  0,
            "Client" =>  0,
            "Commisionnaire" =>  0,
            "Entreprise" => 0
        ];
        foreach($intererts as $interert){
            $v = json_decode($interert);
            $result['Client'] += $v->partage->Client;
            $result['Informaticien'] += $v->partage->Informaticien;
            $result['Commisionnaire'] += $v->partage->Commisionnaire;
            $result['Entreprise'] += $v->partage->Entreprise;
        }
       $this->revenues = $result;
        return  $result;
   }
}
