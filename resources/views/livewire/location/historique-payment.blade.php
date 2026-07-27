<div>
    <div class="row">
        <div wire:loading>
            @livewire('loading.checkout')
        </div>
    </div>

    <div class="p-3 border-bottom d-flex flex-wrap align-items-center" style="gap: 8px;">
        <input type="date" class="form-control form-control-sm" style="width: auto;" wire:model='startDate'>
        <input type="date" class="form-control form-control-sm" style="width: auto;" wire:model='endDate'>
        <button type="submit" class="btn btn-outline-primary btn-sm" wire:model='searchDate'>OK</button>
    </div>

    <div class="app-table-wrap">
        <table class="table table-sm app-table">
            <thead>
                <tr>
                    <th>ID Paiement</th>
                    <th>Client</th>
                    <th>Description du Service</th>
                    <th>Montant</th>
                    <th>Tax</th>
                    <th>Montant Total avec Tax</th>
                    <th>Periode de paiement</th>
                    <th>Date de Facturation</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                    <tr>
                        <td>{{ $payment->order?->id }}</td>
                        <td>{{ $payment->order?->client->name ?? "" }}</td>
                        <td>
                            <ul class="list-unstyled mb-0">
                                @foreach($payment->order?->products as $product)
                                    <li>{{ $product['name'] }}, Prix: {{ $product['price'] }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $payment->order?->amount }}</td>
                        <td>{{ $payment->order?->tax }}</td>
                        <td>{{ $payment->order?->amount_tax }}</td>
                        <td>{{ $payment->periode?->periode ?? '' }}</td>
                        <td>{{ $payment->order?->date_facturation ?? "" }}</td>
                        <td>
                            <a href="{{ route('orders.show',$payment->order?->id ) }}">Afficher</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="app-pagination">
        {{ $payments->links() }}
    </div>
</div>

<style>
    @media print {
        @page {
            size: landscape;
        }
        body {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    }
</style>
