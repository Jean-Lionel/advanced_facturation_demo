@extends('layouts.app')

@section('content')

<div>
	@include('entreprises.header')
	@livewire("entreprise.entreprise-component")

    <a href="{{ route('entreprises.add_info') }}">Ajouter Plus d'information sur l'entreprise</a>
</div>
@stop
