@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Ajouter une Assurance</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('assurances.store') }}">
                        @csrf
                        @include('assurances._form', ['btnMessage' => 'Ajouter'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
