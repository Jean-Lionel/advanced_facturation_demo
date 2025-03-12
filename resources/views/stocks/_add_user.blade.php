@extends('layouts.app')

@section('content')
@include('products._header_product')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                    <h3>Liste des utilisateurs associés au stock : #{{ $stocke->name }}</h3>
                </div>
                <div class="card-body">
                    <form class="row g-3" action="" method="post">
                        @csrf
                        <input type="hidden" name="stock_id" value="{{ $stocke->id }}">
                        <div class="col-md-8">
                            <select class="form-control" name="user_id" aria-label="Sélectionner un utilisateur">
                                <option selected>Selectionnez un utilisateur</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success w-100">Ajouter au Stock</button>
                        </div>
                    </form>


                    <div class="mt-4">
                        <ol class="list-group list-group-numbered">
                            @forelse ($userstockes as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">{{ $item->user->name }}</div>
                                        {{ $item->user->email }}
                                    </div>
                                    <form action="{{ route('stocke.userremove', $item) }}" method="post" id="deleteForm_{{ $item->id }}">
                                        @method('delete')
                                        @csrf
                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $item->id }})">Supprimer</button>
                                    </form>
                                </li>
                            @empty
                                <li class="list-group-item text-muted text-center">Aucun utilisateur associé à ce stock.</li>
                            @endforelse
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
    function confirmDelete(id) {
        if (confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?")) {
            document.getElementById('deleteForm_' + id).submit();
        }
    }
</script>
@endsection
