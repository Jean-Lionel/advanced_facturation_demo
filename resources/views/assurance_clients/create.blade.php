@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Ajouter une Assurance Client</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('assurance_clients.store') }}">
                        @csrf
                        @include('assurance_clients._form', ['btnMessage' => 'Ajouter'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
