@extends('layouts.app')

{{-- Stocke Controller Journal --}}

@section('content')

<div class="row">

	<div class="col-md-12">
		@include('journals.header')


	</div>

    <div class="col-md-12">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Description</th>
                    <th scope="col">Client</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Date d'entrée</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($proformats as $proformat)
                <tr>
                    <td>{{ $proformat->id }}</td>
                    <td>
                        <ul>
                            @foreach($proformat->products as $product)
                                <li>
                                    {{ $product['name'] }} X  {{ $product['quantite'] }}
                                    <b>{{ number_format($product['price'], 2) }}</b>
                                </li>

                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $proformat->client->name }}</td>
                    <td><b>{{ number_format($proformat->amount, 2) }}</b></td>
                    <td>{{ $proformat->created_at }}</td>
                    <td>
                        <a href="{{ route('proformats.show', $proformat) }}" class="mr-2 btn btn-sm btn-success" title="imprimer"> <i class="fa fa-print" ></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop