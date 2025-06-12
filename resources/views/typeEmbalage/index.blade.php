@extends('layouts.app')

@section('content')
<div class="container">
<div>
        @include('versement._header')
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Liste des Types d\'Emballage') }}</span>
                    <a href="{{ route('typeEmbalage.create') }}" class="btn btn-primary btn-sm">
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
                                    <th>Description</th>
                                    <th>Date de création</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($typeEmbalages as $type)
                                    <tr>
                                        <td>{{ $type->id }}</td>
                                        <td>{{ $type->name }}</td>
                                        <td>{{ $type->description ?? 'N/A' }}</td>
                                        <td>{{ $type->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('typeEmbalage.show', $type) }}" class="btn btn-info btn-sm me-1" title="Voir">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('typeEmbalage.edit', $type) }}" class="btn btn-warning btn-sm me-1" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('typeEmbalage.destroy', $type) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce type d\'emballage ?')">
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
                                        <td colspan="5" class="text-center">Aucun type d'emballage trouvé</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        {{-- Si vous utilisez la pagination --}}
                        {{-- {{ $typeEmbalages->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
