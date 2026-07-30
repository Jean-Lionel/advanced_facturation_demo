@extends('layouts.app')

@section('content')

@include('users._header_config')

<div class="card">
    <div class="card-body">
        <h4>{{ $banque->name }}</h4>
        <p>Compte : <b>{{ $banque->account_number }}</b></p>
        <p>Titulaire : <b>{{ $banque->account_name }}</b></p>
        <p>Type : <b>{{ $banque->account_type }}</b></p>
        <p>Devise : <b>{{ $banque->currency }}</b></p>
        <p>Statut : <b>{{ $banque->is_active ? 'Actif' : 'Inactif' }}</b></p>
        <a href="{{ route('banque.index') }}" class="btn btn-link">Retour</a>
    </div>
</div>

@endsection
