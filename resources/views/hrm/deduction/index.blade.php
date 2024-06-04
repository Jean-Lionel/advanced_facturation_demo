@extends('layouts.app')

@section('content')

    <div>
        @include('hrm._hrm_header')

        <div class="row">
            <div class="col-lg-12 col-md-12 d-flex justify-content-between">
                <h4 class="text-center">
                    Liste des déductions sur Salaire
                </h4>

                <div style="width: 20%">
                    <a href="javascript:void(0)" onclick="$('#add_retenue_form').trigger('reset');$('#addRetenueModal').modal('show')" class="btn btn-outline-primary btn-sm">Ajouter une déduction</a>
                </div>
            </div>
        </div>

        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Employé</th>
                    <th>Retenue</th>
                    <th>Montant</th>
                    <th>Mois</th>
                    <th>Créer par</th>
                    <th>Date création</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($retenues as $value)
                    <tr>
                        <td>{{ $value->employee->last_name .' '.$value->employee->first_name }}</td>
                        <td>{{ $value->type->name_retenue_type ?? '-' }}</td>
                        <td>{{ $value->retenue_amount }}</td>
                        <td>{{ $value->retenue_month }}</td>
                        <td>{{ $value->user->name ?? '-' }}</td>
                        <td>{{ date('d/m/Y',strtotime($value->created_at)) }}</td>
                        <td>
                            <a data-href="{{ route('retenue.update',['retenue' => $value->employee_retenue_id]) }}" data-retenue="{{ json_encode($value) }}" onclick="editRetenue(this)" class="mr-2 btn btn-outline-info btn-sm">Modifier</a>
                            
                            <form class="form-delete" action="{{ route('retenue.destroy',['retenue' => $value->employee_retenue_id]) }}" style="display: inline;" method="POST">
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

    <section>
        <!-- Add Leave modal content -->
        <div id="addRetenueModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="auth-brand text-center mt-2 mb-4 position-relative top-0">
                            <h4>Ajout d'une déduction</h4>
                        </div>

                        <form action="{{ route('retenue.store') }}" id="add_retenue_form" class="ps-3 pe-3">
                            @csrf
                            <div class="mb-3">
                                <label for="employee" class="form-label">Employé:</label>
                                <select name="employee" id="employee" class="form-control select2" data-toggle="select2">
                                        <option selected disabled>Selectionner l'employé</option>
                                        @foreach($employees as $value)
                                            <option value="{{ $value->employee_id }}">{{ $value->first_name ." ". $value->last_name }}</option>
                                        @endforeach
                                </select>
                                <div id="error_employee"></div>
                            </div>

                            <div class="mb-3">
                                <label for="retenue" class="form-label">Déduction:</label>
                                <select name="retenue" id="retenue"  class="form-control select2" data-toggle="select2">
                                        <option selected disabled>Selectionner la déduction</option>
                                        @foreach($typeRetenues as $value)
                                            <option value="{{ $value->id_retenue_type }}">{{ $value->name_retenue_type }}</option>
                                        @endforeach
                                </select>
                                <div id="error_retenue"></div>
                            </div>

                            <div class="form-group">
                                <label for="montant" class="form-label">Montant:</label>
                                <input type="number" class="form-control" id="montant" name="montant">
                                <div id="error_montant"></div>
                            </div>
                            <div class="mb-3 position-relative" id="datepicker5">
                                <label for="month" class="col-form-label">Mois:</label>
                                <input type="month" class="form-control monthpicker" id="month" name="month">
                                <div id="error_month"></div>
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
                            <button type="button" class="btn btn-secondary" onclick="$('#addRetenueModal').modal('hide')">annuler</button>
                            <button type="button" class="btn btn-primary" onclick="addRetenue(this)">Enregistrer</button>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <!-- Edit Leave modal content -->
        <div id="editRetenueModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="auth-brand text-center mt-2 mb-4 position-relative top-0">
                            <h4>Modification d'une Déduction</h4>
                        </div>

                        <form id="edit_retenue_form" method="POST" class="ps-3 pe-3">
                            @csrf
                            <div class="mb-3">
                                <input type="hidden" name="action" value="update">
                                <label for="employee" class="form-label">Employé:</label>
                                <select name="employee" id="employeeUp" class="form-control select2" data-toggle="select2">
                                        <option selected disabled>Selectionner l'employé</option>
                                        @foreach($employees as $value)
                                            <option value="{{ $value->employee_id }}">{{ $value->first_name ." ". $value->last_name }}</option>
                                        @endforeach
                                </select>
                                <div id="error_employee_up"></div>
                            </div>

                            <div class="mb-3">
                                <label for="retenue" class="form-label">Retenue:</label>
                                <select name="retenue" id="retenueUp"  class="form-control select2" data-toggle="select2">
                                        <option selected disabled>Selectionner la retenue</option>
                                        @foreach($typeRetenues as $value)
                                            <option value="{{ $value->id_retenue_type }}">{{ $value->name_retenue_type }}</option>
                                        @endforeach
                                </select>
                                <div id="error_retenue_up"></div>
                            </div>

                            <div class="form-group">
                                <label for="montant" class="col-form-label">Montant:</label>
                                <input type="number" class="form-control" id="montantUp" name="montant">
                                <div id="error_montant_up"></div>
                            </div>

                            <div class="mb-3 position-relative" id="datepicker5">
                                <label for="month" class="col-form-label">Mois:</label>
                                <input type="text" class="form-control monthpicker" id="monthUp" name="month" >
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <div id="info" hidden>
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden"></span>
                            </div>
                        </div>
                        <div class="mb-3 text-right">
                            <button type="button" class="btn btn-secondary" onclick="$('#editRetenueModal').modal('hide')">Annuler</button>
                            <button type="button" class="btn btn-primary" onclick="updateRetenue(this)">Modifier</button>
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
    function addRetenue(th) {
        $(th).attr('disabled',true);
        $('#infos').attr('hidden',false);
        var form = $('#add_retenue_form');

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            dataType: 'json',
            data: form.serialize(),
            success: function(data) {
                if(data.success) {
                    $(th).attr('disabled',false);
                    $('#infos').attr('hidden',true);
                    $('#addRetenueModal').modal('hide');
                    $('.retenue_table').load(' .retenue_table');
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
                    $(th).attr('disabled',false);
                    $('#infos').attr('hidden',true);
                }
            }
        })
    }

    function editRetenue(th) {
      var data = $(th).data('retenue');
      var up_url = $(th).data('href');
      $('#employeeUp').val(data.employee_id_in_retenue).trigger('change');
      $('#retenueUp').val(data.retenue_id).trigger('change');
      $('#montantUp').val(data.retenue_amount);
      $('#monthUp').val(data.retenue_month);
      $('#edit_retenue_form').attr('action',up_url);

      $('#editRetenueModal').modal('show');

    }

    function updateRetenue(th) {
        $(th).attr('disabled',true);
        $('#info').attr('hidden',false);
        var form = $('#edit_retenue_form');

        $.ajax({
            url: form.attr('action'),
            type: 'PUT',
            dataType: 'json',
            data: form.serialize(),
            success: function(data) {
                if(data.success) {
                    $(th).attr('disabled',false);
                    $('#info').attr('hidden',true);
                    $('#editRetenueModal').modal('hide');
                    $('.retenue_table').load(' .retenue_table');
                    form.trigger("reset");
                    
                    window.location.raload();
                } else {
                    var errors = Object.entries(data.messages);
                    errors.forEach(element => {
                        $('#error_'+element[0]+'_up').html(`
                            <div class="alert alert-danger">
                                ${element[1][0]}
                            </div>
                        `);
                    });
                    $(th).attr('disabled',false);
                    $('#info').attr('hidden',true);
                }
            }
        });
    }
</script>
@endsection