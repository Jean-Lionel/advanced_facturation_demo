@extends('layouts.app')


@section('content')

@include('hrm._hrm_header')

<form action="{{ route('employee.store') }}" method="post">
	@method('post')
    @csrf

    <div class="row">
        <div class="col-md-12">
            <h3>Formulaire d'ajout d'un employée</h3>
        </div>

        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label for="last_name">Nom</label>
                <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name"
                    name="last_name" value="{{ old('last_name') }}" >
                @error('last_name')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="date_of_birth">Date de Naissance</label>
                <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" id="date_of_birth"
                    name="date_of_birth"  value="{{ old('date_of_birth') }}">
                @error('date_of_birth')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="father_name">Nom du Pere</label>
                <input type="text" class="form-control" id="father_name"
                    name="father_name" value="{{ old('father_name') }}">
            </div> <!-- end col -->

            <div class="form-group">
                <label for="fonction_id" class="form-label">Poste</label>
                <select class="form-control select2 @error('fonction_id') is-invalid @enderror" name="fonction_id" id="fonction_id" data-toggle="select2">
                    <option selected disabled>Selectionner le Poste</option>
                    @foreach($postes as $val)
                    <option value="{{ $val->fonction_id }}">{{ $val->title }}</option>
                    @endforeach
                </select>
                @error('fonction_id')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="phone">Numero de Télephone</label>
                <input type="text" class="form-control" id="phone"
                    name="phone" value="{{ old('phone') }}">
            </div>

            <div class="form-group" id="joining_date_picker">
                <label class="form-label" for="joining_date">Date de Recrutement</label>
                <input type="date" class="dateTimePickers form-control @error('joining_date') is-invalid @enderror" id="joining_date"
                    name="joining_date" value="{{ old('joining_date') }}">
                @error('joining_date')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group" id="leaving_date_picker">
                <label class="form-label" for="leaving_date">Date de Départ</label>
                <input type="date" class="form-control dateTimePickers" id="leaving_date"
                    name="leaving_date"  value="{{ old('leaving_date') }}">
            </div>
        </div>

        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label class="form-label" for="first_name">Prénom</label>
                <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name"
                    name="first_name" value="{{ old('first_name') }}">
                @error('first_name')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="gender" class="form-label">Sexe</label>
                <select class="form-control select2 @error('gender') is-invalid @enderror" name="gender" id="gender" data-toggle="select2">
                    <option selected disabled>Selectionner le sexe</option>
                    <option value="homme">Homme</option>
                    <option value="Femme">Femme</option>
                </select>
                @error('gender')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label class="form-label" for="mother_name">Nom de la Mere</label>
                <input type="text" class="form-control" id="mother_name"
                    name="mother_name" value="{{ old('mother_name') }}">
            </div> <!-- end col -->

            <div class="form-group">
                <label class="form-label" for="cni_number">Numero Carte d'Identité</label>
                <input type="text" class="form-control @error('cni_number') is-invalid @enderror" id="cni_number"
                    name="cni_number" value="{{ old('cni_number') }}">
                @error('cni_number')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="code_inss">Code INSS</label>
                <input type="text" class="form-control" id="code_inss"
                    name="code_inss" value="{{ old('code_inss') }}">
            </div>

            <div class="form-group">
                <label class="form-label" for="full_address">Addresse</label>
                <input type="text" class="form-control" id="full_address"
                    name="full_address" value="{{ old('full_address') }}">
            </div>
        </div>

        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label for="bank_id" class="form-label">Banque</label>
                <select class="form-control select2" name="bank_id" id="bank_id" data-toggle="select2">
                    <option selected disabled>Selectionner la Banque</option>
                    @foreach($banks as $val)
                    <option value="{{ $val->bank_id }}">{{ $val->bank_name }}</option>
                    @endforeach
                </select>
            </div> <!-- end col -->
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label class="form-label" for="account_number">Numero de compte</label>
                <input type="text" class="form-control" id="account_number"
                    name="account_number" value="{{ old('account_number') }}">
            </div> <!-- end col -->
        </div>

        <div class="col-lg-6 col-md-6">
            <div class="form-group mb-4">
                <label class="form-label" for="basic_salary">Salaire de Base </label>
                <input type="number" class="form-control @error('basic_salary') is-invalid @enderror" id="basic_salary"
                    name="basic_salary" value="{{ old('basic_salary') }}" onchange="calcNetSalary()" oninput="calcNetSalary()" >
                @error('basic_salary')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label class="form-label" for="indeminity">Indeminités</label>
                <select class="select2 form-control select2-multiple" data-toggle="select2"
                                    multiple="multiple" id="indeminity" name="indeminity[]" 
                                    data-placeholder="Selectioner les indeminités" onchange="calcNetSalary()">
                    @foreach($indeminities as $value)
                        <option value="{{ $value->type_indeminite_id }}">{{ $value->title.''.$value->percentage.'%' }}</option>
                    @endforeach
                </select>
            </div>
        </div> <!-- end col -->

        <div class="col-lg-6 col-md-6">
            

            <div class="form-group">
                <label class="form-label" for="net_salary">Salaire Net</label>
                <input type="text" class="form-control" id="net_salary"
                    name="net_salary" readonly value="{{ old('net_salary') }}">
                <input type="hidden" name="brut_salary" id="brut_salary">

            </div>
        </div> <!-- end col -->

        <div class="col-lg-12 col-md-12 text-center mb-5">
            <button class="btn btn-primary" type="submit">Enregister</button>
        </div>
    </div>
