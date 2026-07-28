@extends('layouts.app')

@section('content')
<div class="app-page">
    <div class="app-card">
        <header class="app-card-header">
            <h2 class="app-card-heading">Modifier la catégorie</h2>
            <div class="app-toolbar-actions">
                <a href="{{ route('depense-categories.index') }}" class="btn btn-outline-secondary btn-sm">Retour</a>
            </div>
        </header>

        <form action="{{ route('depense-categories.update', $depense_category) }}" method="post">
            @method('PUT')
            @include('depense_categories._form', ['btnMessage' => 'Modifier'])
        </form>
    </div>
</div>
@endsection
