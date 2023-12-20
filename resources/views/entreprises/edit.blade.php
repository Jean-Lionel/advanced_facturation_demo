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
                    <label for="">TP_TIN</label>
                    <input type="text" name="tp_tin" id="tp_tin" class="form-control"
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
                    <input type="text" name="ct_taxpayer" id="ct_taxpayer" class="form-control"
                        value="{{ $entreprise->ct_taxpayer }}">
                </div>
                <div class="col-4">
                    <label for="">TP_FISCAL_CENTER</label>
                    <input type="text" name="tp_fiscal_center" id="tp_fiscal_center" class="form-control"
                        value="{{ $entreprise->tp_fiscal_center }}">
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
                    <input type="text" name="tp_type" id="tp_type" class="form-control"
                        value="{{ $entreprise->tp_type }}">
                </div>
                <div class="col-4">
                    <label for="">TP_TRADE_NUMBER</label>
                    <input type="text" name="tp_trade_number" id="tp_trade_number" class="form-control"
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
                    <input type="text" name="vat_taxpayer" id="vat_taxpayer" class="form-control"
                        value="{{ $entreprise->vat_taxpayer }}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-4">
                    <label for="" class="text-">TL_TAXPAYER</label>
                    <input type="text" name="tl_taxpayer" id="tl_taxpayer" class="form-control"
                        value="{{ $entreprise->tl_taxpayer }}">
                </div>
                <div class="col-4">
                    <label for="">TP_ACTIVITY_SECTOR</label>
                    <input type="text" name="tp_activity_sector" id="tp_activity_sector" class="form-control"
                        value="{{ $entreprise->tp_activity_sector }}">
                </div>
                <div class="col-4">
                    <label for="">PAYMENT_TYPE</label>
                    <input type="text" name="payment_type" id="payment_type" class="form-control"
                        value="{{ $entreprise->payment_type }}">
                </div>
            </div>
            <div class="row p-3">
                <button type="submit" class="btn-info btn"> Modifier</button>
            </div>
        </form>
    </div>
@stop
