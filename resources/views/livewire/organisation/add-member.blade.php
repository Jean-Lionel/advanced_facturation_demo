<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Ajouter un membre</h4>
                </div>
                <div class="card-body">
                        <div class="mb-3">
                            <label for="selectedMember" class="form-label">Sélectionner un membre</label>
                            <select wire:model="selectedMember" class="form-select">
                                <option value="">Sélectionner un membre</option>
                                @foreach($members as $member)
                                    <option value="{{ $member->id }}">{{ $member->firstname . '' . $member->last_name  }}</option>
                                @endforeach
                            </select>
                            @error('selectedMember')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button class="btn btn-primary" wire:click="addMember">Ajouter</button>

                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Membres de l'organisation</h4>
                </div>
                <div class="card-body">
                    @if($organisationMembers->isEmpty())
                        <p class="text-muted">Aucun membre n'est actuellement dans cette organisation.</p>
                    @else
                        <div class="list-group">
                            @foreach($organisationMembers as $member)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $member->name }}
                                    <button wire:click="removeMember({{ $member->id }})" class="btn btn-danger btn-sm">
                                        Supprimer
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    window.addEventListener('success', event => {
        Swal.fire({
            icon: 'success',
            title: 'Succès',
            text: event.detail.message,
            timer: 2000,
            showConfirmButton: false
        });
    });
</script>
@endpush
