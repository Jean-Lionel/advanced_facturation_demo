@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mt-2">
        <div class="shadow-lg row">
            <div class="mt-4 ml-3">
                <img src="{{ asset('img/deposit.png') }}" style="width:40px;height:40px;" alt="">
            </div>
            <div class="col-10">
                <h6 class="ml-4 mt-4 " style="font-weight: bold">
                    Depot
                </h6>
                <p style="font-size:16px;" class="ml-4 text-gray-600">Le lorem ipsum est, en imprimerie, une
                    suite de mots
                    sans
                    signification utilisée.</p>
            </div>
            <div class="col-1 mt-3">
                <p class="btn btn-info fw-bold">
                    CASH
                </p>
            </div>
        </div>
    </div>
    <div class="mt-2">
        <div class="shadow-lg row">
            <div class="mt-4 ml-3">
                <img src="{{ asset('img/lending.png') }}" style="width:40px;height:40px;" alt="">
            </div>
            <div class="col-10">
                <h6 class="ml-4 mt-4 " style="font-weight: bold">
                    Achat
                </h6>
                <p style="font-size:16px;" class="ml-4 text-gray-600">Le lorem ipsum est, en imprimerie, une
                    suite de mots
                    sans
                    signification utilisée.</p>
            </div>
            <div class="col-1 mt-3">
                <p class="btn btn-info fw-bold">
                    CASH
                </p>
            </div>
        </div>
    </div>

</div>
</div>

@endsection