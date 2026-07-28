@extends('layouts.app')

@section('content')
<div class="app-page">
    <div class="app-card">
        <header class="app-card-header">
            <h2 class="app-card-heading">Modifier la dépense</h2>
            <div class="app-toolbar-actions">
                <a href="{{ route('depenses.index') }}" class="btn btn-outline-secondary btn-sm">Retour</a>
            </div>
        </header>

        <form action="{{ route('depenses.update', $depense) }}" method="post">
            @method('put')
            @include('depenses._form', ['btnMessage' => 'Modifier'])
        </form>
    </div>
</div>
@endsection
