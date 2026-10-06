@extends('layouts.app')

@section('content')

<form action="{{ route('depense-categories.update', $depense_category) }}" method="post">
    @method('PUT')
    @include('depense_categories._form', ['btnMessage' => 'Modifier'])
</form>

@endsection