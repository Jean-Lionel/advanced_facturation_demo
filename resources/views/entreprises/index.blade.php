@extends('layouts.app')

@section('content')
<div class="app-page">
    @include('entreprises.header')

    <div class="app-card">
        <header class="app-card-header">
            <h2 class="app-card-heading">Entreprise</h2>
            <div class="app-toolbar-actions">
                <a href="{{ route('entreprises.add_info') }}" class="btn btn-primary btn-sm">Ajouter des informations</a>
            </div>
        </header>

        <div>
            @livewire("entreprise.entreprise-component")
        </div>
    </div>
</div>
@stop
