@extends('layouts.app')

@section('content')
    <div>
        @include('hrm._hrm_header')
        <div class="row">
            <div class="col-md-6 d-flex justify-content-start">
                <h4 class="text-center">
                    Liste des Paiement des Employées
                </h4>
            </div>
            <div class="col-md-12 d-flex justify-content-between">
                <form action="{{ route('payslip.index') }}" class="d-flex flex-row justify-content-between gap-2"
                    method="get">
                    @csrf
                    <div class="form-group">
                        <label for="search" class="form-label">Recherche</label>
                        <input type="text" id="search" name="search" class="form-control"
                            placeholder="Nom ou prénom" value="{{ old('search', $search) }}">
                    </div>

                    <div class="form-group">
                        <label for="month" class="form-label">Mois-Année</label>
                        <input type="month" class="form-control monthpickersearch" id="month"
                            placeholder="choisir le mois" name="month" value="{{ old('month', $month) }}">
                    </div>

                    <div class="form-group">
                        <label for="status" class="form-label">Statut</label>
                        <select class="form-control select2" name="status" id="status" data-toggle="select2">
                            <option selected disabled>Selectionner le statut</option>
                            <option value="0" {{ $status == "0" ? 'selected' : '' }}>Impayer</option>
                            <option value="1" {{ $status == "1" ? 'selected' : '' }}>Payer</option>
                        </select>
                    </div>

                    <div class="form-group mt-3 p-2">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> </button>
                        <a href="{{ route('payslip.index') }}" class="btn btn-info btn-sm"><i class="fa fa-undo"></i> </a>
                    </div>

                </form>
                <div class="position-relative text-left btn-group">
                    <div class="mt-3">
                        <a href="javascript:void(0)"
                            onclick="$('#add_payslip_form').trigger('reset');$('#addPayslipModal').modal('show')"
                            class="btn btn-primary"> <i class="ri-add-box-fill"></i> Génerer les salaires</a>
                    </div>
                    <div class="dropdown mt-3">
                        <button class="btn btn-secondary dropdown-toggle" type="button" 
                        id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action Multiple
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" data-href="{{ route('payslip.pay') }}"
                                        onclick="paySalaries(this)">Paiement</a>
                            <a class="dropdown-item" data-href="{{ route('payslip.delete') }}"
                                onclick="deleteSalaries(this)">Supression</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-sm">
            <thead>
                <tr>
                    <th style="width: 3% !important;">
                        <input type="checkbox" onclick="checkAll(this)"
                            class="checkall filled-in btn" id="checked-all" />
                        <label for="checked-all"></label>
                    </th>
                    <th>Employé</th>
                    <th>Salaire de Base</th>
                    <th>Salaire Brut</th>
                    <th>Salaire Net</th>
                    <th>Mois-Année </th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($payslips as $value)
                    <tr>
                        <td class="tcheckbox">
                            <input type="checkbox" class="ids filled-in" name="ids[]"
                                <?= $value->statut == 0 ? '' : 'disabled' ?>
                                value="{{ $value->salary_payment_id }}"
                                id="val-{{ $value->salary_payment_id }}" />
                            <label for="val-{{ $value->salary_payment_id }}"></label>
                        </td>
                        <td>{{ $value->last_name . ' ' . $value->first_name }}</td>
                        <td>{{ $value->basic_salary }}</td>
                        <td>{{ $value->gross_salary }}</td>
                        <td>{{ $value->net_salary }}</td>
                        <td>{{ $value->month_year }}</td>
                        <td>
                            @if ($value->statut == 0)
                                <span class="badge bg-warning">Impayé</span>
                            @else
                                <span class="badge bg-success">Payé</span>
                            @endif
                        </td>
                        <td>
                            
                            <a href="{{ route('payslip.show', ['id' => $value->salary_payment_id]) }}"
                                class="mr-2 btn btn-outline-warning btn-sm">Fiche de Paie</a>
                            @if ($value->statut == 0)
                                <a data-href="{{ route('payslip.regenerate') }}"
                                    data-payslip="{{ json_encode($value) }}"
                                    onclick="regeneratePayslip(this)"
                                    class="mr-2 btn btn-outline-info btn-sm">Regénerer le salaire</a>
                                <a data-href="{{ route('payslip.pay') }}"
                                    data-id="{{ $value->salary_payment_id }}"
                                    onclick="paySingleSalary(this)"
                                    class="btn btn-sm btn-outline-secondary" >
                                    Valider le salaire
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            {{ $payslips->links() }}
        </div>
    </div>


    <section>
        <!-- Add Leave modal content -->
        <div id="addPayslipModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="auth-brand text-center mt-2 mb-4 position-relative top-0">
                            <h4>Choisir le Mois</h4>
                        </div>

                        <form action="{{ route('payslip.generate') }}" id="add_payslip_form" class="ps-3 pe-3">
                            @csrf

                            <div class="mb-3 position-relative" id="datepicker5">
                                <label for="month_year" class="form-label"> Mois</label>
                                <input type="month" id="month_year" name="month_year" placehorder="mois année"
                                    class="form-control monthpicker" >

                                <div id="error_error"></div>
                                <div id="error_month_year"></div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <div id="infos" hidden>
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden"></span>
                            </div>
                        </div>
                        <div class="mb-3 text-right">
                            <button type="button" class="btn btn-secondary"
                                onclick="$('#addPayslipModal').modal('hide')">Annuler</button>
                            <button class="btn btn-primary" onclick="generatePayslip(this)"
                                type="submit">Génerer</button>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </section>
    