</form>

@endsection

@section('javascript')
<script>
    const indeminities = <?= json_encode($indeminities) ?>;

    function calcNetSalary() {
        const maxGrossSalary = 450000;
        const maxGrossSalaryRisq = 80000;
        const innssEmployee = 4;
        const innssEmployer = 6;
        const innssRisq = 3;

        const mfpEmployeePerc = 4;
        const mfpEmployerPerc = 6;

        var basic_salary = parseFloat($('#basic_salary').val() != "" ? $('#basic_salary').val() : 0);
        var additional_pension = parseFloat($('#additional_pension').val() != "" ? $('#additional_pension').val() : 0);
        var chosedIndeminity = $('#indeminity').val();
        var totalAllowancesNotTaxable = 0;
        var totalAllowances = 0;
        chosedIndeminity.forEach(element => {
            let val = indeminities.filter(row => row.type_indeminite_id == element)[0];
            if(val.taxable == 0) {
                totalAllowances = totalAllowances + Math.round((basic_salary * val.percentage)/100);
            } else {
                totalAllowancesNotTaxable = totalAllowancesNotTaxable + Math.round((basic_salary * val.percentage)/100);
            }
        });


        var gross_salary = basic_salary + totalAllowances + totalAllowancesNotTaxable;


        var pension_salariale = 0;
        var pension_patronale = 0;
        var risque_professionel = 0;

        if(gross_salary <= maxGrossSalary) {
            pension_salariale = Math.round((gross_salary  * innssEmployee)/100);
            pension_patronale = Math.round((gross_salary  * innssEmployer)/100);
        } else {
            pension_salariale = Math.round((maxGrossSalary  * innssEmployee)/100);
            pension_patronale = Math.round((maxGrossSalary  * innssEmployer)/100);
        }

        if(gross_salary <= maxGrossSalaryRisq) {
            risque_professionel = Math.round((gross_salary  * innssRisq)/100);
        } else {
            risque_professionel = Math.round((maxGrossSalaryRisq  * innssRisq)/100);
        }

        var inss = pension_salariale + pension_patronale + risque_professionel;

        var tax_base = gross_salary - pension_salariale - totalAllowances;

        var IPR = 0;

        if(tax_base >= 0 && tax_base <= 150000) {
            IPR = 0;
        } else if(tax_base >= 150000 && tax_base <= 300000){
            IPR = Math.round((tax_base - 150000) * 20 / 100);
        } else if(tax_base > 300000){
            IPR = Math.round(((tax_base - 300000 ) * 30 / 100) + 30000);
        }

        if(IPR < 0){
            IPR =0;
        }

        
        var net_salary = parseFloat(gross_salary - pension_salariale - IPR);
        $('#net_salary').val(net_salary);
        $('#brut_salary').val(gross_salary);
        return;
        console.log(
            {
                totalAllowances: totalAllowances,
                gross_salary: gross_salary,
                pension_salariale: pension_salariale,
                pension_patronale:pension_patronale,
                risque_professionel:risque_professionel,
                inss:inss,
                tax_base:tax_base,
                IPR:IPR,
                net_salary:net_salary
            }
        );
    }
</script>
@endsection
