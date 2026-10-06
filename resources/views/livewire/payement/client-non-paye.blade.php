<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="row">
        <div wire:loading>
            @livewire('loading.checkout')
          </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
           {{ " Liste des Locataires qui n'ont pas payé pour une Periode de paiement " }}
        </div>
        <div class="col-md-4">
            <select wire:model="periodeID" id="" class="form-control form-control-sm">
                <option value=""></option>
                @foreach ($periodeList as $item)
                <option value="{{ $item->id }}"> {{ $item->periode }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 text-right">
            <button onclick="window.print()" class="btn btn-sm btn-primary">
                <i class="fas fa-print"></i> Imprimer
            </button>
        </div>
    </div>
    <style>
        @media print {
            .no-print { display: none; }
            body * { visibility: hidden; }
            #printable, #printable * { visibility: visible; }
            #printable {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
        }
    </style>
    <div>

        @if ($isLoading)
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
          </div>
        @endif
    </div>
    @if ($curentNonPay)
    <div id="printable">
        <h4 class="text-center mb-3">Liste des Locataires Non Payés</h4>
        <p class="text-center mb-3">Période: {{ $periodeList->firstWhere('id', $periodeID)->periode ?? 'Toutes périodes' }}</p>
        <table class="table  ">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Maison </th>
                    <th>Locataire</th>
                    <th>
                        Montant Non Payé
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($curentNonPay as  $item)
                <tr>
                    <td>{{  ++ $loop->index}}</td>
                    <td>{{  $item->name }}</td>
                    <td>
                        @foreach ($item->clients as $c)
                        <p>
                            {{ $c->name }} TEL : {{ $c->telephone}}
                        </p>
                        @endforeach
                    </td>
                    <td>
                        {{ $item->periode }}
                    </td>
                    <td>
                        {{ $item->montant }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
