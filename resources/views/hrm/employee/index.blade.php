@extends('layouts.app')

@section('content')
    <div>
        @include('hrm._hrm_header')
        <div class="row">
            <div class="col-md-6 d-flex justify-content-start">
                <h4 class="text-center">
                    Liste des employées
                </h4>
            </div>
            <div class="col-md-6 d-flex justify-content-between">
                <form action="{{ route('employee.index') }}" class="d-flex flex-row justify-content-around" style="width: 80%" method="get">
                    @csrf
                    <input type="text" name="search" class="form-control form-control-sm" style="width:80%" value="{{ $search }}" placeholder="Rechercher ici ">
                    <div style="width:10%">
                        <button class="btn btn-primary"><span class="fa fa-search"></span></button>
                    </div>
                </form>
                <div style="width: 20%">
                    <a href="{{ route('employee.create') }}" class="btn btn-outline-primary btn-sm">Ajouter un employé</a>
                </div>
            </div>
        </div>

        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Nom & Prénom</th>
                    <th>Département</th>
                    <th>Poste</th>
                    <th>Date Recrutement</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($employees as $value)
                    <tr>
                        <td>{{ $value->last_name .' '.$value->first_name }}</td>
                        <td>{{ $value->department }}</td>
                        <td>{{ $value->poste }}</td>
                        <td>{{ date('d-m-Y',strtotime($value->joining_date)) }}</td>
                        <td>
                            <a href="{{ route('employee.show',['employee' => $value->employee_id]) }}" class="mr-2 btn btn-outline-warning btn-sm">Détail</a>
                            <a href="{{ route('employee.edit',['employee' => $value->employee_id]) }}" class="mr-2 btn btn-outline-info btn-sm">Modifier</a>
                            <form class="form-delete" action="{{ route('employee.destroy' ,['employee' => $value->employee_id]) }}" style="display: inline;" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Voulez-vous supprimer ?')">Supprimer</button>
                            </form>
                        </td>
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