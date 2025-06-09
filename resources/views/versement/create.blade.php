@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Nouveau versement</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('versement.store') }}">
                        @csrf

                        @php
                            $users = \App\Models\User::all();
                            $versementTypes = \App\Models\VersementType::all();
                        @endphp



                        @include('versement._form' , [
                            'versement' => new App\Models\Versement(),
                            'method' => 'POST',
                            'action' => route('versement.store')
                        ])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
