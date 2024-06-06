@extends('layouts.app')

@section('content')
    <form action="" method="post">
        @include('rooms._header_room')
    </form>

    <div class="container">
        <h4 class="text text-primary">Nouveau Checkin</h4>
        <hr />

        <form action="" id="checkinForm">
            <fieldset class="card p-4 dark">
                <div class="row">
                    <div class="form-group col-6">
                        <label for="" class="h6 text text-dark">Client:</label>
                        <select name="client" id="checkInClient" onchange="handleClientInfo()" class="form-control">
                            <option value="">Selectionner Client</option>
                            @foreach ($clients as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="" class="h6 text text-dark">Chambre</label>
                        <select name="room" id="checkinRoom" class="form-control">
                            <option value="">Selectionner Chambre</option>
                            @foreach ($rooms as $item)
                                @if (($id != 0) | ($id == $item->id))
                                    <option {{ ($id != 0 and $id == $item->id) ? 'selected' : 'disabled' }}
                                        value="{{ $item->id }}">
                                        {{ $item->room_name }} <span class="text text-success">({{ $item->room_capacity }}
                                            Personnes)</span></option>
                                @else
                                    <option {{ ($id != 0 and $id == $item->id) ? 'selected' : '' }}
                                        value="{{ $item->id }}">
                                        {{ $item->room_name }} <span class="text text-success">({{ $item->room_capacity }}
                                            Personnes)</span></option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="" class="h6 text text-dark">Adresse:</label>
                        <input type="text" name="adresse" id="checkin_adresse" disabled class="form-control">
                    </div>
                    <div class="form-group col-6">
                        <label for="" class="h6 text text-dark">Numero Telephone:</label>
                        <input type="text" name="phone" id="checkin_phone" disabled class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="" class="h6 text text-dark">
                            <i class="fa fa-calendar text text-primary"></i>
                            Date Entree:
                        </label>
                        <div class="input-group-addon">
                            <input type="date" name="dateEntry" id="checkinEntry" class="form-control">
                        </div>
                    </div>

                    <div class="form-group col-6">
                        <label for="" class="h6 text text-dark">
                            <i class="fa fa-calendar text text-danger"></i>
                            Date Sortie:
                        </label>
                        <div class="input-group-addon">
                            <input type="date" name="dateOut" id="checkinOut" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <label for="" class="h6 text text-dark">
                            <i class="fa fa-users text text-warning"></i>
                            Nombres de Personnes:
                        </label>
                        <div class="input-group-addon">
                            <input type="number" name="numberPerson" id="checkinPerson" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="bg bg-danger text text-white text-center p-2  m-1" id="errorRequired" hidden>
                    Veuiller Completer tous les Champs
                </div>
                <div class="bg bg-danger text text-white text-center p-2 m-1" id="dateError" hidden>
                    La date d'entree doit etre Inferieur a la date de Sortie
                </div>
                <div class="row container mt-2">
                    <button type="submit" id="sbmtBtn" class="btn btn-sm btn-success"><i
                            class="fa calendar"></i>&nbsp;Checkin</button>
                    <button type='reset' class="btn btn-secondary"><i class="fa fa-close"></i> &nbsp;Reset</button>
                </div>
            </fieldset>
        </form>
    </div>
@endsection
@section('javascript')
    <script>
        $("#checkinForm").on("submit", (e) => {
            e.preventDefault();
            let forms = $("#checkinForm").serializeArray();
            let client = $("#checkInClient").val();
            let room = $("#checkinRoom").val();
            let adress = $("#checkin_adresse").val();
            let phone = $("#checkin_phone").val();
            let entry = new Date($("#checkinEntry").val());
            let out = new Date($("#checkinOut").val());
            let person = $("#checkinPerson").val();
            if (client.length == 0 | room.length == 0 | adress.length == 0 | phone.length == 0 | entry.length == 0 |
                out.length == 0 | person.length == 0) {
                $("#errorRequired").prop("hidden", false);
                return;
            } else if (entry >= out | out <= entry) {
                $("#dateError").prop("hidden", false);
                return;
            } else {
                $("#sbmtBtn").prop("disabled", true);
                $("#errorRequired").prop("hidden", true);
                $("#dateError").prop("hidden", true);
                $.ajax({
                    url: '/checkin',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "checkin": forms
                    },
                    success: function(data) {
                        if (data.success) {
                            window.location.href = "/rooms"
                        }
                    }
                })
            }
        })

        function handleClientInfo() {
            client = $("#checkInClient").val();
            $.ajax({
                url: '/getOneClient',
                type: 'POST',
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": client
                },
                success: function(data) {
                    if (data.client) {
                        let row = data.client;
                        $("#checkin_adresse").val(row.addresse)
                        $("#checkin_phone").val(row.telephone)
                    }
                }
            })
        }
    </script>
@endsection
