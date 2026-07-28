@extends('layouts.app')

@section('content')
<div class="app-page">
    <div class="app-card">
        <header class="app-card-header">
            <h2 class="app-card-heading">Nouvelle dépense</h2>
            <div class="app-toolbar-actions">
                <a href="{{ route('depenses.index') }}" class="btn btn-outline-secondary btn-sm">Retour</a>
            </div>
        </header>

        <form action="{{ route('depenses.store') }}" method="post">
            @method('post')
            @include('depenses._form', ['btnMessage' => 'Enregistrer'])
        </form>
    </div>
</div>
@endsection