@endsection

@section('javascript')
<script>
        

    function generatePayslip(th) {
        $(th).attr('disabled', true);
        $('#infos').attr('hidden', false);
        var form = $('#add_payslip_form');

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            dataType: 'json',
            data: form.serialize(),
            success: function(data) {
                if (data.success) {
                    $(th).attr('disabled', false);
                    $('#infos').attr('hidden', true);
                    $('#addPayslipModal').modal('hide');
                    $('.payslip_table').load(' .payslip_table');
                    form.trigger("reset");
                    window.location.reload();

                } else {
                    var errors = Object.entries(data.messages);
                    errors.forEach(element => {
                        $('#error_'+element[0]).html(`
                            <div class="alert alert-danger">
                                ${element[1][0]}
                            </div>
                        `);
                    });
                    $(th).attr('disabled', false);
                    $('#infos').attr('hidden', true);
                }
            }
        })
    }

    function checkAll(th) {
        var allSelectBox = $('input[name="ids[]"]');

        Object.values(allSelectBox).forEach(element => {
            $(element).click();
        });
    }

    function paySalaries(th) {
        var url = $(th).data('href');
        var selectedBox = $('input[name="ids[]"]:checked');

        if (selectedBox.length > 0) {
            var payslipIds = [];
            Object.values(selectedBox).forEach(row => {
                if (row.nodeName != undefined) {
                    payslipIds.push(
                        $(row).val()
                    );
                }
            });


            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    payslipIds: payslipIds
                },
                success: function(data) {
                    if (data.success) {
                        $(th).attr('disabled', false);
                        $('.payslip_table').load(' .payslip_table');
                        window.location.reload();

                    } else {
                        window.location.reload();

                        $(th).attr('disabled', false);
                        $('#infos').attr('hidden', true);
                    }
                }
            });
        } else {
            alert('Vous devez au moins sélectionner un employé pour continuer');
        }
    }

    function paySingleSalary(th) {
        $(th).attr('disabled',true);
        var url = $(th).data('href');
        var id = $(th).data('id');

        var payslipIds = [];
        payslipIds.push(id);
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: {
                "_token": "{{ csrf_token() }}",
                payslipIds: payslipIds
            },
            success: function(data) {
                if (data.success) {
                    $(th).attr('disabled', false);
                    $('.payslip_table').load(' .payslip_table');
                    
                    window.location.reload();

                } else {
                    window.location.reload();
                    
                    $(th).attr('disabled', false);
                    $('#infos').attr('hidden', true);
                }
            }
        });

    }

    function regeneratePayslip(th) {
        var url = $(th).data('href');
        var data = $(th).data('payslip');

        var payslipIds = [];
        var employeeIds = [];
        payslipIds.push(data.salary_payment_id);
        employeeIds.push(data.employee_id);
        
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: {
                "_token": "{{ csrf_token() }}",
                payslipIds: payslipIds,
                employeeIds: employeeIds,
                month: data.month_year,
            },
            success: function(data) {
                if (data.success) {
                    $(th).attr('disabled', false);
                    $('.payslip_table').load(' .payslip_table');
                    
                    window.location.reload();

                } else {
                    window.location.reload();

                    $(th).attr('disabled', false);
                    $('#infos').attr('hidden', true);
                }
            }
        });

    }

    function deleteSalaries(th) {
        var url = $(th).data('href');
        var selectedBox = $('input[name="ids[]"]:checked');

        if (selectedBox.length > 0) {
            var payslipIds = [];
            Object.values(selectedBox).forEach(row => {
                if (row.nodeName != undefined) {
                    payslipIds.push(
                        $(row).val()
                    );
                }
            });


            $.ajax({
                url: url,
                type: 'delete',
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    payslipIds: payslipIds
                },
                success: function(data) {
                    if (data.success) {
                        $(th).attr('disabled', false);
                        $('.payslip_table').load(' .payslip_table');
                        
                        window.location.reload();

                    } else {
                        window.location.reload();

                        $(th).attr('disabled', false);
                        $('#infos').attr('hidden', true);
                    }
                }
            });
        } else {
            alert("Vous devez au moins sélectionner un employé pour continuer");
        }
    }
    </script>
@endsection