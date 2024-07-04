@extends('layouts.app')

@section('content')
    <div>
        @include('hrm._hrm_header')

        <div class="row">
            <div class="col-lg-12 col-md-12 d-flex justify-content-between">
                <h4 class="text-center">
                    Liste des Categories de Congés
                </h4>

                <div style="width: 20%">
                    <a href="javascript:void(0)" onclick="$('#addTypeLeaveModal').modal('show')"
                     class="btn btn-outline-primary btn-sm">Ajouter une category</a>
                </div>
            </div>
        </div>

        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Date Création</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($typeLeaves as $value)
                    <tr>
                        <td>{{ $value->category }}</td>
                        <td>{{ $value->user->name }}</td>
                        <td>{{ $value->created_at }}</td>
                        <td>
                            <a data-href="{{ route('typeLeave.update',['typeLeave' => $value->leave_category_id]) }}" data-leave="{{ json_encode($value) }}" onclick="editTypeLeave(this)" class="mr-2 btn btn-outline-info btn-sm">Modifier</a>

                            <form class="form-delete" action="{{ route('typeLeave.destroy',['typeLeave' => $value->leave_category_id]) }}" style="display: inline;" method="POST">
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
    <!-- Add Bank modal content -->
    <div id="addTypeLeaveModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="auth-brand text-center mt-2 mb-4 position-relative top-0">
                        <h4>Ajouter un Type de congé</h4>
                    </div>

                    <form id="add_typeLeave_form" method="POST" action="{{ route('typeLeave.store') }}">
                      @csrf
                      <div class="form-group">
                          <label for="category" class="col-form-label">Titre:</label>
                          <input type="text" class="form-control" id="category" name="category">
                          <div id="error_category">

                          </div>
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
                        <button type="button" class="btn btn-secondary" onclick="$('#addTypeLeaveModal').modal('hide')">annuler</button>
                        <button type="button" class="btn btn-primary" onclick="addTypeLeave(this)">Enregistrer</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Edit Bank modal content -->
    <div id="editTypeLeaveModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="auth-brand text-center mt-2 mb-4 position-relative top-0">
                        <h4>Modification d'un Type de congé</h4>
                    </div>

                    <form id="edit_typeLeave_form" method="POST">
                      @csrf
                      <div class="form-group">
                          <label for="category" class="col-form-label">Titre:</label>
                          <input type="text" class="form-control" id="category_up" name="category">
                          <div id="error_category_up">

                          </div>
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
                        <button type="button" class="btn btn-secondary" onclick="$('#editTypeLeaveModal').modal('hide')">annuler</button>
                        <button type="button" class="btn btn-primary" onclick="updateTypeLeave(this)">Modifier</button>
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
    function addTypeLeave(th) {
        $(th).attr('disabled',true);
        $('#infos').attr('hidden',false);
        var form = $('#add_typeLeave_form');

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            dataType: 'json',
            data: form.serialize(),
            success: function(data) {
                if(data.success) {
                    $(th).attr('disabled',false);
                    $('#infos').attr('hidden',true);
                    $('#addTypeLeaveModal').modal('hide');
                    $('.typeLeave_table').load(' .typeLeave_table');
                    form.trigger("reset");

                    window.location.reload();

                } else {
                    if(data.messages.category != undefined) {
                        $('#error_category').html(`
                            <div class="alert alert-danger">${ data.messages.category[0] }</div>
                        `);
                    }else {
                        $('#error_area_category').html("");
                    }


                    $(th).attr('disabled',false);
                    $('#infos').attr('hidden',true);
                }
            }
        })
    }

    function editTypeLeave(th) {
      var data = $(th).data('leave');
      var up_url = $(th).data('href');
      $('#category_up').val(data.category);
      $('#edit_typeLeave_form').attr('action',up_url);

      $('#editTypeLeaveModal').modal('show');

    }

    function updateTypeLeave(th) {
        $(th).attr('disabled',true);
        $('#info').attr('hidden',false);
        var form = $('#edit_typeLeave_form');

        $.ajax({
            url: form.attr('action'),
            type: 'PUT',
            dataType: 'json',
            data: form.serialize(),
            success: function(data) {
                if(data.success) {
                    $(th).attr('disabled',false);
                    $('#info').attr('hidden',true);
                    $('#editTypeLeaveModal').modal('hide');
                    $('.typeLeave_table').load(' .typeLeave_table');
                    form.trigger("reset");
                    window.location.reload();
                } else {

                    if(data.messages.category != undefined) {
                        $('#error_category_up').html(`
                            <div class="alert alert-danger">${ data.messages.category[0] }</div>
                        `);
                    }else {
                        $('#error_area_category_up').html("");
                    }


                    $(th).attr('disabled',false);
                    $('#info').attr('hidden',true);
                }
            }
        });
    }
</script>
@endsection
