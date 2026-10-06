@extends('layouts.app')

@section('content')

@include('users._header_config')

<form action="{{ route('banque.store') }}" method="post">
    @include('banque._form', ['btnMessage' => 'Enregistrer'])
</form>

@endsection
