@extends('layouts.app')


@section('content')
@include('products._header_product')


<form action="{{ route('stockes.update', $stocke) }}" method="post">
	@method('put')

	@include('stocks._form',['btnMessage' => 'Modifier'])
</form>

@endsection
