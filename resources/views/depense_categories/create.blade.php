@extends('layouts.app')

@section('content')

<form action="{{ route('depense-categories.store') }}" method="post">
    @include('depense_categories._form', ['btnMessage' => 'Enregistrer'])
</form>

@endsection