@extends('layouts.app')

@section('content')
    <div>
        <form action="{{ route('entreprises.update', $entreprise) }}" method="POST" class="card p-3">
            @csrf
            @method('PUT')
            <h5 class="row p-2 text-center">Modification Entreprise</h5>
            <div class="form-group row">
                <div class="col-4">
                    <label for="">TP_NAME</label>
                    <input type="text" name="tp_name" id="tp_name" class="form-control"
                        value="{{ $entreprise->tp_name }}">
                </div>
                <div class="col-4">
                    <label for="">TP_TIN {{ $entreprise->tp_TIN  }}</label>
                    <input type="text" hidden name="tp_tin" id="tp_tin" class="form-control"
                        value="{{ $entreprise->tp_TIN }}">
                </div>
                <div class="col-4">
                    <label for="">TP_POSTAL_NUMBER</label>
                    <input type="text" name="tp_postal_number" id="tp_postal_number" class="form-control"
                        value="{{ $entreprise->tp_postal_number }}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-4">
                    <label for="">TP_ADDRESS_PRIVONCE</label>
                    <input type="text" name="tp_address_privonce" id="tp_address_privonce" class="form-control"
                        value="{{ $entreprise->tp_address_privonce }}">
                </div>
                <div class="col-4">
                    <label for="">TP_ADDRESS_AVENUE</label>
                    <input type="text" name="tp_address_avenue" id="tp_address_avenue" class="form-control"
                        value="{{ $entreprise->tp_address_avenue }}">
                </div>
                <div class="col-4">
                    <label for="">TP_ADDRESS_NUMBER</label>
                    <input type="text" name="tp_address_number" id="tp_address_number" class="form-control"
                        value="{{ $entreprise->tp_address_number }}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-4">
                    <label for="">CT_TAXPAYER</label>

                    <select name="ct_taxpayer" id="" class="form-control">

                        @foreach (["NON Assujetti à la taxe de consommation", "Assujetti à la taxe de consommation"] as $key => $value)
                            <option value="{{ $key}}"
                                    @if($key == $entreprise->ct_taxpayer)
                                        selected="selected"
                                    @endif
                            >{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4">
                    <label for="">TP_FISCAL_CENTER</label>
{{--                    <input type="text" name="tp_fiscal_center" id="tp_fiscal_center" class="form-control"--}}
{{--                        value="{{ $entreprise->tp_fiscal_center }}">--}}
                    <select name="tp_fiscal_center" id="tp_fiscal_center" class="form-control">
                        @foreach (['DGC','DMC','DPMC'] as $item)
                            <option value="{{ $item}}"   @if($entreprise->tp_fiscal_center ==  $item)
                                                             selected="selected"
                                                             @endif
                                > {{  $item }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4">
                    <label for="">TP_LEGAL_FORM</label>
                    <input type="text" name="tp_legal_form" id="tp_legal_form" class="form-control"
                        value="{{ $entreprise->tp_legal_form }}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-4">
                    <label for="">TP_TYPE</label>

                    <select name="tp_type" id="" class="form-control">
                        @foreach (['',"personne physique","personne morale" ] as $key => $value)
                            <option value="{{ $key }}"
                                    @if($key ==$entreprise->tp_type )
                                        selected="selected"
                                        @endif

                            >{{$value  }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4">
                    <label for="">TP_TRADE_NUMBER : <b>{{ $entreprise->tp_trade_number }}</b></label>
                    <input hidden type="text" name="tp_trade_number" id="tp_trade_number" class="form-control"
                        value="{{ $entreprise->tp_trade_number }}">
                </div>
                <div class="col-4">
                    <label for="">TP_PHONE_NUMBER</label>
                    <input type="text" name="tp_phone_number" id="tp_phone_number" class="form-control"
                        value="{{ $entreprise->tp_phone_number }}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-4">
                    <label for="">TP_ADDRESS_QUARTIER</label>
                    <input type="text" name="tp_address_quartier" id="tp_address_quartier" class="form-control"
                        value="{{ $entreprise->tp_address_quartier }}">
                </div>
                <div class="col-4">
                    <label for="">TP_ADDRESS_RUE</label>
                    <input type="text" name="tp_address_rue" id="tp_address_rue" class="form-control"
                        value="{{ $entreprise->tp_address_rue }}">
                </div>
                <div class="col-4">
                    <label for="">VAT_TAXPAYER</label>

                    <select name="vat_taxpayer" id="" class="form-control">
                        @foreach ([ "NON Assujetti à la TVA","Assujetti à la TVA"] as $key => $value)
                            <option value="{{$key}}"
                                    @if($key == $entreprise->vat_taxpayer )
                                        selected="selected"
                                @endif
                            >{{$value}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-4">
                    <label for="" class="text-">TL_TAXPAYER</label>

                    <select name="tl_taxpayer" id="" class="form-control">
                        @foreach ([ "NON Assujetti au prélèvement forfaitaire ","Assujetti au prélèvement forfaitaire "] as $key => $value)
                            <option value="{{$key}}"
                                    @if($key == $entreprise->tl_taxpayer )
                                        selected="selected"
                                    @endif
                            >{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4">
                    <label for="">TP_ACTIVITY_SECTOR</label>
                    <input type="text" name="tp_activity_sector" id="tp_activity_sector" class="form-control"
                        value="{{ $entreprise->tp_activity_sector }}">
                </div>
                <div class="col-4">
                    <label for="">PAYMENT_TYPE</label>

                    <select name="payment_type" class="form-control">

                        @foreach (["", "en espèce","banque","à crédit", "autres"] as $key => $val)
                            <option value="{{ $key }}"
                                    @if($key == $entreprise->payment_type)
                                        selected="selected"
                                        @endif
                            >{{$val}}</option>
                        @endforeach
                    </select>



                </div>
            </div>
            <div class="row p-3">
                <button type="submit" class="btn-info btn"> Modifier</button>
            </div>
        </form>
    </div>
@stop
