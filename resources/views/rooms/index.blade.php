@extends('layouts.app')

@section('content')
    @include('rooms._header_room')
    <div class="d-flex">
        <div class="text text-center h5">Listes des Chambres: ({{ sizeof($rooms) }})</div>
        <hr class="bg bg-info" />
        <form action="{{ route('rooms.index') }}" method="get">
            <div class="form-group d-flex align-items-center mt-3">
                <label for="" class="text text-primary">Search:</label>
                <input type="text" name="search" id="" value="{{ isset($search) ? $search : '' }}"
                    class="form-control" placeholder="Chercher la Chambre">
                <button type="submit" class="btn btn-sm btn-primary">Search</button>
            </div>
        </form>
    </div>

    <div class="container-fluid text-light">
        <div class="p-3 d-flex justify-content-around flex-wrap">
            @foreach ($rooms as $item)
                <div class="col-md-3 chamber m-3">
                    <div class="text text-light chamberSize">
                        <i class="fa fa-bed"></i>
                    </div>
                    <div>
                        @if ($item->room_state == 0)
                            <i class="alert alert-danger p-1">Statut: Libre - Propre</i>
                        @else
                            <i class="alert alert-primary p-1">Statut: Impropre</i>
                        @endif
                        <i class="h5 text-light">{{ $item->room_name }}</i>
                        <i class="des_price">Prix: {{ $item->room_price }} FBU</i>
                    </div>
                    <div>
                        @if ($item->room_state == 0)
                            <a href="{{ route('checkin.index', ['id' => $item->id]) }}" title="Checkin"
                                class="btn btn-sm btn-success text-light"><i class="fa fa-paper-plane"></i></a>
                        @endif
                        @if ($item->room_state == 1)
                            <a href="{{ route('checkin.index', ['id' => $item->id]) }}" title="Nettoyer"
                                class="btn btn-sm btn-info text-light"><i class="fa fa-water"></i></a>
                        @endif
                        <a title="Modifier Chambre" onclick="updateChambre('{{ $item->id }}')"
                            class="btn btn-sm btn-warning text-light"><i class="fa fa-pen"></i></a>
                        <a title="Supprimer Chambre" onclick="eraseRoom('{{ $item->id }}')"
                            class="btn btn-sm btn-danger text-light"><i class="fa fa-trash"></i></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <!-- Modal -->

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
                    <div class="modal-body" id="innerPending">

                    </div>
                    <div hidden id="hiddable_update" class="text text-center alert alert-danger">Veuiller Completer tous
                        les
                        Champs</div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                        <button type="button" id="submitBtn" onclick="updateRoom()"
                            class="btn btn-warning">Modifier</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade dark" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-sm">
                <div class="modal-header">
                    <h5 class="modal-title text0-center" id="exampleModalLabel">Supprimer Chambre</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text text-center h3 text text-danger"><i class="fa fa-sad-tear"></i></p>
                    <p class="text text-center">Voulez-vous vraiment Supprimer Cette Chambre?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-danger" id='confirmDelete'>Oui,Supprimer</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script>
        $(document).ready(function() {
            // alert("ready!");
        });

        function eraseRoom(id) {
            $("#deleteModal").modal("show", true);
            $("#confirmDelete").on("click", () => {
                $.ajax({
                    url: '/rooms/' + id,
                    type: 'DELETE',
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        if (data.deleted == true) {
                            $("#deleteModal").modal("hide", true);
                            window.location.reload();
                        }
                    }
                })
            })

        }

        function updateChambre(id) {
            $.ajax({
                url: '/getOneChamber',
                type: 'POST',
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': id
                },
                success: function(data) {
                    $("#updateModalRoom").modal("show", true);
                    let room = data.room;
                    let inner_pending = '';
                    inner_pending += `
                    <input type='hidden' name='id' id='room_id_update' value='${room.id}'>
                    <div class="form-group">
                                <label for="">Nom Chambre:</label>
                                <input type="text" name="room_name" id="room_name_update" class="form-control"
                                    placeholder="Room 1" value='${room.room_name}'>
                            </div>
                            <div class="form-group">
                                <label for="">Prix Chambre:</label>
                                <input type="number" name="room_price" id="room_price_update" class="form-control"
                                    placeholder="30000" value='${room.room_price}'>
                            </div>
                            <div class="form-group">
                                <label for="">TVA:</label>
                                <select name="room_tva" id="room_tva_update" class="form-control" aria-placeholder="10">
                                    <option value="">Choisissez TVA</option>
                                    <option ${room.room_price==0 ? 'selected': ''} value="1">0%</option>
                                    <option ${room.room_price==10 ? 'selected': ''} value="10" selected>10%</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">TC:</label>
                                <select name="room_tc" id="room_tc_update" class="form-control" aria-placeholder="5">
                                    <option value="">Choisissez TC</option>
                                    <option ${room.room_tc==0 ? 'selected': ''}  value="0">0%</option>
                                    <option ${room.room_tc==5 ? 'selected': ''} value="5" selected>5%</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Capacite:</label>
                                <input type="text" name="room_capacity" id="room_capacity_update" class="form-control"
                                    placeholder="2" value='${room.room_capacity}'>
                            </div>`;
                    $("#innerPending").html(inner_pending);

                }
            })
        }

        function updateRoom() {
            let roomid = $("#room_id_update").val();
            let roomName = $("#room_name_update").val();
            let roomPrice = $("#room_price_update").val();
            let roomTva = $("#room_tva_update").val();
            let roomTc = $("#room_tc_update").val();
            let roomCapacity = $("#room_capacity_update").val();

            if (roomName.length == 0 | roomPrice.length == 0 | roomPrice.length == 0 | roomCapacity.length == 0 | roomTc
                .length == 0 | roomTva.length == 0) {
                setInterval(() => {
                    $("#hiddable_update").prop('hidden', false)
                }, 1000);

            } else {
                $.ajax({
                    url: '/rooms/' + roomid,
                    type: 'PUT',
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "room": {
                            roomid,
                            roomName,
                            roomPrice,
                            roomTva,
                            roomTc,
                            roomCapacity
                        }
                    },
                    success: function(data) {
                        if (data.update == true) {
                            $("#updateModalRoom").modal("hide", true);
                            window.location.reload();
                        }
                    }
                })

            }
        }

        function submitRoom() {
            let roomName = $("#room_name").val();
            let roomPrice = $("#room_price").val();
            let roomTva = $("#room_tva").val();
            let roomTc = $("#room_tc").val();
            let roomCapacity = $("#room_capacity").val();
            let data_room = $("#roomForm").serializeArray();

            if (roomName.length == 0 | roomPrice.length == 0 | roomPrice.length == 0 | roomCapacity.length == 0 | roomTc
                .length == 0 | roomTva.length == 0) {
                setInterval(() => {
                    $("#hiddable").prop('hidden', false)
                }, 1000);
            } else {
                $("#submitBtn").prop('disabled', true)
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
