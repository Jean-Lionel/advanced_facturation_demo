@extends('layouts.app')

@section('content')
    @include('hrm._hrm_header')

    <div class="card-group">
        <div class="card">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>Nom & Prénom</b> : {{ $employee->last_name . ' ' . $employee->first_name }}</li>
                    <li class="list-group-item"><b>Département</b> : {{ $employee->poste->department->title }}</li>
                    <li class="list-group-item"><b>Poste</b> : {{ $employee->poste->title }}</li>
                    <li class="list-group-item"><b>Date de naissance</b> : {{ date('d/m/Y', strtotime($employee->date_of_birth)) }}</li>
                    <li class="list-group-item"><b>Sexe</b> : {{$employee->gender }}</li>
                    <li class="list-group-item"><b>Numero Carte d'identité</b> : {{ $employee->cni__number }}</li>
                </ul>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>Addresse</b> : {{ $employee->full_address }}</li>
                    <li class="list-group-item"><b>Nom du Pére</b> : {{ $employee->father_name }}</li>
                    <li class="list-group-item"><b>Nom de la Mére</b> : {{ $employee->mother_name }}</li>
                    <li class="list-group-item"><b>Contact</b> : {{ $employee->phone }}</li>
                    <li class="list-group-item"><b>Code INSS</b> : {{ $employee->code_inss }}</li>
                    <li class="list-group-item"><b>Date de Recrutement</b> : {{date('d/m/Y', strtotime($employee->joining_date)) }}</li>
                </ul>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>Banque</b> : {{ $bank_emp->bank_name ?? '-'}}</li>
                    <li class="list-group-item"><b>Numero de Compte</b> : {{ $bank_emp->account_number  ?? '-'}}</li>
                    <li class="list-group-item"><b>Salaire de Base</b> : {{ number_format($employee->salary->basic_salary ?? 0) }}</li>
                    <li class="list-group-item"><b>Salaire Brut</b> : {{ number_format($employee->salary->brut_salary ?? 0) }}</li>
                    <li class="list-group-item"><b>Salaire Net</b> : {{ number_format($employee->salary->net_salary ?? 0) }}</li>
                </ul>
            </div>
        </div>
    </div>

@endsection