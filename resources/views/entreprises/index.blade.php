@extends('layouts.app')

@section('content')

<div>
	@include('entreprises.header')
	@livewire("entreprise.entreprise-component")
</div>
@stop