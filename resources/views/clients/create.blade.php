@extends('layouts.app')


@section('content')
<form action="{{ route('clients.store') }}" method="post">
	@method('post')
    @csrf
	@include('clients._form')
</form>

@endsection
