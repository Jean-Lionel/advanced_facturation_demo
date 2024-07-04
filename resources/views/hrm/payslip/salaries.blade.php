@extends('layouts.app')

@section('content')
    <div>
        @include('hrm._hrm_header')
        <div class="row">
            <div class="col-md-6 d-flex justify-content-start">
                <h4 class="text-center">
                    Rapport Salaires
                </h4>
            </div>
            <div class="col-md-12 d-flex justify-content-between">
                <form action="{{ route('payslip.reportSalary') }}" class="d-flex flex-row justify-content-between gap-2" method="get">
                    @csrf
                    <div class="form-group" id="datepicker5" >
                        <label for="month" class="form-label">Mois-Année</label>
                        <input type="month" class="form-control monthpickersearch" id="month" placeholder="choisir le mois" name="month" 
                                value="{{ old('month',$month) }}" >
                    </div>
                    
                    <div class="form-group mt-3">
                        <div class="mt-3 px-2">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> </button>
                            <a href="{{ route('payslip.reportSalary') }}" class="btn btn-secondary"><i class="fa fa-undo"></i> </a>
                        </div>
                    </div>

                </form>
                <div class="position-relative text-left btn-group">
                    <div class="mt-3">
                            <a href="javascript:window.print()" class="btn btn-primary"> <i class="ri-printer-line"></i> Imprimer</a>
                            <!-- <a href="javascript:void(0)" onclick="tableToExcel('payslip_table_report','Rapport des Salaire Moi de: {{$date}}')" class="btn btn-secondary"> <i class="ri-file-excel-line"></i> Excel</a> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="position-relative text-rigth pr-2">
            <h3>BULLETIN DE PAIE POUR LE MOIS DE {{ $date }}</h3>
        </div>

        <table class="table table-sm" id="payslip_table_report">
            <thead>
                <tr>
                    <th data-priority="1">Nom et Prénom</th>
                    <th data-priority="3">Salaire de Base</th>
                    @foreach($indeminities as $value)
                        <th>Indeminité de {{ $value->title .' '.intval($value->percentage) }}%</th>
                    @endforeach
                    <th data-priority="3">Salaire Brut</th>
                    <th data-priority="3">INSS 4% Employ</th>
                    <th data-priority="3">INSS PP(Pension) 6%</th>
                    <th data-priority="3">INSS PP(Risques Prof) 3%</th>
                    <th data-priority="3">Revenu Imposable</th>
                    <th data-priority="3">IPR</th>
                    <th data-priority="3">Déduction</th>
                    <th data-priority="3">Salaire Net</th>
                </tr>
            </thead>

            <tbody>
                @foreach($payslips as $value)
                    <tr>
                        <td>{{ $value->last_name .' '.$value->first_name }}</td>
                        <td>{{ number_format($value->basic_salary, 0,',','.') }}</td>
                        @foreach($indeminities as $val)
                            <td>{{ number_format($indemnityData[$value->employee_id][$val->type_indeminite_id], 0, ',','.') }}</td>
                        @endforeach
                        <td>{{ number_format($value->gross_salary, 0,',','.') }}</td>
                        <td>{{ number_format($value->pension_salariale, 0,',','.') }}</td>
                        <td>{{ number_format($value->pension_patronale, 0,',','.') }}</td>
                        <td>{{ number_format($value->risque_prof, 0,',','.') }}</td>
                        <td>{{ number_format($value->tax_base, 0,',','.') }}</td>
                        <td>{{ number_format($value->ire, 0,',','.') }}</td>
                        <td>{{ number_format($value->deduction, 0,',','.') }}</td>
                        <td>{{ number_format(($value->net_salary), 0,',','.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


 
@endsection

@section('javascript')
<script>
  

    
</script>
@endsection