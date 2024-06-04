@extends('layouts.app')

@section('content')
    <div>
        @include('hrm._hrm_header')

        <div class="row">
            <div class="col-lg-12 col-md-12 d-flex justify-content-between">
                <h4 class="text-center">
                    Liste des Banques
                </h4>

                <div style="width: 20%">
                    <a href="javascript:void(0)" onclick="$('#addBankModal').modal('show')"
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
                @foreach($banks as $value)
                    <tr>
                        <td>{{ $value->bank_name }}</td>
                        <td>{{ $value->user->name ?? "-" }}</td>
                        <td>{{ $value->created_date }}</td>
                        <td>
                            <a data-href="{{ route('bank.update',['bank' => $value->bank_id]) }}" data-bank="{{ json_encode($value) }}" onclick="editBank(this)" class="mr-2 btn btn-outline-info btn-sm">Modifier</a>
                            
                            <form class="form-delete" action="{{ route('bank.destroy',['bank' => $value->bank_id]) }}" style="display: inline;" method="POST">
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
    <div id="addBankModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="auth-brand text-center mt-2 mb-4 position-relative top-0">
                        <h4>Ajout d'une Banque</h4>
                    </div>

                    <form action="{{ route('bank.store') }}" id="add_bank_form" class="ps-3 pe-3">
                        @csrf
                        <div class="mb-3">
                            <label for="bank_name" class="form-label">Désignation</label>
                            <input class="form-control" type="text" name="bank_name" id="bank_name" required="" >
                            <div id="error_area">

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
                        <button type="button" class="btn btn-secondary" onclick="$('#addBankModal').modal('hide')">Annuler</button>
                        <button class="btn btn-primary" onclick="addBank(this)" type="submit">Enregister</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Edit Bank modal content -->
    <div id="editBankModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="auth-brand text-center mt-2 mb-4 position-relative top-0">
                        <h4>Modification d'une Banque</h4>
                    </div>

                    <form id="edit_bank_form" class="ps-3 pe-3">
                        @csrf
                        <div class="mb-3">
                            <label for="bank_name" class="form-label">Désignation</label>
                            <input class="form-control" type="text" name="bank_name" id="bank_name_up" required="" >
                            <div id="error_area_up">

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
                        <button type="button" class="btn btn-secondary" onclick="$('#editBankModal').modal('hide')">Annuler</button>
                        <button class="btn btn-primary" onclick="updateBank(this)" type="submit">Modifier</button>
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
    function addBank(th) {
        $(th).attr('disabled',true);
        $('#infos').attr('hidden',false);
        var form = $('#add_bank_form');

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            dataType: 'json',
            data: form.serialize(),
            success: function(data) {
                if(data.success) {
                    $(th).attr('disabled',false);
                    $('#infos').attr('hidden',true);
                    $('#addBankModal').modal('hide');
                    $('.bank_table').load(' .bank_table');
                    form.trigger("reset");
                    window.location.reload();

                } else {
                    $('#error_area').html(`
                        <div class="alert alert-danger">${ data.messages }</div>
                    `);
                    $(th).attr('disabled',false);
                    $('#infos').attr('hidden',true);
                }
            }
        })
    }

    function editBank(th) {
      var data = $(th).data('bank');
      var up_url = $(th).data('href');
      $('#bank_name_up').val(data.bank_name);
      $('#edit_bank_form').attr('action',up_url);

      $('#editBankModal').modal('show');

    }

    function updateBank(th) {
        $(th).attr('disabled',true);
        $('#info').attr('hidden',false);
        var form = $('#edit_bank_form');

        $.ajax({
            url: form.attr('action'),
            type: 'PUT',
            dataType: 'json',
            data: form.serialize(),
            success: function(data) {
                if(data.success) {
                    $(th).attr('disabled',false);
                    $('#info').attr('hidden',true);
                    $('#editBankModal').modal('hide');
                    $('.bank_table').load(' .bank_table');
                    form.trigger("reset");
                    window.location.reload();

                } else {
                    $('#error_area_up').html(`
                        <div class="alert alert-danger">${ data.messages }</div>
                    `);
                    $(th).attr('disabled',false);
                    $('#info').attr('hidden',true);
                }
            }
        });
    }
</script>
@endsection