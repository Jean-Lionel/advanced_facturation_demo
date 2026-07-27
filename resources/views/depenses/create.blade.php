@extends('layouts.app')

@section('content')
<div class="app-page">
    <div class="app-card">
        <header class="app-card-header">
            <h2 class="app-card-heading">Nouvelle dépense</h2>
        </header>

        <form action="{{ route('depenses.store') }}" method="post">
            @method('post')
            @include('depenses._form',['btnMessage' => 'Enregistrer'])
        </form>
    </div>
</div>
@endsection
