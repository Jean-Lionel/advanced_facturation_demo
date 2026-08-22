<div>
    {{-- The whole world belongs to you. --}}
    <div class="card">
        <h4>{{ $isEditMode ? 'Modification du Proforma' : 'Facturation des Services' }}</h4>
    </div>

    @if ( count($errors) )
    <div
        class="alert alert-danger alert-dismissible fade show"
        role="alert"
    >
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>

    @endif

    <script>
        var alertList = document.querySelectorAll(".alert");
        alertList.forEach(function (alert) {
            new bootstrap.Alert(alert);
        });
    </script>



    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Déscription</th>
                <th>Quantité</th>
                <th>Prices</th>
                <th>TVA %</th>
                <th>TVA </th>
                <th>Prix HTVA</th>
                <th>Prix Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $table_length as $key )
            <tr>
                <td>{{ ++$loop->index }}</td>
                <td>
                    <textarea class="form-control form-control-sm" wire:model="description.{{ $key }}"></textarea>
                </td>
                <td>
                    <input type="number" class="form-control form-control-sm"  wire:model="quantite.{{ $key }}">
                </td>
                <td>
                    <input type="number" class="form-control form-control-sm"  wire:model="prices.{{ $key }}">
                </td>
                <td>
                    <select class="form-control form-control-sm" wire:model="taxes.{{ $key }}">
                        @foreach ([0,4,10,18] as $v )
                        <option value="{{ $v }}" @if ( isset($taxes[$key]) and $v == $taxes[$key])
                        selected
                        @endif> {{ $v }} %</option>
                        @endforeach
                    </select>
                </td>
                <th>
                    {{ number_format( $tvas[$key] ?? 0 ) }}
                </th>
                <th>
                    {{ number_format( $pricesHorTva[$key] ?? 0 )}}
                </th>
                <th>
                    {{  number_format(  $pricesTVAC[$key] ?? 0 )}}
                </th>
                <td>
                    <button class="btn btn-danger" wire:click="removeItem({{  $key }})">
                        <span class="fa fa-trash"></span>
                    </button>
                </td>
            </tr>
            @endforeach
            <tr>
                <th colspan="5"> TOTAL </th>
                <th>{{ number_format( array_sum( array_values($tvas)))   }}</th>
                <th>{{ number_format( array_sum( array_values($pricesHorTva) ) )   }}</th>
                <th>{{ number_format(array_sum( array_values($pricesTVAC) )) }}</th>
            </tr>
            <tr>
                <td colspan="8"></td>
                <td>
                    <button class="btn btn-sm btn-primary"
                    wire:click="addColumn"
                    >
                    <span class="fa fa-plus"></span>
                    Ajouter </button>

                </td>
            </tr>
        </tbody>
    </table>

    <div class="card mb-3">
        <div class="card-body">
            <label for="commentaire" class="form-label"><strong>Commentaire (affiché sur la facture)</strong></label>
            <textarea
                class="form-control"
                wire:model="commentaire"
                id="commentaire"
                rows="3"
                placeholder="Ajouter un commentaire qui sera affiché sur la facture..."></textarea>
        </div>
    </div>

    <div class="card">
        <div class="col-12 d-flex justify-content-between">
            <div>
                <label for="" class="mr-3">NUMERO DE CLIENT</label>
                <input type="text" class="justify-content-between" wire:model="clientNumber">
                <button class="btn btn-info btn-sm" wire:click="searchClient">Search</button>
            </div>
            <div>
                <label for="" class="mr-3">TYPE DE PAIEMENT</label>
            <select required="" class="" wire:model="typePaiement" id="">
                <option value="">Choisissez ...</option>
                <option value="1">en espèce</option>
                <option value="2">banque</option>
                <option value="3">à crédit</option>
                <option value="4">autres</option>
            </select>
            </div>

            <div>
                <label for="">TYPE DE MONNAIE</label>
                <select wire:model="invoice_currency" name="invoice_currency" id="">
                    @foreach (TYPE_MONNAIE as $item)
                    <option value="{{   $item}}"> {{ $item }}</option>
                @endforeach
                </select>

            </div>

            @if (env('APP_CAN_PRINT_PROFORMAT', false) && !$isEditMode)
                <div>
                    <label for="" >TYPE DE FACTURE</label>
                <select required="" class="" wire:model="typeFacture" id="">
                    <option value="FACTURE">FACTURE</option>
                    <option value="PROFORMA">PROFORMA</option>
                </select>
                </div>
            @endif


            <button class="ml-4 btn btn-sm btn-primary"
            wire:click="saveValue"
            >
            <span class="fa fa-{{ $isEditMode ? 'save' : 'file' }}"></span>
            {{ $isEditMode ? 'Mettre à jour' : 'Valider' }}  </button>
        </div>
        @if ($errorMessage)
        <div class="col-6 text-danger">
            {{ $errorMessage }}
        </div>
        @endif
        @if ($customer)
        <div class="col-6">
            {{-- {{ $customer }} --}}
            <i class="fa fa-list-ul" aria-hidden="true"></i>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    NOM
                    <b class="">
                        {{ $customer->name }}
                    </b>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    TELEPHONE
                    <b class="">
                        {{ $customer->telephone }}
                    </b>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    ADRESSE
                    <b class="">
                        {{ $customer->addresse }}
                    </b>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    NIF
                    <b class="">
                        {{ $customer->customer_TIN }}
                    </b>
                </li>
            </ul>
        </div>
        @endif


    </div>
</div>
