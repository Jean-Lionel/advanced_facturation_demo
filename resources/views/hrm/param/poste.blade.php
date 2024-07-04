@extends('layouts.app')

@section('content')
    <div>
        @include('hrm._hrm_header')

        <div class="row">
            <div class="col-lg-12 col-md-12 d-flex justify-content-between">
                <h4 class="text-center">
                    Liste des Postes
                </h4>

                <div style="width: 20%">
                    <a href="javascript:void(0)" onclick="$('#addPosteModal').modal('show')"
                     class="btn btn-outline-primary btn-sm">Ajouter</a>
                </div>
            </div>
        </div>

        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Département</th>
                    <th>Auteur</th>
                    <th>Date Création</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($postes as $value)
                    <tr>
                        <td>{{ $value->title }}</td>
                        <td>{{ $value->department->title ?? '-' }}</td>
                        <td>{{ $value->user->name ?? '-' }}</td>
                        <td>{{ $value->created_at }}</td>
                        <td>
                            <a data-href="{{ route('poste.update',['poste' => $value->fonction_id]) }}" data-poste="{{ json_encode($value) }}" onclick="editPoste(this)" class="mr-2 btn btn-outline-info btn-sm">Modifier</a>

                            <form class="form-delete" action="{{ route('poste.destroy',['poste' => $value->fonction_id]) }}" style="display: inline;" method="POST">
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
     <div id="addPosteModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="auth-brand text-center mt-2 mb-4 position-relative top-0">
                        <h4>Ajout d'une Poste</h4>
                    </div>

                    <form action="{{ route('poste.store') }}" id="add_poste_form" class="ps-3 pe-3">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Titre</label>
                            <input class="form-control" type="text" name="title" id="title" required="" >
                            <div id="error_title">

                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="department" class="form-label">Departement</label>
                            <select class="form-control select2" name="department" id="department" data-toggle="select2">
                                <option selected disabled>Select</option>
                                @foreach($departments as $val)
                                  <option value="{{ $val->department_id }}">{{ $val->title }}</option>
                                @endforeach
                            </select>
                            <div id="error_department">

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
                        <button type="button" class="btn btn-secondary" onclick="$('#addPosteModal').modal('hide')">Annuler</button>
                        <button class="btn btn-primary" onclick="addPoste(this)" type="submit">Enregister</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Edit Bank modal content -->
    <div id="editPosteModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="auth-brand text-center mt-2 mb-4 position-relative top-0">
                        <h4>Modification d'un département</h4>
                    </div>

                    <form id="edit_poste_form" class="ps-3 pe-3">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Titre</label>
                            <input class="form-control" type="text" name="title" id="title_up" required="" >
                            <div id="error_title_up">

                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="department" class="form-label">Departement</label>
                            <select class="form-control select2" name="department" id="department_up" data-toggle="select2">
                                <option selected disabled>Select</option>
                                @foreach($departments as $val)
                                  <option value="{{ $val->department_id }}">{{ $val->title }}</option>
                                @endforeach
                            </select>
                            <div id="error_department_up">

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
                        <button type="button" class="btn btn-secondary" onclick="$('#editPosteModal').modal('hide')">Annuler</button>
                        <button class="btn btn-primary" onclick="updatePoste(this)" type="submit">Modifier</button>
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
    function addPoste(th) {
        $(th).attr('disabled',true);
        $('#infos').attr('hidden',false);
        var form = $('#add_poste_form');

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            dataType: 'json',
            data: form.serialize(),
            success: function(data) {
                if(data.success) {
                    $(th).attr('disabled',false);
                    $('#infos').attr('hidden',true);
                    $('#addPosteModal').modal('hide');
                    $('.poste_table').load(' .poste_table');
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

    function editPoste(th) {
      var data = $(th).data('poste');
      var up_url = $(th).data('href');
      $('#title_up').val(data.title);
      $('#department_up').val(data.department_id);
      $('#department_up').val(data.department_id).trigger('change');

      $('#edit_poste_form').attr('action',up_url);

      $('#editPosteModal').modal('show');

    }

    function updatePoste(th) {
        $(th).attr('disabled',true);
        $('#info').attr('hidden',false);
        var form = $('#edit_poste_form');

        $.ajax({
            url: form.attr('action'),
            type: 'PUT',
            dataType: 'json',
            data: form.serialize(),
            success: function(data) {
                if(data.success) {
                    $(th).attr('disabled',false);
                    $('#info').attr('hidden',true);
                    $('#editPosteModal').modal('hide');
                    $('.poste_table').load(' .poste_table');
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
