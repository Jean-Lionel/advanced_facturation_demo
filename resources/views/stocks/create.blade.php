@extends('layouts.app')


@section('content')

@include('products._header_product')



<form action="{{ route('stockes.store') }}" method="post">
	@method('post')

	@include('stocks._form')
</form>

@endsection
