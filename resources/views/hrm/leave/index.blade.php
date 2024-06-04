@extends('layouts.app')

@section('content')
    <div>
        @include('hrm._hrm_header')
        <div class="row">
            <div class="col-md-6 d-flex justify-content-start">
                <h4 class="text-center">
                    Liste des congés
                </h4>
            </div>
            <div class="col-md-6 d-flex justify-content-between">
                <form action="{{ route('leave.index') }}" class="d-flex flex-row justify-content-around" style="width: 80%" method="get">
                    @csrf
                    <input type="text" name="search" class="form-control form-control-sm" style="width:80%" value="{{ $search }}" placeholder="Rechercher ici ">
                    <div style="width:10%">
                        <button class="btn btn-primary"><span class="fa fa-search"></span></button>
                    </div>
                </form>
                <div style="width: 20%">
                    <a href="javascript:void(0)" onclick="$('#add_leave_form').trigger('reset');$('#addLeaveModal').modal('show')" class="btn btn-outline-primary btn-sm">Ajouter un congé</a>
                </div>
            </div>
        </div>

        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Employé</th>
                    <th>Congé</th>
                    <th>Periode</th>
                    <th>Status</th>
                    <th>Auteur</th>
                    <th>Date de création</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($leaves as $value)
                    <tr>
                        <td>{{ $value->full_name }}</td>
                        <td>{{ $value->category }}</td>
                        <td>{{ $value->period }}</td>
                        <td>
                            @if($value->leave_status == 0)
                                <span class="badge bg-warning">En attante</span>
                            @elseif($value->leave_status == 1)
                                <span class="badge bg-success">Confirmé</span>
                            @else
                                <span class="badge bg-warning">Rejeté</span>
                            @endif
                        </td>
                        <td>{{ $value->creator }}</td>
                        <td>{{ date('d-m-Y',strtotime($value->request_date)) }}</td>
                        <td>
                            <a href="{{ route('leave.show',['leave' => $value->paid_leave_id]) }}" class="mr-2 btn btn-outline-warning btn-sm">Détail</a>
                            @if($value->leave_status == 0) 
                                <a data-href="{{ route('leave.update',['leave' => $value->paid_leave_id]) }}" data-leave="{{ json_encode($value) }}" onclick="editLeave(this)" class="mr-2 btn btn-outline-info btn-sm">Modifier</a>
                                <form class="form-approv" action="{{ route('leave.update' ,['leave' => $value->paid_leave_id]) }}" style="display: inline;" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                    <input type="hidden" name="action" value="confirm">
                                    <button class="btn btn-outline-secondary btn-sm" onclick="return confirm('Voulez-vous approuver ?')">Approuver</button>
                                </form>
                                <form class="form-delete" action="{{ route('leave.destroy' ,['leave' => $value->paid_leave_id]) }}" style="display: inline;" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Voulez-vous supprimer ?')">Supprimer</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <section>
        <!-- Add Leave modal content -->
        <div id="addLeaveModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="auth-brand text-center mt-2 mb-4 position-relative top-0">
                            <h4>Ajout d'un Congé</h4>
                        </div>

                        <form action="{{ route('leave.store') }}" id="add_leave_form" class="ps-3 pe-3">
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
                                <label for="category" class="form-label">Type de congé:</label>
                                <select name="category" id="category"  class="form-control select2" data-toggle="select2">
                                        <option selected disabled>Selectionner le congé</option>
                                        @foreach($typeLeaves as $value)
                                            <option value="{{ $value->leave_category_id }}">{{ $value->category }}</option>
                                        @endforeach
                                </select>
                                <div id="error_category"></div>
                            </div>

                            <div class="mb-3">
                                    <label for="period" class="form-label">Periode</label>
                                    <select name="period" id="period" class="form-control select2" data-toggle="select2" onchange="chose_period(this,'add')">
                                        <option disabled selected>--choissir une periode</option>
                                        <!-- <option value="hours">Heures</option> -->
                                        <option value="day">Une journée</option>
                                        <option value="many_days">Plusieurs jrs</option>
                                    </select>
                                    <div id="error_period"></div>
                            </div>
                            <div class="mb-3 start" hidden>
                                <label for="start_date" class="form-label"> Date de debut </label>
                                <input type="date" id="start_date" name="start_date" class="form-control">
                                <div id="error_start_date"></div>
                            </div>
                            <div class="mb-3 end" id="end_picker" hidden>
                                    <label for="end_date" class="form-label"> Date de Fin </label>
                                    <input type="date" id="end_date" name="end_date" class="form-control">
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <div id="infos" hidden>
                            <div class="spinner-border text-primary" role="status">
                                <!-- <span class="visually-hidden">Loading...</span> -->
                            </div>
                        </div>
                        <div class="mb-3 text-right">
                            <button type="button" class="btn btn-secondary" onclick="$('#addLeaveModal').modal('hide')">Annuler</button>
                            <button class="btn btn-primary" onclick="addLeave(this)" type="submit">Enregister</button>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <!-- Edit Leave modal content -->
        <div id="editLeaveModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="auth-brand text-center mt-2 mb-4 position-relative top-0">
                            <h4>Modification d'un congé</h4>
                        </div>

                        <form id="edit_leave_form" method="POST" class="ps-3 pe-3">
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
                                <label for="category" class="form-label">Type de congé:</label>
                                <select name="category" id="categoryUp"  class="form-control select2" data-toggle="select2">
                                        <option selected disabled>Selectionner le congé</option>
                                        @foreach($typeLeaves as $value)
                                            <option value="{{ $value->leave_category_id }}">{{ $value->category }}</option>
                                        @endforeach
                                </select>
                                <div id="error_category_up"></div>
                            </div>

                            <div class="mb-3">
                                    <label for="period" class="form-label">Periode</label>
                                    <select name="period" id="periodUp" class="form-control select2" data-toggle="select2" onchange="chose_period(this,'edit')">
                                        <option disabled selected>--choissir une periode</option>
                                        <!-- <option value="hours">Heures</option> -->
                                        <option value="day">Une journée</option>
                                        <option value="many_days">Plusieurs jrs</option>
                                    </select>

                                <div id="error_period_up"></div>
                            </div>
                            <div class="mb-3 startUp" id="startUp_picker" hidden>
                                <label for="start_date" class="form-label"> Date de debut </label>
                                <input type="date" id="start_dateUp" name="start_date" class="dateTimePicker_start form-control">
                                <div id="error_start_date_up"></div>
                            </div>
                            <div class="mb-3 endUp" id="endUp_picker" hidden>
                                <label for="end_date" class="form-label"> Date de Fin </label>
                                <input type="date" id="end_dateUp" name="end_date" class="dateTimePicker_fin form-control">
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
                            <button type="button" class="btn btn-secondary" onclick="$('#editLeaveModal').modal('hide')">Annuler</button>
                            <button class="btn btn-primary" onclick="updateLeave(this)">Modifier</button>
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
    var employees = <?= json_encode($employees)  ?>;

    function formatDate(date) {
        var thisDate = new Date(date);
        var day = thisDate.getDate();
        var month = thisDate.getMonth() + 1;
        month = month < 10 ? '0'+month : month;
        var year = thisDate.getFullYear();

        return `${day}-${month}-${year}`;
    }

    function chose_period(that,form) {
		var value = $(that).val();
        if(form == "add") {
            var start_div = $('.start');
		    var end_div = $('.end');
		    var duration_div = $('.duration');
        } else {
            var start_div = $('.startUp');
		    var end_div = $('.endUp');
		    var duration_div = $('.durationUp');
        }
		

		if(value == 'day') {
			start_div.attr('hidden',false);
			end_div.attr('hidden',true);
			duration_div.attr('hidden',true);
		} else if(value == 'many_days') {
			start_div.attr('hidden',false);
			end_div.attr('hidden',false);
			duration_div.attr('hidden',true);
		} else if(value == 'hours') {
			start_div.attr('hidden',false);
			duration_div.attr('hidden',false);
			end_div.attr('hidden',true);
		}
	}

    function addLeave(th) {
        $(th).attr('disabled',true);
        $('#infos').attr('hidden',false);
        var form = $('#add_leave_form');

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            dataType: 'json',
            data: form.serialize(),
            success: function(data) {
                
                if(data.success) {
                    $(th).attr('disabled',false);
                    $('#infos').attr('hidden',true);
                    $('#addLeaveModal').modal('hide');
                    $('.leave_table').load(' .leave_table');
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

    function editLeave(th) {
      var data = $(th).data('leave');
      var up_url = $(th).data('href');

      $('#employeeUp').val(data.employee_id).trigger('change');
      $('#categoryUp').val(data.leave_category_id).trigger('change');
      $('#start_dateUp').val(data.start_date);
      $('#end_dateUp').val(data.end_date);
    
      

        var start_div = $('.startUp');
        var end_div = $('.endUp');
        var duration_div = $('.durationUp');

        if(data.period == 1) {
            $('#periodUp').val('day').trigger('change');
            start_div.attr('hidden',false);
            end_div.attr('hidden',true);
            duration_div.attr('hidden',true);
        } else if(data.period < 1) {
            $('#periodUp').val('hours').trigger('change');
            start_div.attr('hidden',false);
            duration_div.attr('hidden',false);
            end_div.attr('hidden',true);
            var dur_hours = Number(String(data.period).split('.')[1])
            $('#duration_numUp').val(dur_hours);
        } else {
            $('#periodUp').val('many_days').trigger('change');
            start_div.attr('hidden',false);
            end_div.attr('hidden',false);
            duration_div.attr('hidden',true);
        }

      $('#edit_leave_form').attr('action',up_url);

      $('#editLeaveModal').modal('show');

    }

    function updateLeave(th) {
        $(th).attr('disabled',true);
        $('#info').attr('hidden',false);
        var form = $('#edit_leave_form');

        $.ajax({
            url: form.attr('action'),
            type: 'PUT',
            dataType: 'json',
            data: form.serialize(),
            success: function(data) {
                if(data.success) {
                    $(th).attr('disabled',false);
                    $('#info').attr('hidden',true);
                    $('#editLeaveModal').modal('hide');
                    $('.leave_table').load(' .leave_table');
                    form.trigger("reset");
                    window.location.reload();
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