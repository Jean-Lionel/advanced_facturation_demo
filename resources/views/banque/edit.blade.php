@extends('layouts.app')

@section('content')

@include('users._header_config')

<form action="{{ route('banque.update', $banque) }}" method="post">
    @method('PUT')
    @include('banque._form', ['btnMessage' => 'Modifier'])
</form>

@endsection
