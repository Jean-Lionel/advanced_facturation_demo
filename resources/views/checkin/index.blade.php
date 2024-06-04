@extends('layouts.app')

@section('content')
    <form action="" method="post">
        @include('rooms._header_room')
    </form>

    <div class="container">
        <h4 class="text text-primary">Nouveau Checkin</h4>
        <hr />

        <form action="">
            <fieldset class="card p-4 dark">
                <div class="row">
                    <div class="form-group col-6">
                        <label for="" class="h6 text text-dark">Client:</label>
                        <select name="" id="" class="form-control">
                            <option value="">Selectionner Client</option>
                            @foreach ($clients as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="" class="h6 text text-dark">Chambre</label>
                        <select name="" id="" class="form-control">
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
                        <input type="text" name="" id=""
                            {{ ($id != 0) | ($id == $item->id) ? 'disabled' : '' }} class="form-control">
                    </div>
                    <div class="form-group col-6">
                        <label for="" class="h6 text text-dark">Numero Telephone:</label>
                        <input type="text" name="" id=""
                            {{ ($id != 0) | ($id == $item->id) ? 'disabled' : '' }} class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="" class="h6 text text-dark">
                            <i class="fa fa-calendar text text-primary"></i>
                            Date Entree:
                        </label>
                        <div class="input-group-addon">
                            <input type="date" name="" id="" class="form-control">
                        </div>
                    </div>

                    <div class="form-group col-6">
                        <label for="" class="h6 text text-dark">
                            <i class="fa fa-calendar text text-danger"></i>
                            Date Sortie:
                        </label>
                        <div class="input-group-addon">
                            <input type="date" name="" id="" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <label for="" class="h6 text text-dark">Nombres de Personnes:
                            <i class="fa fa-users"></i>
                        </label>
                        <div class="input-group-addon">
                            <input type="number" name="" id="" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row container">
                    <button type="submit" class="btn btn-sm btn-success"><i class="fa calendar"></i>&nbsp;Checkin</button>
                    <button type='reset' class="btn btn-secondary"><i class="fa fa-close"></i> &nbsp;Reset</button>
                </div>
            </fieldset>
        </form>
    </div>
@endsection
