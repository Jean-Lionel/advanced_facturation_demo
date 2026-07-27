<div class="vente-stack" id="service-vente-root">
    <section class="vente-card">
        <header class="vente-card-header">
            <h2 class="vente-card-heading">Facturation des Services</h2>
            <div class="vente-actions">
                <button type="button" class="btn vente-btn vente-btn-accent" wire:click="addColumn">
                    <span class="fa fa-plus"></span> Ajouter
                </button>
            </div>
        </header>

        @if (count($errors))
            <div class="vente-card-body vente-card-body--tight">
                <div class="alert alert-danger alert-dismissible fade show app-alert mb-0" role="alert">
                    <ul class="mb-0 pl-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif

        <div class="vente-table-card vente-table-card--flush">
            <table class="vente-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Déscription</th>
                        <th>Quantité</th>
                        <th>Prix</th>
                        <th>TVA %</th>
                        <th class="col-num">TVA</th>
                        <th class="col-num">Prix HTVA</th>
                        <th class="col-num">Prix Total</th>
                        <th class="col-action">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($table_length as $key)
                        <tr>
                            <td class="col-center">{{ ++$loop->index }}</td>
                            <td>
                                <textarea class="form-control form-control-sm" wire:model="description.{{ $key }}"></textarea>
                            </td>
                            <td>
                                <input type="number" class="form-control form-control-sm" wire:model="quantite.{{ $key }}">
                            </td>
                            <td>
                                <input type="number" class="form-control form-control-sm" wire:model="prices.{{ $key }}">
                            </td>
                            <td>
                                <select class="form-control form-control-sm" wire:model="taxes.{{ $key }}">
                                    @foreach ([0, 4, 10, 18] as $v)
                                        <option value="{{ $v }}" @if (isset($taxes[$key]) and $v == $taxes[$key]) selected @endif>
                                            {{ $v }} %
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="col-num">{{ number_format($tvas[$key] ?? 0) }}</td>
                            <td class="col-num">{{ number_format($pricesHorTva[$key] ?? 0) }}</td>
                            <td class="col-num">{{ number_format($pricesTVAC[$key] ?? 0) }}</td>
                            <td class="col-action">
                                <button type="button" class="btn vente-btn vente-btn-danger" wire:click="removeItem({{ $key }})" title="Supprimer">
                                    <span class="fa fa-trash"></span>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <th colspan="5">TOTAL</th>
                        <th class="col-num">{{ number_format(array_sum(array_values($tvas))) }}</th>
                        <th class="col-num">{{ number_format(array_sum(array_values($pricesHorTva))) }}</th>
                        <th class="col-num">{{ number_format(array_sum(array_values($pricesTVAC))) }}</th>
                        <th></th>
                    </tr>
                </tbody>
            </table>
        </div>

        @if (env('APP_USE_ASSURANCE', false))
            <div class="vente-card-body">
                <div class="vente-form-grid">
                    <div class="vente-field">
                        <label>Supplément</label>
                        <input type="number" wire:model="supplement" class="form-control form-control-sm" placeholder="SUPPLEMENT">
                    </div>
                </div>
                <div class="mt-2 vente-summary-grid">
                    <div class="vente-summary-item">
                        <h6>Patient</h6>
                        <h4>{{ number_format($parClient) }}</h4>
                    </div>
                    <div class="vente-summary-item is-primary">
                        <h6>Assurance [{{ $assuranceName }}]</h6>
                        <h4>{{ number_format($parAssurance) }}</h4>
                    </div>
                </div>
            </div>
        @endif
    </section>

    <div class="vente-split">
        <section class="vente-card">
            <header class="vente-card-header">
                <h2 class="vente-card-heading">Information du client</h2>
                <a href="{{ route('clients.create') }}" class="btn vente-btn vente-btn-accent">Nouveau client</a>
            </header>

            <div class="vente-card-body">
                <div class="vente-field vente-client-search" wire:ignore>
                    <label for="chercherClientService">Recherche client</label>
                    <div class="vente-client-search-wrap">
                        <i class="fas fa-search" aria-hidden="true"></i>
                        <input
                            type="search"
                            id="chercherClientService"
                            placeholder="Nom, téléphone ou NIF..."
                            class="form-control"
                            autocomplete="off"
                        >
                    </div>
                </div>

                @if ($errorMessage)
                    <div class="text-danger small mb-2">{{ $errorMessage }}</div>
                @endif

                <div class="vente-client-panel {{ $customer ? '' : 'is-empty' }}">
                    @if ($customer)
                        <div class="vente-client-panel-content">
                            <div class="vente-client-panel-name">{{ $customer->name }}</div>
                            <div class="vente-client-panel-grid">
                                <div>
                                    <span>Téléphone</span>
                                    <b>{{ $customer->telephone ?: '—' }}</b>
                                </div>
                                <div>
                                    <span>NIF</span>
                                    <b>{{ $customer->customer_TIN ?: '—' }}</b>
                                </div>
                                <div class="vente-client-panel-full">
                                    <span>Adresse</span>
                                    <b>{{ $customer->addresse ?: '—' }}</b>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="vente-client-panel-empty">
                            Aucun client sélectionné
                        </div>
                    @endif
                </div>

                @if ($customer && env('APP_USE_ASSURANCE', false) && $customer->assuranceClients)
                    <div class="mt-3 vente-table-card">
                        <table class="vente-table">
                            <thead>
                                <tr>
                                    <th>NOM</th>
                                    <th>CLIENT</th>
                                    <th>ASSUREUR</th>
                                    <th>DATE D'EXPIRATION</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customer->assuranceClients as $key => $assuranceClient)
                                    <tr>
                                        <td>{{ $assuranceClient?->assurance?->name }}</td>
                                        <td>{{ $assuranceClient->par_client }}%</td>
                                        <td>{{ $assuranceClient->par_assurance }}%</td>
                                        <td>{{ $assuranceClient->expire_date?->format('Y-m-d') }}</td>
                                        <td class="col-center">
                                            <input
                                                type="checkbox"
                                                wire:click="toggleAssurance({{ $assuranceClient->id}}, {{ $assuranceClient->par_client }}, {{ $assuranceClient->par_assurance }} , '{{ $assuranceClient?->assurance?->name }}')"
                                                value="{{ $assuranceClient->id }}"
                                                class="form-check-input"
                                                style="cursor: pointer;"
                                            >
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </section>

        <section class="vente-card">
            <header class="vente-card-header">
                <h2 class="vente-card-heading">Description</h2>
            </header>
            <div class="vente-card-body">
                <div class="vente-field mb-3">
                    <label for="typePaiement">Mode de paiement</label>
                    <select required wire:model="typePaiement" id="typePaiement" class="form-control">
                        <option value="">Choisissez ...</option>
                        <option value="1">en espèce</option>
                        <option value="2">banque</option>
                        <option value="3">à crédit</option>
                        <option value="4">autres</option>
                    </select>
                </div>

                <ul class="vente-meta-list">
                    <li>
                        <span>Monnaie de paiement</span>
                        <select wire:model="invoice_currency" name="invoice_currency" class="vente-inline-control" style="width:auto; min-width:100px;">
                            @foreach (TYPE_MONNAIE as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </li>
                    @if (env('APP_CAN_PRINT_PROFORMAT', false))
                        <li>
                            <span>Type de document</span>
                            <select required wire:model="typeFacture" class="vente-inline-control" style="width:auto; min-width:120px;">
                                <option value="FACTURE">FACTURE</option>
                                <option value="PROFORMAT">PROFORMAT</option>
                            </select>
                        </li>
                    @endif
                    <li>
                        <span>PHTVA</span>
                        <h5 class="mb-0 font-weight-bold">{{ number_format(array_sum(array_values($pricesHorTva))) }}</h5>
                    </li>
                    <li>
                        <span>TVA</span>
                        <h5 class="mb-0 font-weight-bold">{{ number_format(array_sum(array_values($tvas))) }}</h5>
                    </li>
                    <li>
                        <span>Total</span>
                        <h5 class="mb-0 font-weight-bold">
                            <b>{{ number_format(array_sum(array_values($pricesTVAC))) }}</b>
                        </h5>
                    </li>
                </ul>

                <div class="mt-3">
                    <button type="button" class="vente-btn-primary" wire:click="saveValue">
                        <i class="fas fa-check"></i> Valider
                    </button>
                </div>
            </div>
        </section>
    </div>
</div>
