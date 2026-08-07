@extends('layouts.app')

@section('content')

@include('users._header_config')

<div>
    <div class="row mb-2">
        <div class="col-md-6 d-flex justify-content-between">
            <a href="{{ route('banque.create') }}" class="btn btn-primary btn-sm">Ajouter</a>
            <h4 class="text-center">Banques</h4>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Banque</th>
                <th scope="col">Compte</th>
                <th scope="col">Titulaire</th>
                <th scope="col">Devise</th>
                <th scope="col">Statut</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($banques as $banque)
                <tr>
                    <td>{{ $banque->id }}</td>
                    <td>{{ $banque->name }}</td>
                    <td>{{ $banque->account_number }}</td>
                    <td>{{ $banque->account_name }}</td>
                    <td>{{ $banque->currency }}</td>
                    <td>{{ $banque->is_active ? 'Actif' : 'Inactif' }}</td>
                    <td class="d-flex">
                        <a href="{{ route('banque.edit', $banque) }}" class="btn btn-outline-primary btn-sm mr-2">Modifier</a>
                        <form action="{{ route('banque.destroy', $banque) }}" method="POST" onsubmit="return confirm('Voulez-vous supprimer cette banque ?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Aucune banque enregistrée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="col-md-12" style="height: 20px; overflow: hidden;">
    {{ $banques->links() }}
</div>

@endsection
