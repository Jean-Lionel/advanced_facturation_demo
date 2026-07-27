@extends('layouts.app')

@section('content')
<div class="app-page">
    @include('maisonLocation._header')

    <div class="app-card">
        <header class="app-card-header">
            <h2 class="app-card-heading">Historique des Paiements</h2>
        </header>

        <div class="app-card-body--flush">
            @livewire('location.historique-payment')
        </div>
    </div>
</div>
@endsection
