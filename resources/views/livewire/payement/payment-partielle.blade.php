<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="row">
        <div wire:loading>
            @livewire('loading.checkout')
          </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            Liste de ceux qui n ont pas encore payer la totalite 
        </div>
        <div class="col-md-6">
            <select name="" id="" wire:model="periodeID">
                @foreach ($periodes as $item)
                    <option value="{{  $item->id}}"> {{ $item->name }} </option>
                @endforeach
            </select>
        </div>
    </div>

    @if ($paiementPartiel)
   <table class="table table-striped ">
    <thead>
        <tr>
            <th>#</th>
            <th>Place</th>
            <th>
                Client
            </th>
            <th>
                Periode de paiment
            </th>
            <th>Montant</th>
        </tr>
    </thead>

    <tbody>
        
        @foreach ($paiementPartiel as $key => $items)
           <tr>
            <td>    {{ ++$loop->index }}</td>
            @php
                $maison = getMaisonById($key);
                $total_payment = 0;
            @endphp
            <td>{{ $maison->name }}</td>
            <td>
                @foreach ($maison->clients as $item)
                    <p>Name : {{ $item->name }} || PHONE : {{ $item->telephone }}</p>
                @endforeach
            </td>
            <td>
                <table>
                    <tr>
                        <th>Date</th>
                        <th>Monatant</th>
                    </tr>

                    @foreach ($items as $item)
                    @php
                         $total_payment = $item->total_payment_mensuel;
                    @endphp
                        <tr>
                            <td>{{ $item->date_paiement->format('d/m/Y') }}</td>
                            <td>{{ $item->montant }}</td>
                        </tr>
                    @endforeach
                </table>
            </td>
            <td>
                <p>Total Payé :  {{ $items->sum('montant') }}  </p>
                <p>RESTE : {{ $total_payment - $items->sum('montant')  }}</p>
                <p> {{ "Montant qu'il devra payer" }} {{  $total_payment }}</p>
              
            </td>

           </tr> 
        @endforeach
    </tbody>
   </table>

   @endif
</div>
