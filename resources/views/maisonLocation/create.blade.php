@extends('layouts.app')


@section('content')
@include('maisonLocation._header')

<form action="{{ route('maison-location.store') }}" method="post">
	@method('post')
    @csrf
	@include('maisonLocation._form')
</form>

@endsection
