<div>
    @if ($element)
        <div class="app-table-wrap">
            <table class="table table-sm app-table">
                <tbody>
                    <tr>
                        <th>Nom commercial</th>
                        <td>{{ $element->tp_name }}</td>
                        <th>Type de contribuable</th>
                        <td>
                            @if ((string) $element->tp_type === '1')
                                Personne physique
                            @elseif ((string) $element->tp_type === '2')
                                Personne morale
                            @else
                                {{ $element->tp_type }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>NIF</th>
                        <td>{{ $element->tp_TIN }}</td>
                        <th>Registre de commerce</th>
                        <td>{{ $element->tp_trade_number }}</td>
                    </tr>
                    <tr>
                        <th>Boîte postale</th>
                        <td>{{ $element->tp_postal_number }}</td>
                        <th>Téléphone</th>
                        <td>{{ $element->tp_phone_number }}</td>
                    </tr>
                    <tr>
                        <th>Province</th>
                        <td>{{ $element->tp_address_privonce }}</td>
                        <th>Commune</th>
                        <td>{{ $element->tp_address_commune }}</td>
                    </tr>
                    <tr>
                        <th>Quartier</th>
                        <td>{{ $element->tp_address_quartier }}</td>
                        <th>Avenue</th>
                        <td>{{ $element->tp_address_avenue }}</td>
                    </tr>
                    <tr>
                        <th>Rue</th>
                        <td>{{ $element->tp_address_rue }}</td>
                        <th>Numéro</th>
                        <td>{{ $element->tp_address_number }}</td>
                    </tr>
                    <tr>
                        <th>Assujetti à la TVA</th>
                        <td>{{ $element->vat_taxpayer ? 'Oui' : 'Non' }}</td>
                        <th>Assujetti à la taxe de consommation</th>
                        <td>{{ $element->ct_taxpayer ? 'Oui' : 'Non' }}</td>
                    </tr>
                    <tr>
                        <th>Assujetti au prélèvement forfaitaire</th>
                        <td>{{ $element->tl_taxpayer ? 'Oui' : 'Non' }}</td>
                        <th>Centre fiscal</th>
                        <td>{{ $element->tp_fiscal_center }}</td>
                    </tr>
                    <tr>
                        <th>Secteur d'activité</th>
                        <td>{{ $element->tp_activity_sector }}</td>
                        <th>Forme juridique</th>
                        <td>{{ $element->tp_legal_form }}</td>
                    </tr>
                    <tr>
                        <th>Type de paiement</th>
                        <td colspan="3">
                            @if ((string) $element->payment_type === '1')
                                En espèce
                            @elseif ((string) $element->payment_type === '2')
                                Banque
                            @else
                                {{ $element->payment_type }}
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class=" mt-2 mb-2 ml-2">
            <a class="btn btn-primary" href="{{ route('entreprises.edit', $element->id) }}">Modifier</a>
        </div>
    @else
        <h4 class="mb-3">Enregistrement de l'entreprise</h4>

        <form action="" class="row" wire:submit.prevent="saveEntreprise">
            <div class="col-md-12">
                @if ($errors->any())
                    {!! implode('', $errors->all('<span class="text text-danger">:message</span>')) !!}
                @endif
            </div>
            <div class="form-group col-md-4">
                <label>Nom et prénom ou Nom commercial</label>
                <input type="text" class="form-control form-control-sm" wire:model="tp_name">
            </div>

            <div class="form-group col-md-4">
                <label>Type de contribuable</label>
                <select wire:model="tp_type" class="form-control form-control-sm">
                    <option value="">Sélectionner</option>
                    <option value="1">Personne physique</option>
                    <option value="2">Personne morale</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label>NIF du contribuable</label>
                <input type="text" class="form-control form-control-sm" wire:model="tp_TIN">
            </div>
            <div class="form-group col-md-4">
                <label>Numéro du registre de commerce</label>
                <input type="text" class="form-control form-control-sm" wire:model="tp_trade_number">
            </div>
            <div class="form-group col-md-4">
                <label>Boîte postale</label>
                <input type="text" class="form-control form-control-sm" wire:model="tp_postal_number">
            </div>
            <div class="form-group col-md-4">
                <label>Numéro de téléphone</label>
                <input type="text" class="form-control form-control-sm" wire:model="tp_phone_number">
            </div>
            <div class="form-group col-md-4">
                <label>Province</label>
                <input type="text" class="form-control form-control-sm" wire:model="tp_address_privonce">
            </div>
            <div class="form-group col-md-4">
                <label>Commune</label>
                <input type="text" class="form-control form-control-sm" wire:model="tp_address_commune">
            </div>
            <div class="form-group col-md-4">
                <label>Quartier</label>
                <input type="text" class="form-control form-control-sm" wire:model="tp_address_quartier">
            </div>
            <div class="form-group col-md-4">
                <label>Avenue</label>
                <input type="text" class="form-control form-control-sm" wire:model="tp_address_avenue">
            </div>
            <div class="form-group col-md-4">
                <label>Rue</label>
                <input type="text" class="form-control form-control-sm" wire:model="tp_address_rue">
            </div>
            <div class="form-group col-md-4">
                <label>Numéro</label>
                <input type="text" class="form-control form-control-sm" wire:model="tp_address_number">
            </div>
            <div class="form-group col-md-4">
                <input type="checkbox" id="vat_taxpayer" class="form-control-sm" wire:model="vat_taxpayer">
                <label for="vat_taxpayer">Assujetti à la TVA</label>
            </div>
            <div class="form-group col-md-4">
                <input type="checkbox" id="ct_taxpayer" class="form-control-sm" wire:model="ct_taxpayer">
                <label for="ct_taxpayer">Assujetti à la taxe de consommation</label>
            </div>
            <div class="form-group col-md-4">
                <input type="checkbox" id="tl_taxpayer" class="form-control-sm" wire:model="tl_taxpayer">
                <label for="tl_taxpayer">Assujetti au prélèvement forfaitaire libératoire</label>
            </div>
            <div class="form-group col-md-4">
                <label>Centre fiscal</label>
                <input type="text" class="form-control form-control-sm" wire:model="tp_fiscal_center">
            </div>
            <div class="form-group col-md-4">
                <label>Secteur d'activité</label>
                <input type="text" class="form-control form-control-sm" wire:model="tp_activity_sector">
            </div>
            <div class="form-group col-md-4">
                <label>Forme juridique</label>
                <input type="text" class="form-control form-control-sm" wire:model="tp_legal_form">
            </div>
            <div class="form-group col-md-4">
                <label>Type de paiement</label>
                <select class="form-control form-control-sm" wire:model="payment_type">
                    <option value=""></option>
                    <option value="1">En espèce</option>
                    <option value="2">Banque</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="description">Description</label>
                <textarea id="description" class="form-control form-control-sm"></textarea>
            </div>
            <div class="form-group col-md-4">
                <input type="submit" class="btn btn-sm btn-primary btn-block mt-3" value="Enregistrer">
            </div>
        </form>
    @endif
</div>
