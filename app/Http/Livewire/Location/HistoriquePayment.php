<?php

namespace App\Http\Livewire\Location;

use App\Models\Order;
use Livewire\Component;

class HistoriquePayment extends Component
{
    public $payments;
    public $search = '';

    public function mount(){
        $this->payments = Order::all();
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
        return view('livewire.location.historique-payment');
    }
}