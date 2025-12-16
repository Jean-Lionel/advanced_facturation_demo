@extends('layouts.app')

@section('content')

<div>
	@include('entreprises.header')
	@livewire("entreprise.entreprise-component")
    <a href="{{ route('entreprises.add_info') }}" class="btn btn-primary">Ajouter des informations</a>
</div>
@stop
