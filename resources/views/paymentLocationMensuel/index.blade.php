@extends('layouts.app')

@section('content')
<div class="app-page">
    @include('maisonLocation._header')

    <div class="app-card">
        <header class="app-card-header">
            <h2 class="app-card-heading">Paiement de Location Mensuel</h2>
        </header>

        <div class="app-card-body--flush">
            @livewire('location.payment-mensuel')
        </div>
    </div>
</div>
@endsection
