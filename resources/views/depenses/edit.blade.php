@extends('layouts.app')

@section('content')
<div class="app-page">
    <div class="app-card">
        <header class="app-card-header">
            <h2 class="app-card-heading">Modifier dépense</h2>
        </header>

        <form action="{{ route('depenses.update', $depense) }}" method="post">
            @method('put')
            @include('depenses._form',['btnMessage' => 'Modifier'])
        </form>
    </div>
</div>
@endsection
