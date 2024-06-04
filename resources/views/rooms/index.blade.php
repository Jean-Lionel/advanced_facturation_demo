@extends('layouts.app')

@section('content')
    <form action="" method="post">
        @include('rooms._header_room')
    </form>

    <div class="text text-center h5">Listes des Chambres: ({{ sizeof($rooms) }})</div>
    <hr class="bg bg-info" />
    <div class="container-fluid text-light">
        <div class="p-3 d-flex justify-content-around flex-wrap">
            @foreach ($rooms as $item)
                <div class="col-md-3 chamber m-3">
                    <div class="text text-light chamberSize">
                        <i class="fa fa-bed"></i>
                    </div>
                    <div>
                        <i>Statut: ({{ $item->room_state == 0 ? 'Libre - Propre' : 'Impropre' }}) </i>
                        @if ($item->room_state == 0)
                            <i class="alert alert-danger p-1">Aucune Reservation</i>
                        @else
                            <i class="alert alert-primary p-1">Reservee</i>
                        @endif
                        <i class="h5 text-light">{{ $item->room_name }}</i>
                        <i class="des_price">Prix: {{ $item->room_price }} FBU</i>
                    </div>
                    <div>
                        <a title="Checkin" class="btn btn-sm btn-success text-light"><i class="fa fa-paper-plane"></i></a>
                        <a title="Modifier Chambre" data-toggle="modal" data-target="#updateModalRoom"
                            class="btn btn-sm btn-warning text-light"><i class="fa fa-pen"></i></a>
                        <a title="Nettoyer Chambre" class="btn btn-sm btn-danger text-light"><i class="fa fa-trash"></i></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="addModalRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="roomForm" action="" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary text-center">Nouveau Chambre</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <div class="form-group">
                                <label for="">Nom Chambre:</label>
                                <input type="text" name="room_name" id="room_name" class="form-control"
                                    placeholder="Room 1">
                            </div>
                            <div class="form-group">
                                <label for="">Prix Chambre:</label>
                                <input type="number" name="room_price" id="room_price" class="form-control"
                                    placeholder="30000">
                            </div>
                            <div class="form-group">
                                <label for="">TVA:</label>
                                <select name="room_tva" id="room_tva" class="form-control" aria-placeholder="10">
                                    <option value="">Choisissez TVA</option>
                                    <option value="1">0%</option>
                                    <option value="10" selected>10%</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">TC:</label>
                                <select name="room_tc" id="room_tc" class="form-control" aria-placeholder="5">
                                    <option value="">Choisissez TC</option>
                                    <option value="0">0%</option>
                                    <option value="5" selected>5%</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Capacite:</label>
                                <input type="text" name="room_capacity" id="room_capacity" class="form-control"
                                    placeholder="2">
                            </div>
                        </form>
                    </div>
                    <div hidden id="hiddable" class="text text-center alert alert-danger">Veuiller Completer tous les
                        Champs</div>
                    <div class="modal-footer">
                        <button type="button" class="btn alert-danger" data-dismiss="modal">Fermer</button>
                        <button type="button" onclick="submitRoom()" class="btn alert-primary">Enregistrer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="updateModalRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="roomForm" action="" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary text-center">Modifier Chambre</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <div class="form-group">
                                <label for="">Nom Chambre:</label>
                                <input type="text" name="room_name" id="room_name" class="form-control"
                                    placeholder="Room 1">
                            </div>
                            <div class="form-group">
                                <label for="">Prix Chambre:</label>
                                <input type="number" name="room_price" id="room_price" class="form-control"
                                    placeholder="30000">
                            </div>
                            <div class="form-group">
                                <label for="">TVA:</label>
                                <select name="room_tva" id="room_tva" class="form-control" aria-placeholder="10">
                                    <option value="">Choisissez TVA</option>
                                    <option value="1">0%</option>
                                    <option value="10" selected>10%</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">TC:</label>
                                <select name="room_tc" id="room_tc" class="form-control" aria-placeholder="5">
                                    <option value="">Choisissez TC</option>
                                    <option value="0">0%</option>
                                    <option value="5" selected>5%</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Capacite:</label>
                                <input type="text" name="room_capacity" id="room_capacity" class="form-control"
                                    placeholder="2">
                            </div>
                        </form>
                    </div>
                    <div hidden id="hiddable" class="text text-center alert alert-danger">Veuiller Completer tous les
                        Champs</div>
                    <div class="modal-footer">
                        <button type="button" class="btn alert-danger" data-dismiss="modal">Fermer</button>
                        <button type="button" id="submitBtn" onclick="submitRoom()"
                            class="btn alert-primary">Enregistrer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('javascript')
    <script>
        $(document).ready(function() {
            // alert("ready!");
        });

        function submitRoom() {
            let roomName = $("#room_name").val();
            let roomPrice = $("#room_price").val();
            let roomTva = $("#room_tva").val();
            let roomTc = $("#room_tc").val();
            let roomCapacity = $("#room_capacity").val();
            let data_room = $("#roomForm").serializeArray();

            if (roomName.length == 0 | roomPrice.length == 0 | roomPrice.length == 0 | roomCapacity.length == 0 | roomTc
                .length == 0 | roomTva.length == 0) {
                setTimeout(() => {
                    $("#hiddable").prop('hidden', false)
                }, 1000);
            } else {
                $("#submitBtn").prop('disable', true)
                $.ajax({
                    url: '/rooms',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "data": data_room
                    },
                    success: function(data) {
                        if (data.success) {
                            $("#addModalRoom").modal("hide")
                            window.location.reload();
                        }
                    }
                })
            }
        }
    </script>
@endsection
