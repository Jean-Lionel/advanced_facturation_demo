@extends('layouts.app')

@section('content')
<div class="app-page">
    @include('entreprises.header')

    <div class="app-card">
        <header class="app-card-header">
            <h2 class="app-card-heading">Informations supplémentaires</h2>
            <div class="app-toolbar-actions">
                <a href="{{ route('entreprises.index') }}" class="btn btn-outline-secondary btn-sm">Retour</a>
            </div>
        </header>

        <div class="app-card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <form method="POST" action="{{ route('entreprises.store_info') }}" enctype="multipart/form-data">
                @csrf

                <div class="company-settings-grid">
                    <section class="company-settings-section">
                        <div class="company-settings-title">
                            <h3>Identité &amp; contact</h3>
                        </div>

                        <div class="form-group">
                            <label for="tp_logo">Logo de l'entreprise</label>
                            <div class="custom-file mb-2">
                                <input
                                    type="file"
                                    class="custom-file-input @error('tp_logo') is-invalid @enderror"
                                    id="tp_logo"
                                    name="tp_logo"
                                    accept="image/*"
                                    onchange="previewImage(event)"
                                >
                                <label class="custom-file-label" for="tp_logo" data-browse="Parcourir">
                                    Choisir un fichier...
                                </label>
                                @error('tp_logo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="text-center p-3 border rounded" style="min-height: 120px; display: flex; align-items: center; justify-content: center; background: #f8fafc;">
                                @if ($entreprise && $entreprise->tp_logo)
                                    <img id="logo-preview" src="{{ asset($entreprise->tp_logo) }}" alt="Logo actuel" class="img-fluid" style="max-height: 100px;">
                                @else
                                    <img id="logo-preview" src="#" alt="Aperçu du logo" class="img-fluid d-none" style="max-height: 100px;">
                                    <span class="text-muted small" id="no-logo-text">Aucun logo actuel</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tp_email">Email</label>
                            <input
                                id="tp_email"
                                type="email"
                                class="form-control"
                                name="tp_email"
                                value="{{ old('tp_email', $entreprise->tp_email ?? '') }}"
                                placeholder="contact@entreprise.com"
                            >
                        </div>

                        <div class="form-group">
                            <label for="tp_website">Site web</label>
                            <input
                                id="tp_website"
                                type="text"
                                class="form-control"
                                name="tp_website"
                                value="{{ old('tp_website', $entreprise->tp_website ?? '') }}"
                                placeholder="www.entreprise.com"
                            >
                        </div>

                        <div class="form-group">
                            <label for="tp_address">Adresse complète</label>
                            <textarea
                                id="tp_address"
                                class="form-control"
                                name="tp_address"
                                rows="3"
                                placeholder="Adresse physique détaillée"
                            >{{ old('tp_address', $entreprise->tp_address ?? '') }}</textarea>
                        </div>
                    </section>

                    <section class="company-settings-section">
                        <div class="company-settings-title">
                            <h3>Banque</h3>
                        </div>

                        @php
                            $accounts = old('bank_accounts', $entreprise ? $entreprise->bankAccounts->toArray() : []);
                        @endphp
                        <div class="form-group">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="mb-0">Comptes bancaires</label>
                                <button type="button" class="btn btn-outline-primary btn-sm" id="add-bank-account"><i class="fas fa-plus"></i> Ajouter</button>
                            </div>
                            <div id="bank-accounts">
                                @foreach ($accounts as $index => $account)
                                    <div class="bank-account-row border rounded p-2 mb-2">
                                        <input type="hidden" name="bank_accounts[{{ $index }}][id]" value="{{ $account['id'] ?? '' }}">
                                        <div class="company-bank-row">
                                            <input class="form-control" name="bank_accounts[{{ $index }}][bank_name]" value="{{ $account['bank_name'] ?? '' }}" placeholder="Nom de la banque" required>
                                            <input class="form-control" name="bank_accounts[{{ $index }}][account_number]" value="{{ $account['account_number'] ?? '' }}" placeholder="Numéro de compte" required>
                                            <button type="button" class="btn btn-outline-danger remove-bank-account" title="Supprimer"><i class="fas fa-times"></i></button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </section>
                </div>

                <div class="app-form-actions">
                    <a href="{{ route('entreprises.index') }}" class="btn btn-outline-secondary btn-sm">Annuler</a>
                    <button type="submit" class="btn btn-primary btn-sm">Enregistrer les modifications</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
    let bankAccountIndex = {{ count($accounts) }};
    document.getElementById('add-bank-account').addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'bank-account-row border rounded p-2 mb-2';
        row.innerHTML = `<div class="company-bank-row">
            <input class="form-control" name="bank_accounts[${bankAccountIndex}][bank_name]" placeholder="Nom de la banque" required>
            <input class="form-control" name="bank_accounts[${bankAccountIndex}][account_number]" placeholder="Numéro de compte" required>
            <button type="button" class="btn btn-outline-danger remove-bank-account" title="Supprimer"><i class="fas fa-times"></i></button>
        </div>`;
        document.getElementById('bank-accounts').appendChild(row);
        bankAccountIndex++;
    });
    document.getElementById('bank-accounts').addEventListener('click', function (event) {
        const button = event.target.closest('.remove-bank-account');
        if (button) button.closest('.bank-account-row').remove();
    });

    $(".custom-file-input").on("change", function () {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function () {
            var output = document.getElementById('logo-preview');
            output.src = reader.result;
            output.classList.remove('d-none');
            var noLogo = document.getElementById('no-logo-text');
            if (noLogo) {
                noLogo.classList.add('d-none');
            }
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
