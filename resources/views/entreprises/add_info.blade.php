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
                                <h5 class="mb-4 text-muted"><i class="fas fa-university mr-2"></i>Banques & Réseaux Sociaux</h5>

                                <!-- Section Banques -->
                                <div class="card mb-3 border">
                                    <div class="card-header bg-light d-flex justify-content-between align-items-center py-2">
                                        <span class="font-weight-bold"><i class="fas fa-university mr-2"></i>Comptes Bancaires</span>
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addBanqueModal">
                                            <i class="fas fa-plus"></i> Ajouter
                                        </button>
                                    </div>
                                    <div class="card-body p-2">
                                        @if($banques->count() > 0)
                                            <div class="table-responsive">
                                                <table class="table table-sm table-hover mb-0">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Banque</th>
                                                            <th>N° Compte</th>
                                                            <th class="text-center" style="width: 100px;">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($banques as $banque)
                                                            <tr>
                                                                <td>
                                                                    {{ $banque->name }}
                                                                    @if($banque->is_default)
                                                                        <span class="badge badge-success ml-1">Par défaut</span>
                                                                    @endif
                                                                </td>
                                                                <td>{{ $banque->account_number ?? '-' }}</td>
                                                                <td class="text-center">
                                                                    <button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#editBanqueModal{{ $banque->id }}" title="Modifier">
                                                                        <i class="fas fa-edit"></i>
                                                                    </button>
                                                                    <button type="button" class="btn btn-xs btn-danger" onclick="confirmDeleteBanque({{ $banque->id }})" title="Supprimer">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @else
                                            <p class="text-muted text-center mb-0 py-2">
                                                <i class="fas fa-info-circle mr-1"></i> Aucune banque enregistrée
                                            </p>
                                        @endif
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

<!-- Modal Ajouter Banque -->
<div class="modal fade" id="addBanqueModal" tabindex="-1" role="dialog" aria-labelledby="addBanqueModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('entreprises.store_banque') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addBanqueModalLabel"><i class="fas fa-university mr-2"></i>Ajouter une Banque</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="banque_name" class="font-weight-bold">Nom de la Banque <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="banque_name" name="name" required placeholder="Ex: BCB, BANCOBU, IBB...">
                    </div>
                    <div class="form-group">
                        <label for="banque_account_number" class="font-weight-bold">Numéro de Compte</label>
                        <input type="text" class="form-control" id="banque_account_number" name="account_number" placeholder="Ex: 12345678901234">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="banque_swift_code" class="font-weight-bold">Code SWIFT</label>
                            <input type="text" class="form-control" id="banque_swift_code" name="swift_code" placeholder="Ex: BCBUBIBU">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="banque_iban" class="font-weight-bold">IBAN</label>
                            <input type="text" class="form-control" id="banque_iban" name="iban" placeholder="Ex: BI00...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="banque_description" class="font-weight-bold">Description</label>
                        <textarea class="form-control" id="banque_description" name="description" rows="2" placeholder="Notes supplémentaires..."></textarea>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="banque_is_default" name="is_default">
                            <label class="custom-control-label" for="banque_is_default">Définir comme banque par défaut</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modals Modifier Banque -->
@foreach($banques as $banque)
<div class="modal fade" id="editBanqueModal{{ $banque->id }}" tabindex="-1" role="dialog" aria-labelledby="editBanqueModalLabel{{ $banque->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('entreprises.update_banque', $banque->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="editBanqueModalLabel{{ $banque->id }}"><i class="fas fa-edit mr-2"></i>Modifier la Banque</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bold">Nom de la Banque <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" value="{{ $banque->name }}" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Numéro de Compte</label>
                        <input type="text" class="form-control" name="account_number" value="{{ $banque->account_number }}">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Code SWIFT</label>
                            <input type="text" class="form-control" name="swift_code" value="{{ $banque->swift_code }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">IBAN</label>
                            <input type="text" class="form-control" name="iban" value="{{ $banque->iban }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Description</label>
                        <textarea class="form-control" name="description" rows="2">{{ $banque->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="edit_banque_is_default{{ $banque->id }}" name="is_default" {{ $banque->is_default ? 'checked' : '' }}>
                            <label class="custom-control-label" for="edit_banque_is_default{{ $banque->id }}">Définir comme banque par défaut</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-info"><i class="fas fa-save mr-1"></i> Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Formulaire caché pour supprimer la banque -->
<form id="deleteBanqueForm{{ $banque->id }}" action="{{ route('entreprises.destroy_banque', $banque->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endforeach

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

    // Confirmation de suppression de banque
    function confirmDeleteBanque(banqueId) {
        if (confirm('Êtes-vous sûr de vouloir supprimer cette banque ?')) {
            document.getElementById('deleteBanqueForm' + banqueId).submit();
        }
    }
</script>
@endsection

@endsection
