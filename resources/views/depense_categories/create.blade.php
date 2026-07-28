@extends('layouts.app')

@section('content')
<div class="app-page">
    <div class="app-card">
        <header class="app-card-header">
            <h2 class="app-card-heading">Nouvelle catégorie de dépense</h2>
            <div class="app-toolbar-actions">
                <a href="{{ route('depense-categories.index') }}" class="btn btn-outline-secondary btn-sm">Retour</a>
            </div>
        </header>

        <form action="{{ route('depense-categories.store') }}" method="post">
            @include('depense_categories._form', ['btnMessage' => 'Enregistrer'])
        </form>
    </div>
</div>
@endsection
