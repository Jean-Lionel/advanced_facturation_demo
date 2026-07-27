@extends('layouts.app')

@section('content')
<div class="app-page">
    @include('products._header_product')

    <div class="app-card">
        <header class="app-card-header">
            <h2 class="app-card-heading">Liste des stockes</h2>
            <div class="app-toolbar-actions">
                <form action="" method="GET" class="app-search">
                    <i class="fas fa-search" aria-hidden="true"></i>
                    <input type="search" name="search" placeholder="Rechercher ici">
                </form>
                <a href="{{ route('stockes.create') }}" class="btn btn-primary btn-sm">Nouveau stock</a>
            </div>
        </header>

        <div class="app-card-body--flush">
            <div class="app-table-wrap">
                <table class="table table-sm app-table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Designation</th>
                            <th scope="col">Description</th>
                            <th scope="col">Date de creation</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stocks as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->name}}</td>
                            <td>{{ $value->description }}</td>
                            <td>{{ $value->created_at }}</td>
                            <td class="d-flex justify-content-around">
                                <a href="{{ route('stockes.edit', $value) }}" class="mr-2 btn btn-outline-info btn-sm">
                                    <span class="fa fa-edit"></span>
                                    Modifier
                                </a>
                                <a href="{{ route('product_stock.show', $value) }}" class="mr-2 btn btn-outline-info btn-sm">
                                    <span class="fa fa-sitemap"></span>
                                    products
                                </a>
                                <a href="{{ route('stockes.show', $value) }}" class="mr-2 btn btn-outline-warning btn-sm">
                                    <i class="fas fa-shopping-cart"></i>
                                    Commandes
                                </a>
                                <a href="{{ route('stocke.useradd',$value)}}" class="mr-2 btn btn-outline-warning btn-sm">
                                    <i class="fas fa-users"></i>
                                    Utilisateurs
                                </a>
                                {{--  <form class="form-delete" action="{{ route('stockes.destroy' , $value) }}" style="display: inline;" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="btn btn-outline-danger btn-sm delete_client"
                                onclick="return confirm('Voulez-vous supprimer ?')"
                                >Supprimer</button>  --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="app-pagination">
            {{ $stocks->links()}}
        </div>
    </div>
</div>
@endsection
