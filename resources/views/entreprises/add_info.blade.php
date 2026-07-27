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

                <div class="row">
                    <div class="col-md-6">
                        <h5 class="mb-3">Identité &amp; contact</h5>

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
                    </div>

                    <div class="col-md-6">
                        <h5 class="mb-3">Banque &amp; réseaux sociaux</h5>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="tp_bank">Banque</label>
                                <input
                                    id="tp_bank"
                                    type="text"
                                    class="form-control"
                                    name="tp_bank"
                                    value="{{ old('tp_bank', $entreprise->tp_bank ?? '') }}"
                                    placeholder="Nom de la banque"
                                >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tp_account_number">Numéro de compte</label>
                                <input
                                    id="tp_account_number"
                                    type="text"
                                    class="form-control"
                                    name="tp_account_number"
                                    value="{{ old('tp_account_number', $entreprise->tp_account_number ?? '') }}"
                                    placeholder="XXXX-XXXX-XXXX"
                                >
                            </div>
                        </div>

                        @php
                            $socials = [
                                'facebook' => ['icon' => 'fab fa-facebook-f', 'placeholder' => 'Lien Facebook'],
                                'twitter' => ['icon' => 'fab fa-twitter', 'placeholder' => 'Lien Twitter'],
                                'instagram' => ['icon' => 'fab fa-instagram', 'placeholder' => 'Lien Instagram'],
                                'youtube' => ['icon' => 'fab fa-youtube', 'placeholder' => 'Lien YouTube'],
                                'whatsapp' => ['icon' => 'fab fa-whatsapp', 'placeholder' => 'Numéro WhatsApp'],
                            ];
                        @endphp

                        @foreach ($socials as $key => $social)
                            <div class="form-group">
                                <label for="tp_{{ $key }}">
                                    <i class="{{ $social['icon'] }} mr-1"></i> {{ ucfirst($key) }}
                                </label>
                                <input
                                    id="tp_{{ $key }}"
                                    type="text"
                                    class="form-control form-control-sm"
                                    name="tp_{{ $key }}"
                                    value="{{ old('tp_'.$key, $entreprise->{'tp_'.$key} ?? '') }}"
                                    placeholder="{{ $social['placeholder'] }}"
                                >
                            </div>
                        @endforeach
                    </div>
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
