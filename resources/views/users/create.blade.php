@extends('layouts.app')

@section('content')
<div class="app-page">
    @include('users._header_config')

    <div class="app-card">
        <header class="app-card-header">
            <h2 class="app-card-heading">Nouvel utilisateur</h2>
            <div class="app-toolbar-actions">
                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-sm">Retour</a>
            </div>
        </header>

        <form action="{{ route('users.store') }}" method="post">
            @method('post')
            @include('users._form')
        </form>
    </div>
</div>
@endsection
