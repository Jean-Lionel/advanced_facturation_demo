@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Modifier l'Assurance : {{ $assurance->name }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('assurances.update', $assurance->id) }}">
                        @csrf
                        @method('PUT')
                        @include('assurances._form', ['btnMessage' => 'Modifier'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
