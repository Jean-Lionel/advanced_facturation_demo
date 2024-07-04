@extends('layouts.app')

@section('content')
    @include('hrm._hrm_header')

    <div class="text-center">
        <h3>BULLETIN DE PAIE POUR LE MOIS DE {{ $date }} </h3>
    </div>

    <div class="row mt-4">
        <div class="col-6">
            <h4 class="fs-14">Information de l'employé</h4>
            <p class="fs-13"><strong>Nom et Prénom: </strong> {{ $payslips->last_name .' '.$payslips->first_name }}</p>
            <p class="fs-13"><strong>Departement: </strong> {{ $payslips->department }}</p>
            <p class="fs-13"><strong>Poste: </strong> {{ $payslips->fonction }}</p>
            <p class="fs-13"><strong>Addresse: </strong> {{ $payslips->full_address }}</p>
        </div> <!-- end col--> <!-- end col-->
    </div>

    <div class="card-group">
        <div class="card">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>Salaire de Base</b> : {{ number_format($payslips->basic_salary, 0, ',','.') }}</li>
                    @foreach($indeminities as $value)
                    <li class="list-group-item"><b>Indeminité de {{ $value->title .' '.intval($value->percentage) }}%</b> :
                    {{ number_format($indemnityData[$value->type_indeminite_id], 0, ',','.') }}</li>
                    @endforeach
                    <li class="list-group-item"><b>Salaire Brut</b> : {{ number_format($payslips->gross_salary, 0, ',','.') }}</li>
                </ul>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>INSS 4% Employ</b> : {{  number_format($payslips->pension_salariale, 0, ',','.') }}</li>
                    <li class="list-group-item"><b>INSS PP(Pension) 6%</b> : {{  number_format($payslips->pension_patronale, 0, ',','.') }}</li>
                    <li class="list-group-item"><b>INSS PP(Risques Prof) 3%</b> : {{  number_format($payslips->risque_prof, 0, ',','.') }}</li>
                    <li class="list-group-item"><b>Revenu Imposable</b> : {{ number_format($payslips->tax_base, 0, ',','.') }}</li>
                    <li class="list-group-item"><b>IPR</b> : {{ number_format($payslips->ire, 0, ',','.') }}</li>
                    <li class="list-group-item"><b>Déduction</b> : {{ number_format($payslips->deduction, 0, ',','.') }}</li>
                </ul>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>Salaire Net</b> : {{number_format($payslips->net_salary, 0, ',','.')}}</li>
                </ul>
            </div>
        </div>
    </div>

@endsection
