<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="row">
        <div wire:loading>
          @livewire('loading.checkout')
        </div>
    </div>
    <div>
        <div class="col-md-12 mb-3">
            <p class="mb-1 font-weight-bold">Maisons à payer</p>
            <input type="text" placeholder="Rechercher par nom ou description" wire:model.debounce.300ms="houseNumber" class="form-control">
        </div>
        @if (count($maisonLocations))
        <div class="table-responsive">
            <table class="table table-sm table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Maison</th>
                        <th>Montant Mensuel (HTVA)</th>
                        <th>TVA</th>
                        <th>Montant Mensuel (TTC)</th>
                        <th>Client</th>
                        @foreach ($periodes as $periode)
                        <th>{{ getMonthName($periode->month) }} {{ $periode->year }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($maisonLocations as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ getPrice($item->montant) }}</td>
                        <td>{{ getPrice($item->tax) }}</td>
                        <td>{{ $item->priceTTC }}</td>
                        <td>
                            <ol class="mb-0 pl-3">
                                @foreach ($item->clients as $el)
                                <li>{{ $el->name }} — {{ $el->telephone }}</li>
                                @endforeach
                            </ol>
                        </td>
                        @foreach ($periodes as $periode)
                        <td>
                            @if ($this->isPeriodePaid($item->id, $periode->id, $item->montant))
                                <span class="badge badge-success">Payé</span>
                            @else
                                <a
                                    href="{{ route('payment-location-mensuel.payer', ['maisonLocation' => $item->id, 'periode' => $periode->id, 'return' => 'payment-location-mensuel']) }}"
                                    class="btn btn-primary btn-sm"
                                >Payer</a>
                            @endif
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="text-muted">Aucune maison avec locataire trouvée.</p>
        @endif
    </div>
</div>
