@extends('layouts.app')

@section('content')
<div class="container">
    @foreach($historiques as $historique)
    <div class="mt-2">
        <div class="shadow-lg row">
            <div class="mt-4 ml-3">
                <img src="{{ asset('img/deposit.png') }}" style="width:40px;height:40px;" alt="">
            </div>
            <div class="col-10">
                <h6 class="ml-4 mt-4 " style="font-weight: bold">
                    {{$historique->title}}
                </h6>
                <p style="font-size:16px;" class="ml-4 text-gray-600">{{$historique->description}} </p>
            </div>
            <div class="col-1 mt-3">
                <p class="btn btn-info fw-bold">
                    {{$historique->mode_payement}}
                </p>
            </div>
        </div>
    </div>
    @endforeach


</div>
</div>

@endsection