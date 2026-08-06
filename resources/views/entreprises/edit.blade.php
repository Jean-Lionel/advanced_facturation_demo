@extends('layouts.app')

@section('content')
<div class="app-page">
    @include('entreprises.header')

    <div class="app-card">
        <header class="app-card-header">
            <div>
                <h2 class="app-card-heading">Modifier l'entreprise</h2>
                <p class="app-meta mb-0">{{ $entreprise->tp_name }} · NIF {{ $entreprise->tp_TIN }}</p>
            </div>
            <a href="{{ route('entreprises.index') }}" class="btn btn-outline-secondary btn-sm">Retour</a>
        </header>

        <div class="app-card-body">
            @if ($errors->any())
                <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
            @endif

            <form action="{{ route('entreprises.update', $entreprise) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="company-settings-grid">
                    <section class="company-settings-section">
                        <div class="company-settings-title">
                            <h3>Identification</h3>
                        </div>
                        <div class="app-form-layout">
                            <div class="app-form-field app-form-field--full"><label for="tp_name">Raison sociale</label><input class="form-control" id="tp_name" name="tp_name" value="{{ old('tp_name', $entreprise->tp_name) }}" required></div>
                            <div class="app-form-field"><label for="tp_TIN">NIF</label><input class="form-control" id="tp_TIN" name="tp_TIN" value="{{ old('tp_TIN', $entreprise->tp_TIN) }}" required></div>
                            <div class="app-form-field"><label for="tp_trade_number">Registre du commerce</label><input class="form-control" id="tp_trade_number" name="tp_trade_number" value="{{ old('tp_trade_number', $entreprise->tp_trade_number) }}"></div>
                            <div class="app-form-field"><label for="tp_type">Type de société</label><select class="form-control" id="tp_type" name="tp_type">@foreach (['' => 'Choisissez…', '1' => 'Personne physique', '2' => 'Personne morale'] as $key => $value)<option value="{{ $key }}" {{ (string) old('tp_type', $entreprise->tp_type) === (string) $key ? 'selected' : '' }}>{{ $value }}</option>@endforeach</select></div>
                            <div class="app-form-field"><label for="tp_legal_form">Forme juridique</label><input class="form-control" id="tp_legal_form" name="tp_legal_form" value="{{ old('tp_legal_form', $entreprise->tp_legal_form) }}"></div>
                            <div class="app-form-field"><label for="tp_fiscal_center">Centre fiscal</label><select class="form-control" id="tp_fiscal_center" name="tp_fiscal_center">@foreach (['DGC', 'DMC', 'DPMC'] as $item)<option value="{{ $item }}" {{ old('tp_fiscal_center', $entreprise->tp_fiscal_center) === $item ? 'selected' : '' }}>{{ $item }}</option>@endforeach</select></div>
                            <div class="app-form-field"><label for="tp_activity_sector">Secteur d'activité</label><input class="form-control" id="tp_activity_sector" name="tp_activity_sector" value="{{ old('tp_activity_sector', $entreprise->tp_activity_sector) }}"></div>
                        </div>
                    </section>

                    <section class="company-settings-section">
                        <div class="company-settings-title">
                            <h3>Adresse &amp; contact</h3>
                        </div>
                        <div class="app-form-layout">
                            <div class="app-form-field"><label for="tp_phone_number">Téléphone</label><input class="form-control" id="tp_phone_number" name="tp_phone_number" value="{{ old('tp_phone_number', $entreprise->tp_phone_number) }}"></div>
                            <div class="app-form-field"><label for="tp_postal_number">Boîte postale</label><input class="form-control" id="tp_postal_number" name="tp_postal_number" value="{{ old('tp_postal_number', $entreprise->tp_postal_number) }}"></div>
                            <div class="app-form-field"><label for="tp_address_privonce">Province</label><input class="form-control" id="tp_address_privonce" name="tp_address_privonce" value="{{ old('tp_address_privonce', $entreprise->tp_address_privonce) }}"></div>
                            <div class="app-form-field"><label for="tp_address_commune">Commune</label><input class="form-control" id="tp_address_commune" name="tp_address_commune" value="{{ old('tp_address_commune', $entreprise->tp_address_commune) }}"></div>
                            <div class="app-form-field"><label for="tp_address_quartier">Quartier</label><input class="form-control" id="tp_address_quartier" name="tp_address_quartier" value="{{ old('tp_address_quartier', $entreprise->tp_address_quartier) }}"></div>
                            <div class="app-form-field"><label for="tp_address_avenue">Avenue</label><input class="form-control" id="tp_address_avenue" name="tp_address_avenue" value="{{ old('tp_address_avenue', $entreprise->tp_address_avenue) }}"></div>
                            <div class="app-form-field"><label for="tp_address_rue">Rue</label><input class="form-control" id="tp_address_rue" name="tp_address_rue" value="{{ old('tp_address_rue', $entreprise->tp_address_rue) }}"></div>
                            <div class="app-form-field"><label for="tp_address_number">Numéro</label><input class="form-control" id="tp_address_number" name="tp_address_number" value="{{ old('tp_address_number', $entreprise->tp_address_number) }}"></div>
                        </div>
                    </section>

                    <section class="company-settings-section">
                        <div class="company-settings-title">
                            <h3>Régime fiscal</h3>
                        </div>
                        <div class="app-form-layout">
                            <div class="app-form-field"><label for="vat_taxpayer">TVA</label><select class="form-control" id="vat_taxpayer" name="vat_taxpayer"><option value="0" {{ old('vat_taxpayer', $entreprise->vat_taxpayer) == 0 ? 'selected' : '' }}>Non assujetti</option><option value="1" {{ old('vat_taxpayer', $entreprise->vat_taxpayer) == 1 ? 'selected' : '' }}>Assujetti</option></select></div>
                            <div class="app-form-field"><label for="ct_taxpayer">Taxe de consommation</label><select class="form-control" id="ct_taxpayer" name="ct_taxpayer"><option value="0" {{ old('ct_taxpayer', $entreprise->ct_taxpayer) == 0 ? 'selected' : '' }}>Non assujetti</option><option value="1" {{ old('ct_taxpayer', $entreprise->ct_taxpayer) == 1 ? 'selected' : '' }}>Assujetti</option></select></div>
                            <div class="app-form-field"><label for="tl_taxpayer">Prélèvement forfaitaire</label><select class="form-control" id="tl_taxpayer" name="tl_taxpayer"><option value="0" {{ old('tl_taxpayer', $entreprise->tl_taxpayer) == 0 ? 'selected' : '' }}>Non assujetti</option><option value="1" {{ old('tl_taxpayer', $entreprise->tl_taxpayer) == 1 ? 'selected' : '' }}>Assujetti</option></select></div>
                            <div class="app-form-field"><label for="payment_type">Mode de paiement par défaut</label><select class="form-control" id="payment_type" name="payment_type">@foreach (['' => 'Choisissez…', '1' => 'En espèce', '2' => 'Banque', '3' => 'À crédit', '4' => 'Autres'] as $key => $value)<option value="{{ $key }}" {{ (string) old('payment_type', $entreprise->payment_type) === (string) $key ? 'selected' : '' }}>{{ $value }}</option>@endforeach</select></div>
                        </div>
                    </section>
                </div>

                <div class="app-form-actions justify-content-end mt-3">
                    <a href="{{ route('entreprises.index') }}" class="btn btn-outline-secondary btn-sm">Annuler</a>
                    <button type="submit" class="btn btn-primary btn-sm">Enregistrer les modifications</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
