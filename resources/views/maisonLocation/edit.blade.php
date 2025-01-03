@extends('layouts.app')
@section('content')

@include('products._header_product')

<div>
	@livewire('maison-location.update', [
		'maisonLocation' => $maisonLocation 
	])
</div>


@endsection
