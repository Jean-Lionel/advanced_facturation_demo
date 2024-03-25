@extends('layouts.app')


@section('content')

@include('products._header_product')



<form action="{{ route('products.store') }}" method="post">
	@method('post')

	@include('products._form')
</form>

@endsection
