<?php

namespace App\Http\Livewire\Location;

use App\Models\Order;
use App\Models\PaymentLocationMensuel;
use Livewire\Component;

class HistoriquePayment extends Component
{
    public $search = '';
    public $startDate;
    public $endDate;
    private $p =[];

    public function mount(){
        // get payment about location
    }
    public function updatedSearch()
    {
        // $this->payments = Order::with(['client', 'company'])
        //     ->whereHas('client', function ($query) {
        //         $query->where('name', 'like', '%' . $this->search . '%');
        //     })
        //     ->get();
    }

    public function render()
    {
        $this->searchInvoices();
        return view('livewire.location.historique-payment', [
            'payments' => $this->p,
        ]);
    }

    public function searchData(){
        $this->searchInvoices();
        
    }

    private function searchInvoices(){
        $s_date = $this->startDate;
        $e_date = $this->endDate;
        $this->p =   PaymentLocationMensuel::with(['order' , 'periode'])
        ->wherehas('order')
        ->where(function($query) use($s_date,$e_date ) {
            if($s_date && $e_date){
                $query->whereBetween('created_at', [$this->startDate, $this->endDate]);
            }
        })
        ->latest()->paginate(10);
    }
}