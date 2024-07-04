@extends('layouts.app')

@section('content')
    <div>
        @include('hrm._hrm_header')

        <div class="row">
            <div class="col-lg-12 col-md-12 d-flex justify-content-between">
                <h4 class="text-center">
                    Liste de Types d'Indeminités
                </h4>

                <div style="width: 20%">
                    <a href="javascript:void(0)" onclick="$('#addIndeminityModal').modal('show')"
                     class="btn btn-outline-primary btn-sm">Ajouter</a>
                </div>
            </div>
        </div>

        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Pourcentage</th>
                    <th>Imposable</th>
                    <th>Auteur</th>
                    <th>Date Création</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($indeminities as $value)
                    <tr>
                        <td>{{ $value->title }}</td>
                        <td>{{ $value->percentage }}</td>
                        <td>
                            @if($value->taxable == 0)
                                <span class="badge bg-success">OUI</span>
                            @else
                                <span class="badge bg-warning">NON</span>
                            @endif
                        </td>
                        <td>{{ $value->user->name ?? '-' }}</td>
                        <td>{{ $value->created_at }}</td>
                        <td>
                            <a data-href="{{ route('indeminity.update',['indeminity' => $value->type_indeminite_id]) }}" data-indeminity="{{ json_encode($value) }}" onclick="editIndeminity(this)" class="mr-2 btn btn-outline-info btn-sm">Modifier</a>

                            <form class="form-delete" action="{{ route('indeminity.destroy',['indeminity' => $value->type_indeminite_id]) }}" style="display: inline;" method="POST">
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
    <div id="addIndeminityModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="auth-brand text-center mt-2 mb-4 position-relative top-0">
                        <h4>Ajouter un Type d'indeminité</h4>
                    </div>

                    <form id="add_indeminity_form" method="POST" action="{{ route('indeminity.store') }}">
                      @csrf
                      <div class="form-group">
                          <label for="title" class="col-form-label">Titre:</label>
                          <input type="text" class="form-control" id="title" name="title">
                          <div id="error_area_title">

                          </div>
                      </div>
                      <div class="form-group">
                          <label for="percentage" class="col-form-label">Pourcentage:</label>
                          <input type="text" class="form-control" id="percentage" name="percentage">
                          <div id="error_area_percentage">

                          </div>
                      </div>

                      <div class="form-group">
                          <label for="taxable" class="col-form-label">Imposable:</label>
                          <div class="form-check form-check-inline">
                                <input type="radio" id="yes_taxable" name="taxable"
                                    class="form-check-input" value="0">
                                <label class="form-check-label" for="yes_taxable">OUI</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" id="not_taxable" name="taxable"
                                    class="form-check-input" value="1">
                                <label class="form-check-label" for="not_taxable">NON</label>
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
                        <button type="button" class="btn btn-secondary" onclick="$('#addIndeminityModal').modal('hide')">annuler</button>
                        <button type="button" class="btn btn-primary" onclick="addIndeminity(this)">Enregistrer</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Edit Bank modal content -->
    <div id="editIndeminityModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="auth-brand text-center mt-2 mb-4 position-relative top-0">
                        <h4>Modification d'un Type d'indeminite</h4>
                    </div>

                    <form id="edit_indeminity_form" method="POST">
                      @csrf
                      <div class="form-group">
                          <label for="title" class="col-form-label">Titre:</label>
                          <input type="text" class="form-control" id="title_up" name="title">
                          <div id="error_area_title_up">

                          </div>
                      </div>
                      <div class="form-group">
                          <label for="percentage" class="col-form-label">Pourcentage:</label>
                          <input type="text" class="form-control" id="percentage_up" name="percentage">
                          <div id="error_area_percentage_up">

                          </div>
                      </div>

                      <div class="form-group">
                          <label for="taxable" class="col-form-label">Imposable:</label>
                          <div class="form-check form-check-inline">
                                <input type="radio" id="yes_taxable_up" name="taxable"
                                    class="form-check-input" value="0">
                                <label class="form-check-label" for="yes_taxable_up">OUI</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" id="not_taxable_up" name="taxable"
                                    class="form-check-input" value="1">
                                <label class="form-check-label" for="not_taxable_up">NON</label>
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
                        <button type="button" class="btn btn-secondary" onclick="$('#editIndeminityModal').modal('hide')">annuler</button>
                        <button type="button" class="btn btn-primary" onclick="updateIndeminity(this)">Modifier</button>
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
    function addIndeminity(th) {
        $(th).attr('disabled',true);
        $('#infos').attr('hidden',false);
        var form = $('#add_indeminity_form');

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            dataType: 'json',
            data: form.serialize(),
            success: function(data) {
                if(data.success) {
                    $(th).attr('disabled',false);
                    $('#infos').attr('hidden',true);
                    $('#addIndeminityModal').modal('hide');
                    $('.indeminity_table').load(' .indeminity_table');
                    form.trigger("reset");
                    window.location.reload();

                } else {
                    var errors = Object.entries(data.messages);
                    errors.forEach(element => {
                        $('#error_area_'+element[0]).html(`
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

    function editIndeminity(th) {
      var data = $(th).data('indeminity');
      var up_url = $(th).data('href');
      $('#title_up').val(data.title);
      $('#percentage_up').val(data.percentage);
      if (data.taxable == 0) {
          $('#yes_taxable_up').attr('checked',true);
      } else {
        $('#not_taxable_up').attr('checked',true);
      }
      $('#edit_indeminity_form').attr('action',up_url);

      $('#editIndeminityModal').modal('show');

    }

    function updateIndeminity(th) {
        $(th).attr('disabled',true);
        $('#info').attr('hidden',false);
        var form = $('#edit_indeminity_form');

        $.ajax({
            url: form.attr('action'),
            type: 'PUT',
            dataType: 'json',
            data: form.serialize(),
            success: function(data) {
                if(data.success) {
                    $(th).attr('disabled',false);
                    $('#info').attr('hidden',true);
                    $('#editIndeminityModal').modal('hide');
                    $('.indeminity_table').load(' .indeminity_table');
                    form.trigger("reset");
                    window.location.reload();

                } else {
                    var errors = Object.entries(data.messages);
                    errors.forEach(element => {
                        $('#error_area_'+element[0]+'_up').html(`
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
