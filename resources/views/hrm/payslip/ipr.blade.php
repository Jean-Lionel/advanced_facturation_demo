@extends('layouts.app')

@section('content')
    <div>
        @include('hrm._hrm_header')
        <div class="row">
            <div class="col-md-6 d-flex justify-content-start">
                <h4 class="text-center">
                    Rapport IPR
                </h4>
            </div>
            <div class="col-md-12 d-flex justify-content-between">
                <form action="{{ route('payslip.reportIpr') }}" class="d-flex flex-row justify-content-between gap-2" method="get">
                    @csrf
                    <div class="form-group" id="datepicker5" >
                        <label for="month" class="form-label">Mois-Année</label>
                        <input type="month" class="form-control monthpickersearch" id="month" placeholder="choisir le mois" name="month" 
                                value="{{ old('month',$month) }}" >
                    </div>
                    
                    <div class="form-group mt-3">
                        <div class="mt-3 px-2">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> </button>
                            <a href="{{ route('payslip.reportIpr') }}" class="btn btn-secondary"><i class="fa fa-undo"></i> </a>
                        </div>
                    </div>

                </form>
                <div class="position-relative text-left btn-group">
                    <div class="mt-3">
                            <a href="javascript:window.print()" class="btn btn-primary"> <i class="ri-printer-line"></i> Imprimer</a>
                            <!-- <a href="javascript:void(0)" onclick="ExportToExcel('payslip_table_report','Rapport des Salaire Moi de: {{$date}}')" class="btn btn-secondary"> <i class="ri-file-excel-line"></i> Excel</a> -->
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-sm" id="datatable">
            <thead>
                <tr>
                    <th data-priority="1">Nom et Prénom</th>
                    <th data-priority="1">Mois-Année</th>
                    <th data-priority="3">Salaire de Base</th>
                    <th data-priority="3">Salaire Brut</th>
                    <th data-priority="3">Base taxable</th>
                    <th data-priority="3">IPR</th>
                    <th data-priority="3">Salaire Net</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payslips as $value)
                    <tr>
                        <td>{{ $value->last_name . ' ' . $value->first_name }}</td>
                        <td>{{ $value->month_year }}</td>
                        <td>{{ number_format($value->basic_salary, 0, ',', '.') }}</td>
                        <td>{{ number_format($value->gross_salary, 0, ',', '.') }}</td>
                        <td>{{ number_format($value->tax_base, 0, ',', '.') }}</td>
                        <td>{{ number_format($value->ire, 0, ',', '.') }}</td>
                        <td>{{ number_format(($value->net_salary), 0, ',', '.') }}</td>
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