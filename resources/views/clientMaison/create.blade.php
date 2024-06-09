@extends('layouts.app')


@section('content')
@include('products._header_product')




<form action="{{ route('categories.store') }}" method="post">
	@method('post')

	@include('categories._form')
</form>

@endsection
