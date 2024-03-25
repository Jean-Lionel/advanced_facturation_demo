@extends('layouts.app')


@section('content')
@include('products._header_product')




<form action="{{ route('products.update', $product) }}" method="post">
	@method('put')

	@include('products._form',['btnMessage' => 'Modifier'])
</form>

@endsection
