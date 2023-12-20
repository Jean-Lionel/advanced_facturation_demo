<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div>
        <table class="table  table-sm">

            <tbody>
                @foreach ($entreprises as $element)
                    {{-- expr --}}
                    <tr>
                        <th> TP_NAME </th>
                        <td> {{ $element->tp_name }} </td>
                        <th> TP_TYPE </th>
                        <td> {{ $element->tp_type }} </td>
                    </tr>
                    <tr>
                        <th> TP_TIN </th>
                        <td> {{ $element->tp_TIN }} </td>
                        <th> TP_TRADE_NUMBER </th>
                        <td> {{ $element->tp_trade_number }} </td>
                    </tr>
                    <tr>
                        <th> TP_POSTAL_NUMBER </th>
                        <td> {{ $element->tp_postal_number }} </td>
                        <th> TP_PHONE_NUMBER </th>
                        <td> {{ $element->tp_phone_number }} </td>
                    </tr>
                    <tr>
                        <th> TP_ADDRESS_PRIVONCE </th>
                        <td> {{ $element->tp_address_privonce }} </td>
                        <th> TP_ADDRESS_QUARTIER </th>

                        <td> {{ $element->tp_address_quartier }} </td>
                    </tr>

                    <tr>
                        <th> TP_ADDRESS_AVENUE </th>
                        <td> {{ $element->tp_address_avenue }} </td>
                        <th> TP_ADDRESS_RUE </th>
                        <td> {{ $element->tp_address_rue }} </td>
                    </tr>
                    <tr>
                        <th> TP_ADDRESS_NUMBER </th>
                        <td> {{ $element->tp_address_number }} </td>
                        <th> VAT_TAXPAYER </th>

                        <td> {{ $element->vat_taxpayer }} </td>
                    </tr>
                    <tr>
                        <th> CT_TAXPAYER </th>
                        <td> {{ $element->ct_taxpayer }} </td>
                        <th> TL_TAXPAYER </th>
                        <td> {{ $element->tl_taxpayer }} </td>
                    </tr>
                    <tr>
                        <th> TP_FISCAL_CENTER </th>
                        <td> {{ $element->tp_fiscal_center }} </td>
                        <th> TP_ACTIVITY_SECTOR </th>
                        <td> {{ $element->tp_activity_sector }} </td>
                    </tr>
                    <tr>
                        <th> TP_LEGAL_FORM </th>
                        <td> {{ $element->tp_legal_form }} </td>
                        <th> PAYMENT_TYPE </th>


                        <td> {{ $element->payment_type }} </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
        <div class="row p-4">
            <a class="btn btn-info" href="{{ route('entreprises.edit', $element) }}">Modifier</a>
        </div>
    </div>

    @if ($entreprises->count() < 1)
        <div>
            <h4 class="text-center">Enregistrement de l'entreprise</h4>

            <form action="" class="row m-3" wire:submit.prevent="saveEntreprise">
                <div class="col-md-12">
                    @if ($errors->any())
                        {!! implode('', $errors->all('<span class="text text-danger">:message</span>')) !!}
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <label for="">Nom et prénom ou Nom commercial</label>
                    <input type="text" class="form-control   form-control-sm" wire:model="tp_name" placeholder="" />

                </div>

                <div class="form-group col-md-4">
                    <label for="">Type de contribuable.</label>
                    <select name="" wire:model="tp_type" id="" class="form-control   form-control-sm">
                        <option value="">select</option>
                        <option value="1">personne physique </option>
                        <option value="2">personne morale</option>
                    </select>

                </div>
                <div class="form-group col-md-4">
                    <label for="">NIF du contribuable</label>
                    <input type="text" class="form-control  form-control-sm" wire:model="tp_TIN" />

                </div>
                <div class="from-group col-md-4">
                    <label for="">Le numéro du registre de commerce du contribuable</label>
                    <input type="text" class="form-control   form-control-sm" wire:model="tp_trade_number" />
                </div>
                <div class="from-group col-md-4">
                    <label for="">Boite postale du contribuable</label>
                    <input type="text" class="form-control  form-control-sm" wire:model="tp_postal_number" />
                </div>

                <div class="from-group col-md-4">
                    <label for="">Numéro de téléphone du contribuable</label>
                    <input type="text" class="form-control  form-control-sm" wire:model="tp_phone_number" />
                </div>

                <div class="from-group col-md-4">
                    <label for="">Adresse du contribuable : Province</label>
                    <input type="text" class="form-control  form-control-sm" wire:model="tp_address_privonce" />
                </div>
                <div class="from-group col-md-4">
                    <label for="">Adresse du contribuable : commune</label>
                    <input type="text" class="form-control  form-control-sm" wire:model="tp_address_commune" />
                </div>
                <div class="from-group col-md-4">
                    <label for="">Adresse du contribuable : quartier </label>
                    <input type="text" class="form-control  form-control-sm" wire:model="tp_address_quartier" />
                </div>
                <div class="from-group col-md-4">
                    <label for="">Adresse du contribuable : Avenue </label>
                    <input type="text" class="form-control  form-control-sm" wire:model="tp_address_avenue" />
                </div>
                <div class="from-group col-md-4">
                    <label for="">Adresse du contribuable : Rue </label>
                    <input type="text" class="form-control  form-control-sm" wire:model="tp_address_rue" />
                </div>
                <div class="from-group col-md-4">
                    <label for="">Adresse du contribuable : Numéro </label>
                    <input t class="form-control  form-control-sm" wire:model="tp_address_number" />
                </div>
                <div class="from-group col-md-4 ">
                    <input type="checkbox" id="vat_taxpayer" class="form-control-sm" wire:model="vat_taxpayer" />
                    <label for="vat_taxpayer">Assujetti à la TVA</label>
                </div>

                <div class="from-group col-md-4">
                    <input type="checkbox" id="ct_taxpayer" class="form-control-sm" wire:model="ct_taxpayer" />
                    <label for="ct_taxpayer">Assujetti à la taxe de consommation</label>
                </div>
                <div class="form-group col-md-4">
                    <input type="checkbox" id="tl_taxpayer" class="form-control-sm" wire:model="tl_taxpayer" />
                    <label for="tl_taxpayer">Assujetti au prélèvement forfaitaire libératoire</label>
                </div>
                <div class="form-group col-md-4">
                    <label for="">Le centre fiscal du contribuable</label>
                    <input type="text" type="text" class="form-control form-control-sm"
                        wire:model="tp_fiscal_center">
                </div>
                <div class="form-group col-md-4">
                    <label for="">Le secteur d’activité du contribuable</label>
                    <input type="text" class="form-control  form-control-sm" wire:model="tp_activity_sector" />
                </div>
                <div class="form-group col-md-4">
                    <label for="">La forme juridique du contribuable</label>
                    <input type="text" class="form-control  form-control-sm" wire:model="tp_legal_form" />
                </div>
                <div class="form-group col-md-4">
                    <label for="">Type de paiement de la facture</label>
                    <select name="" id="" class="form-control  form-control-sm"
                        wire:model="payment_type">
                        <option value=""></option>
                        <option value="1">En espèce</option>
                        <option value="2">Banque</option>
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="description">Déscription</label>
                    <textarea name="" id="description" class="form-control  form-control-sm"></textarea>
                </div>
                <div class="form-group col-md-4">
                    <input type="submit" class="btn btn-sm btn-primary btn-block mt-3" value="Enregistrer">
                </div>
            </form>
        </div>

    @endif
</div>
