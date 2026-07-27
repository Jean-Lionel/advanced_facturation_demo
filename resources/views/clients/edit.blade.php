@extends('layouts.app')

@section('content')
<div class="app-page">
    <div class="app-card">
        <header class="app-card-header">
            <h2 class="app-card-heading">Modifier client</h2>
        </header>

        <form action="{{ route('clients.update', $client) }}" method="post">
            @method('put')
            @csrf
            @include('clients._form',['btnMessage' => 'Modifier'])
        </form>
    </div>
</div>
@endsection
