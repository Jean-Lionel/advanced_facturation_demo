<?php

namespace App\Http\Livewire\Repports;

use App\Models\Order;
use Livewire\Component;
use Carbon\Carbon;

class Tax extends Component
{
    public $startDate;
    public $endDate;
    public $amountTax;
    public $totalFacture;

    public function mount(){
        $this->startDate = Carbon::now()->subWeeks(10);
        $this->endDate = Carbon::now();
    }
    public function render()
    {
        $this->getTax();
        return view('livewire.repports.tax');
    }

    public function getTax(){
        $orders = Order::whereBetween('created_at', [$this->startDate , $this->endDate])->get();
        $this->amountTax = $orders->sum('amount_tax');
        $this->totalFacture =  $orders->count();
    }
}
