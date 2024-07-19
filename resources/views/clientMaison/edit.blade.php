@extends('layouts.app')


@section('content')

@include('products._header_product')



<form action="{{ route('categories.update', $category) }}" method="post">
	@method('put')

	@include('categories._form',['btnMessage' => 'Modifier'])
</form>

@endsection
