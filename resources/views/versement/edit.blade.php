@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Modifier le versement #{{ $versement->id }}</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('versement.update', $versement) }}">
                        @csrf
                        @method('PUT')

                        @php
                            $users = \App\Models\User::all();
                            $versementTypes = \App\Models\VersementType::all();
                        @endphp

                        <x-versement._form
                            :users="$users"
                            :versementTypes="$versementTypes"
                            :versement="$versement"
                            method="PUT"
                            action="{{ route('versement.update', $versement) }}" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
