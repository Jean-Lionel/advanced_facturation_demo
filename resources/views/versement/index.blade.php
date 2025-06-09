@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div>
            <a href="{{ route('versementType.index') }}" class="btn btn-primary btn-sm"> Types des versments </a>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Liste des versements</span>
                    <a href="{{ route('versement.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Nouveau versement
                    </a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Utilisateur</th>
                                    <th>Description</th>
                                    <th>Montant</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($versements as $versement)
                                    <tr>
                                        <td>{{ $versement->id }}</td>
                                        <td>{{ $versement->user->name ?? 'N/A' }}</td>
                                        <td>{{ Str::limit($versement->description, 30) }}</td>
                                        <td>{{ number_format($versement->montant, 2, ',', ' ') }} €</td>
                                        <td>{{ $versement->versementType->name ?? 'Non défini' }}</td>
                                        <td>{{ $versement->date_transaction->format('d/m/Y') }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('versement.show', $versement) }}" class="btn btn-info" title="Voir">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('versement.edit', $versement) }}" class="btn btn-warning" title="Modifier">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('versement.destroy', $versement) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce versement ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" title="Supprimer">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Aucun versement trouvé</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $versements->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .btn-group-sm > .btn {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
    .btn-group .btn {
        margin-right: 2px;
    }
</style>
@endpush
