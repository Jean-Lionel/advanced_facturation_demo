<div>
    <div class="row">
        <div wire:loading>
            @livewire('loading.checkout')
        </div>
    </div>

    <h4 class="text-center mb-3">Commentaires de la maison</h4>

    <div class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="date">Date</label>
                    <input
                        type="date"
                        id="date"
                        class="form-control @error('date') is-invalid @enderror"
                        wire:model.defer="date"
                    >
                    @error('date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="client_id">Personne en possession</label>
                    <select
                        id="client_id"
                        class="form-control @error('client_id') is-invalid @enderror"
                        wire:model="client_id"
                    >
                        <option value="">Sélectionner un client</option>
                        @foreach ($clients as $item)
                            <option value="{{ $item->client_id }}">
                                {{ $item->client?->name }}
                                @if ($item->client?->telephone)
                                    — {{ $item->client->telephone }}
                                @endif
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input
                        type="text"
                        id="nom"
                        class="form-control @error('nom') is-invalid @enderror"
                        wire:model.defer="nom"
                        placeholder="Nom de la personne en possession"
                    >
                    @error('nom')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="telephone">Téléphone</label>
                    <input
                        type="text"
                        id="telephone"
                        class="form-control @error('telephone') is-invalid @enderror"
                        wire:model.defer="telephone"
                        placeholder="Numéro de téléphone"
                    >
                    @error('telephone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="commentaire">Commentaire</label>
            <textarea
                id="commentaire"
                class="form-control @error('commentaire') is-invalid @enderror"
                rows="3"
                wire:model.defer="commentaire"
                placeholder="Saisir un commentaire pour cette maison location..."
            ></textarea>
            @error('commentaire')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button class="btn btn-primary btn-sm mt-2" wire:click="addCommentaire">
            <i class="fa fa-plus"></i>
            Ajouter
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Téléphone</th>
                    <th scope="col">Commentaire</th>
                    <th scope="col">Saisi par</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($commentaires as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->date?->format('d/m/Y') ?? $item->created_at?->format('d/m/Y') }}</td>
                        <td>{{ $item->nom ?? '—' }}</td>
                        <td>{{ $item->telephone ?? '—' }}</td>
                        <td>{{ $item->commentaire }}</td>
                        <td>{{ $item->user?->name ?? '—' }}</td>
                        <td>
                            <button
                                class="btn btn-danger btn-sm"
                                wire:click="deleteCommentaire({{ $item->id }})"
                                onclick="return confirm('Supprimer ce commentaire ?')"
                            >
                                <i class="fas fa-trash"></i>
                                Supprimer
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            Aucun commentaire pour cette maison location.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>