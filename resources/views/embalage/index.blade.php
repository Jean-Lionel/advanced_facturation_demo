@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Liste des Emballages') }}</span>
                    <a href="{{ route('embalage.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Ajouter
                    </a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Type</th>
                                    <th>Prix</th>
                                    <th>Quantité</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($embalages as $embalage)
                                    <tr>
                                        <td>{{ $embalage->id }}</td>
                                        <td>{{ $embalage->name }}</td>
                                        <td>{{ $embalage->typeEmbalage->name ?? 'N/A' }}</td>
                                        <td class="text-end">{{ number_format($embalage->price, 2, ',', ' ') }}</td>
                                        <td class="text-end">{{ number_format($embalage->quantity, 2, ',', ' ') }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('embalage.show', $embalage) }}" class="btn btn-info btn-sm me-1" title="Voir">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('embalage.edit', $embalage) }}" class="btn btn-warning btn-sm me-1" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('embalage.destroy', $embalage) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet emballage ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Supprimer">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Aucun emballage trouvé</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        {{-- Si vous utilisez la pagination --}}
                        {{-- {{ $embalages->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
