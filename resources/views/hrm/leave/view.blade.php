@extends('layouts.app')

@section('content')
    @include('hrm._hrm_header')

    <div class="text-center">
        <h3>Détail du congé</h3>
    </div>

    <div class="card-group">
        <div class="card">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>Nom & Prénom</b> : {{ $leave->last_name . ' ' . $leave->first_name }}</li>
                    <li class="list-group-item"><b>Département</b> : {{ $leave->department }}</li>
                    <li class="list-group-item"><b>Poste</b> : {{ $leave->fonction }}</li>
                    <li class="list-group-item"><b>Date de Demande</b> : {{ date('d-m-Y',strtotime($leave->request_date)) }}</li>
                </ul>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>Type de Congé sollicité</b> : {{ $leave->category }}</li>
                    <li class="list-group-item"><b>Date Début du Congé</b> : {{ date('d-m-Y',strtotime($leave->start_date)) }}</li>
                    <li class="list-group-item"><b>Date Fin  du Congé</b> : {{ date('d-m-Y',strtotime($leave->end_date)) }}</li>
                    <li class="list-group-item"><b>Nombre de jours</b> : {{ $leave->period }}</li>
                </ul>
            </div>
        </div>
    </div>

@endsection