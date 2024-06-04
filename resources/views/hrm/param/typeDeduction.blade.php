@extends('layouts.app')

@section('content')
    <div>
        @include('hrm._hrm_header')

        <div class="row">
            <div class="col-lg-12 col-md-12 d-flex justify-content-between">
                <h4 class="text-center">
                    Liste des Types de Déductions
                </h4>

                <div style="width: 20%">
                    <a href="javascript:void(0)" onclick="$('#addTypeRetenueModal').modal('show')"
                     class="btn btn-outline-primary btn-sm">Ajouter</a>
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
                @foreach($typeRevenues as $value)
                    <tr>
                        <td>{{ $value->name_retenue_type }}</td>
                        <td>{{ $value->user->name }}</td>
                        <td>{{ $value->createdAt_retenue_type }}</td>
                        <td>
                        <td>
                            <a data-href="{{ route('typeRetenue.update',['typeRetenue' => $value->id_retenue_type]) }}" data-retenue="{{ json_encode($value) }}" onclick="editTypeRetenue(this)" class="mr-2 btn btn-outline-info btn-sm">Modifier</a>
                            
                            <form class="form-delete" action="{{ route('typeRetenue.destroy',['typeRetenue' => $value->id_retenue_type]) }}" style="display: inline;" method="POST">
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
    <div id="addTypeRetenueModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="auth-brand text-center mt-2 mb-4 position-relative top-0">
                        <h4>Ajouter un Type de Déduction</h4>
                    </div>

                    <form id="add_typeRetenue_form" method="POST" action="{{ route('typeRetenue.store') }}">
                      @csrf
                      <div class="form-group">
                          <label for="title" class="col-form-label">Titre:</label>
                          <input type="text" class="form-control" id="title" name="title">
                          <div id="error_title">

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
                        <button type="button" class="btn btn-secondary" onclick="$('#addTypeRetenueModal').modal('hide')">annuler</button>
                        <button type="button" class="btn btn-primary" onclick="addTypeRetenue(this)">Enregistrer</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Edit Bank modal content -->
    <div id="editTypeRetenueModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="auth-brand text-center mt-2 mb-4 position-relative top-0">
                        <h4>Modification d'un Type de Déduction</h4>
                    </div>

                    <form id="edit_typeRetenue_form" method="POST">
                      @csrf
                      <div class="form-group">
                          <label for="title" class="col-form-label">Titre:</label>
                          <input type="text" class="form-control" id="title_up" name="title">
                          <div id="error_area_title_up">

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
                        <button type="button" class="btn btn-secondary" onclick="$('#editTypeRetenueModal').modal('hide')">annuler</button>
                        <button type="button" class="btn btn-primary" onclick="updateTypeRetenue(this)">Modifier</button>
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
    function addTypeRetenue(th) {
        $(th).attr('disabled',true);
        $('#infos').attr('hidden',false);
        var form = $('#add_typeRetenue_form');

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            dataType: 'json',
            data: form.serialize(),
            success: function(data) {
                if(data.success) {
                    $(th).attr('disabled',false);
                    $('#infos').attr('hidden',true);
                    $('#addTypeRetenueModal').modal('hide');
                    $('.typeRetenue_table').load(' .typeRetenue_table');
                    form.trigger("reset");
                    window.location.reload();

                } else {
                    if(data.messages.title != undefined) {
                        $('#error_title').html(`
                            <div class="alert alert-danger">${ data.messages.title[0] }</div>
                        `);
                    }else {
                        $('#error_title').html("");
                    }

                    
                    $(th).attr('disabled',false);
                    $('#infos').attr('hidden',true);
                }
            }
        })
    }

    function editTypeRetenue(th) {
      var data = $(th).data('retenue');
      var up_url = $(th).data('href');
      $('#title_up').val(data.name_retenue_type);
      $('#edit_typeRetenue_form').attr('action',up_url);

      $('#editTypeRetenueModal').modal('show');

    }

    function updateTypeRetenue(th) {
        $(th).attr('disabled',true);
        $('#info').attr('hidden',false);
        var form = $('#edit_typeRetenue_form');

        $.ajax({
            url: form.attr('action'),
            type: 'PUT',
            dataType: 'json',
            data: form.serialize(),
            success: function(data) {
                if(data.success) {
                    $(th).attr('disabled',false);
                    $('#info').attr('hidden',true);
                    $('#editTypeRetenueModal').modal('hide');
                    $('.typeRetenue_table').load(' .typeRetenue_table');
                    form.trigger("reset");
                    window.location.reload();
                } else {
                    
                    if(data.messages.title != undefined) {
                        $('#error_area_title_up').html(`
                            <div class="alert alert-danger">${ data.messages.title[0] }</div>
                        `);
                    }else {
                        toastr["error"](data.messages,"Info");
                    }

                    
                    $(th).attr('disabled',false);
                    $('#info').attr('hidden',true);
                }
            }
        });
    }
</script>
@endsection