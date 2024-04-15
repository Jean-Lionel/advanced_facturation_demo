@extends('layouts.app')

@section('content')
<div>
    <div class="row">
        <div class="col-md-6 d-flex justify-content-between">

            <h4 class="text-center">
                Liste des abonnées
            </h4>
        </div>
        <div class="col-md-6">
            <form action="">
                <input type="search" class="form-control form-control-sm" placeholder="Rechercher ici ">
            </form>
        </div>
    </div>

    <table class="table table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">NUMERO</th>
                <th scope="col">NOM</th>
                <th scope="col">TELEPHONE</th>
                <th scope="col">NIF</th>
                <th scope="col">Adresse</th>
                <th>Date</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($clients as $value)
            <tr>
                <td>{{ ++$loop->index }}</td>
                <td>{{ $value->id }}</td>
                <td>
                    {{ $value->name}}
                </td>
                <td>{{ $value->telephone }}</td>
                <td>
                    {{ $value->customer_TIN}}
                </td>
                <td>
                    {{ $value->is_fournisseur}}
                </td>
                <td>
                    {{ $value->addresse}}
                </td>
                <td>{{ $value->compte->name  ?? "" }}</td>

                <td>{{ $value->created_at }}</td>
                <td class="d-flex justify-content-around">
                    {{--  					<a href="{{ route('clients.edit', $value) }}" class="btn btn-outline-info btn-sm
                    mr-2">Modifier</a>--}}
                    <form class="form-delete" action="{{ route('clients.destroy' , $value) }}" style="display: inline;"
                        method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-outline-danger btn-sm delete_client">Supprimer</button>

                        <a href="{{ route('clients_abones', $value->id) }}"
                            class="btn btn-outline-info btn-sm mr-2">Abonée</a>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection