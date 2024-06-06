    <div class="d-flex justify-content-between noprint">
        <div class="d-flex col-7 justify-content-between">
            <div class="p-2 alert alert-primary">
                <a href="{{ route('invoices.index') }}" style="cursor: pointer"
                    class="{{ setActiveRoute('invoices.*') }}">&nbsp;<span class="fa fa-receipt"></span> &nbsp;Factures
                    Clients
                    Chambres</a>
            </div>
            <div class="p-2 alert alert-primary">
                <a href="{{ route('checkin-list.index') }}" style="cursor: pointer"
                    class="{{ setActiveRoute('checkin-list.*') }}">&nbsp;<span class="fa fa-hotel"></span> &nbsp;Listes
                    Checkin</a>
            </div>
            <div class="p-2 alert alert-primary">
                @if (request()->is('rooms'))
                    <a style="cursor: pointer" data-toggle="modal" data-target="#addModalRoom"
                        class="{{ setActiveRoute('rooms.*') }}"><span class="fa fa-bed"></span> &nbsp;Nouveau
                        Chambre</a>
                @else
                    <a href="{{ route('rooms.index') }}" style="cursor: pointer"
                        class="{{ setActiveRoute('rooms.*') }}"><span class="fa fa-bed"></span> &nbsp;Listes des
                        Chambre</a>
                @endif
            </div>
            <div class="p-2 alert alert-primary">
                <a href="{{ route('checkin.index') }}" style="cursor: pointer"
                    class="{{ setActiveRoute('checkin.*') }}"><span class="fa fa-check"></span>
                    &nbsp;CheckIn</a>
            </div>
        </div>
    </div>
    <hr>


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
