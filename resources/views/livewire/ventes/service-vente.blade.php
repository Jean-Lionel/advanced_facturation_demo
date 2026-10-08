<div>
    {{-- The whole world belongs to you. --}}
    <div class="card d-flex flex-row justify-content-between align-items-center">
        <h4>
            Facturation des Services
            @if ($brouillonId)
                <span class="badge badge-warning">Brouillon #{{ $brouillonId }}</span>
            @endif
        </h4>
        <a href="{{ route('brouillons.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fa fa-folder-open"></i> Mes brouillons
        </a>
    </div>

    @if ($successMessage)
    <div class="alert alert-success">{{ $successMessage }}</div>
    @endif

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

    @if (!$showPreview)

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

    @if (env('APP_USE_ASSURANCE', false))

    Supplement :
    <input type="number" wire:model="supplement"     class="form-control form-control-sm col-4"    placeholder="SUPPLEMENT">

    <div class="row">
        <div class="col-6">
            <h5>PATIENT :  {{number_format($parClient)}} </h5>
        </div>
        <div class="col-6">
            <h5> ASSURANCE [{{ $assuranceName }}] : {{number_format($parAssurance)}} </h5>
        </div>
    </div>

    @endif


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

            @if (filter_var(env('APP_USE_BANQUE', true), FILTER_VALIDATE_BOOLEAN))
                <div>
                    <label for="banque_id_service">BANQUE</label>
                    <select wire:model="banqueId" id="banque_id_service">
                        <option value="">Choisissez ...</option>
                        @foreach ($banques as $banque)
                            <option value="{{ $banque->id }}">
                                {{ $banque->display_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif

            <div>
                <label for="">TYPE DE MONNAIE</label>
                <select wire:model="invoice_currency" name="invoice_currency" id="">
                    @foreach (TYPE_MONNAIE as $item)
                    <option value="{{   $item}}"> {{ $item }}</option>
                @endforeach
                </select>

            </div>

            @if (env('APP_CAN_PRINT_PROFORMAT', false))
                <div>
                    <label for="" >TYPE DE FACTURE</label>
                <select required="" class="" wire:model="typeFacture" id="">
                    <option value="FACTURE">FACTURE</option>
                    <option value="PROFORMAT">PROFORMAT</option>
                </select>
                </div>
            @endif


            <div>
                <button class="ml-2 btn btn-sm btn-secondary" wire:click="saveBrouillon">
                    <span class="fa fa-save"></span>
                    Enregistrer brouillon
                </button>
                <button class="ml-2 btn btn-sm btn-primary" wire:click="previewFacture">
                    <span class="fa fa-eye"></span>
                    Aperçu &amp; valider
                </button>
            </div>
        </div>
        @if ($errorMessage)
        <div class="col-6 text-danger">
            {{ $errorMessage }}
        </div>
        @endif
       <div class="row">
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

        @if ($customer &&  env('APP_USE_ASSURANCE', false) &&  $customer->assuranceClients)

        <div class="col-6">

        <table class="table py-3 table-striped table-sm">
            <thead>
                <tr>
                    <th>NOM</th>
                    <th> CLIENT</th>
                    <th> ASSUREUR</th>
                    <th>DATE D'EXPIRATION</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customer->assuranceClients as $key => $assuranceClient)
                <tr>
                    <td>{{$assuranceClient?->assurance?->name}}</td>
                    <td>{{$assuranceClient->par_client}}%</td>
                    <td>{{$assuranceClient->par_assurance}}%</td>
                    <td>{{$assuranceClient->expire_date?->format('Y-m-d')}}</td>
                    <td>
                        <input type="checkbox" wire:click="toggleAssurance({{ $assuranceClient->id}}, {{ $assuranceClient->par_client }}, {{ $assuranceClient->par_assurance }} , '{{ $assuranceClient?->assurance?->name }}')" value="{{$assuranceClient->id}}" class="form-check-input" style="cursor: pointer;">
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>
        </div>
        @endif
       </div>


    </div>
    @else

    @php
        $typesPaiement = ['1' => 'en espèce', '2' => 'banque', '3' => 'à crédit', '4' => 'autres'];
        $banqueChoisie = $banqueId ? $banques->firstWhere('id', $banqueId) : null;
    @endphp

    <div class="card p-3">
        <h5 class="text-center">
            <i class="fa fa-eye"></i> Aperçu de la {{ $typeFacture == 'FACTURE' ? 'facture' : 'proforma' }}
        </h5>
        <p class="text-center text-muted small mb-3">
            Vérifiez les informations avant de confirmer.
            @if ($typeFacture == 'FACTURE')
                Une fois confirmée, la facture sera signée et ne pourra plus être modifiée.
            @endif
        </p>

        <div class="row mb-3">
            <div class="col-md-6">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between">CLIENT <b>{{ $customer->name ?? '' }}</b></li>
                    <li class="list-group-item d-flex justify-content-between">TELEPHONE <b>{{ $customer->telephone ?? '' }}</b></li>
                    <li class="list-group-item d-flex justify-content-between">ADRESSE <b>{{ $customer->addresse ?? '' }}</b></li>
                    <li class="list-group-item d-flex justify-content-between">NIF <b>{{ $customer->customer_TIN ?? '' }}</b></li>
                </ul>
            </div>
            <div class="col-md-6">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between">TYPE DE FACTURE <b>{{ $typeFacture }}</b></li>
                    <li class="list-group-item d-flex justify-content-between">TYPE DE PAIEMENT <b>{{ $typesPaiement[$typePaiement] ?? $typePaiement }}</b></li>
                    @if ($banqueChoisie)
                    <li class="list-group-item d-flex justify-content-between">BANQUE <b>{{ $banqueChoisie->display_name }}</b></li>
                    @endif
                    <li class="list-group-item d-flex justify-content-between">MONNAIE <b>{{ $invoice_currency }}</b></li>
                </ul>
            </div>
        </div>

        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Déscription</th>
                    <th>Quantité</th>
                    <th>Prix unitaire</th>
                    <th>TVA %</th>
                    <th>TVA</th>
                    <th>Prix HTVA</th>
                    <th>Prix Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($table_length as $key)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $description[$key] ?? '' }}</td>
                    <td>{{ $quantite[$key] ?? 0 }}</td>
                    <td>{{ number_format(floatval($prices[$key] ?? 0)) }}</td>
                    <td>{{ $taxes[$key] ?? 0 }} %</td>
                    <td>{{ number_format($tvas[$key] ?? 0) }}</td>
                    <td>{{ number_format($pricesHorTva[$key] ?? 0) }}</td>
                    <td>{{ number_format($pricesTVAC[$key] ?? 0) }}</td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="5">TOTAL</th>
                    <th>{{ number_format(array_sum(array_values($tvas))) }}</th>
                    <th>{{ number_format(array_sum(array_values($pricesHorTva))) }}</th>
                    <th>{{ number_format(array_sum(array_values($pricesTVAC))) }} {{ $invoice_currency }}</th>
                </tr>
            </tbody>
        </table>

        @if (env('APP_USE_ASSURANCE', false) && $assuranceID)
        <div class="row mb-3">
            <div class="col-6"><b>PATIENT :</b> {{ number_format($parClient) }}</div>
            <div class="col-6"><b>ASSURANCE [{{ $assuranceName }}] :</b> {{ number_format($parAssurance) }}</div>
        </div>
        @endif

        @if ($errorMessage)
        <div class="text-danger mb-2">{{ $errorMessage }}</div>
        @endif

        <div class="d-flex justify-content-end">
            <button class="btn btn-sm btn-outline-secondary mr-2" wire:click="cancelPreview">
                <span class="fa fa-arrow-left"></span> Modifier
            </button>
            <button class="btn btn-sm btn-secondary mr-2" wire:click="saveBrouillon">
                <span class="fa fa-save"></span> Enregistrer brouillon
            </button>
            <button class="btn btn-sm btn-success" wire:click="saveValue" wire:loading.attr="disabled" wire:target="saveValue">
                <span class="fa fa-check"></span> Confirmer et créer la {{ $typeFacture == 'FACTURE' ? 'facture' : 'proforma' }}
            </button>
        </div>
    </div>

    @endif
</div>
