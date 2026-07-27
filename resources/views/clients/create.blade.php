@extends('layouts.app')

@section('content')
<div class="app-page">
    @if(session('message'))
        <div class="alert alert-danger">
            {{ session('message') }}
        </div>
    @endif

    <div class="app-card">
        <header class="app-card-header">
            <h2 class="app-card-heading">Nouveau client</h2>
        </header>

        <form action="{{ route('clients.store') }}" method="post">
            @method('post')
            @csrf
            @include('clients._form')
        </form>
    </div>
</div>
@endsection
