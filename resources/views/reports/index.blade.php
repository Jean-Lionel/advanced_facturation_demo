@extends('layouts.app')

@section('content')
<div class="app-page">
    @include('journals._header_file')

    <div class="app-card">
        <header class="app-card-header">
            <h2 class="app-card-heading">Rapport TVA</h2>
        </header>

        <div class="app-card-body">
            @livewire('repports.tax')
        </div>
    </div>
</div>
@endsection
