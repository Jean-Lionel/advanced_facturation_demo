@extends('layouts.app')

@section('content')

<div>
	<div class="text-right">
		<a href="" class="btn btn-link">Entreprise</a>
		<a href="" class="btn btn-link">Déclaration Obr</a>
		<a href="" class="btn btn-link">Historique de déclaration Obr</a>
	</div>
	@livewire("entreprise.entreprise-component")
</div>
@stop