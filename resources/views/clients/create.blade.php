@extends('layouts.app')


@section('content')

@if(session('message'))
    <div class="alert alert-danger">
        {{ session('message') }}
    </div>
@endif

<form action="{{ route('clients.store') }}" method="post">
	@method('post')

    @csrf
	@include('clients._form')
</form>

@endsection
