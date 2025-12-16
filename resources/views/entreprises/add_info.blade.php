@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3 border-bottom-0">
                    <h4 class="mb-0 text-primary font-weight-bold">
                        <i class="fas fa-building mr-2"></i> {{ __('Informations Supplémentaires de l\'Entreprise') }}
                    </h4>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('entreprises.store_info') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <!-- Left Column: Identity & Contact -->
                            <div class="col-md-6 border-right">
                                <h5 class="mb-4 text-muted"><i class="fas fa-info-circle mr-2"></i>Identité & Contact</h5>

                                <div class="form-group">
                                    <label for="tp_logo" class="font-weight-bold">{{ __('Logo de l\'Entreprise') }}</label>
                                    <div class="custom-file mb-3">
                                        <input type="file" class="custom-file-input @error('tp_logo') is-invalid @enderror" id="tp_logo" name="tp_logo" accept="image/*" onchange="previewImage(event)">
                                        <label class="custom-file-label" for="tp_logo" data-browse="Parcourir">Choisir un fichier...</label>
                                        @error('tp_logo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="text-center p-3 bg-light rounded border" style="min-height: 120px; display: flex; align-items: center; justify-content: center;">
                                        @if($entreprise && $entreprise->tp_logo)
                                            <img id="logo-preview" src="{{ asset($entreprise->tp_logo) }}" alt="Current Logo" class="img-fluid" style="max-height: 100px;">
                                        @else
                                            <img id="logo-preview" src="#" alt="Aperçu du logo" class="img-fluid d-none" style="max-height: 100px;">
                                            <span class="text-muted small" id="no-logo-text">Aucun logo actuel</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tp_email" class="font-weight-bold">{{ __('Email') }}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input id="tp_email" type="email" class="form-control" name="tp_email" value="{{ old('tp_email', $entreprise->tp_email ?? '') }}" placeholder="contact@entreprise.com">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tp_website" class="font-weight-bold">{{ __('Site Web') }}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                        </div>
                                        <input id="tp_website" type="text" class="form-control" name="tp_website" value="{{ old('tp_website', $entreprise->tp_website ?? '') }}" placeholder="www.entreprise.com">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tp_address" class="font-weight-bold">{{ __('Adresse Complète') }}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                        </div>
                                        <textarea id="tp_address" class="form-control" name="tp_address" rows="3" placeholder="Adresse physique détaillée">{{ old('tp_address', $entreprise->tp_address ?? '') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column: Bank & Social -->
                            <div class="col-md-6">
                                <h5 class="mb-4 text-muted"><i class="fas fa-university mr-2"></i>Banque & Réseaux Sociaux</h5>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="tp_bank" class="font-weight-bold">{{ __('Banque') }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-university"></i></span>
                                            </div>
                                            <input id="tp_bank" type="text" class="form-control" name="tp_bank" value="{{ old('tp_bank', $entreprise->tp_bank ?? '') }}" placeholder="Nom de la banque">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="tp_account_number" class="font-weight-bold">{{ __('Numéro de Compte') }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-file-invoice-dollar"></i></span>
                                            </div>
                                            <input id="tp_account_number" type="text" class="form-control" name="tp_account_number" value="{{ old('tp_account_number', $entreprise->tp_account_number ?? '') }}" placeholder="XXXX-XXXX-XXXX">
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                @php
                                    $socials = [
                                        'facebook' => ['icon' => 'fab fa-facebook-f', 'color' => '#3b5998', 'placeholder' => 'Lien Facebook'],
                                        'twitter' => ['icon' => 'fab fa-twitter', 'color' => '#1da1f2', 'placeholder' => 'Lien Twitter'],
                                        'instagram' => ['icon' => 'fab fa-instagram', 'color' => '#e1306c', 'placeholder' => 'Lien Instagram'],
                                        'youtube' => ['icon' => 'fab fa-youtube', 'color' => '#ff0000', 'placeholder' => 'Lien YouTube'],
                                        'whatsapp' => ['icon' => 'fab fa-whatsapp', 'color' => '#25d366', 'placeholder' => 'Numéro WhatsApp'],
                                    ];
                                @endphp

                                @foreach($socials as $key => $social)
                                    <div class="form-group">
                                        <label for="tp_{{ $key }}" class="font-weight-bold small text-uppercase" style="color: {{ $social['color'] }}">
                                            <i class="{{ $social['icon'] }} mr-1"></i> {{ ucfirst($key) }}
                                        </label>
                                        <input id="tp_{{ $key }}" type="text" class="form-control form-control-sm" name="tp_{{ $key }}" value="{{ old('tp_'.$key, $entreprise->{'tp_'.$key} ?? '') }}" placeholder="{{ $social['placeholder'] }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12 text-right">
                                <hr>
                                <button type="submit" class="btn btn-primary px-5 py-2 shadow-sm font-weight-bold">
                                    <i class="fas fa-save mr-2"></i> {{ __('Enregistrer les modifications') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@section('javascript')
<script>
    // Custom file input label update
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    // Image preview
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('logo-preview');
            output.src = reader.result;
            output.classList.remove('d-none');
            document.getElementById('no-logo-text').classList.add('d-none');
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection

@endsection
