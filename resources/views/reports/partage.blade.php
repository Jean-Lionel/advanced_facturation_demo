@extends('layouts.app')

{{-- Stocke Controller Journal --}}

@section('content')

@if(env('APP_USE_ABONEMENT', false))
@include('journals._header_file')
@endif



<div class="row">
    <div>
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>NUMERO DE FACTURE</th>
                    <th>COMMISSIONNAIRE</th>
                    <th>CLIENT</th>
                    <th>INTERET TOTAL</th>
                    <th>PARTAGE DES INTERET </th>
                    <th>DATE</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($interets as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->order_id }}</td>
                    <td>{{ $item->commisionnaire()?->name }}</td>
                    <td>{{ $item->client()?->name }}</td>
                    <td class="text-right">{{ $item->montant }}</td>
                    <td style="width: 200px;">
                        <ul>
                            @foreach ($item->interet as $key => $element )
                           <li class="d-flex justify-content-between">
                             <span>{{ $key }}</span> &nbsp; &nbsp;   <b>{{ $element }}</b> </li>
                        @endforeach
                        </ul>

                    </td>
                    <td>{{ $item->created_at}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop
