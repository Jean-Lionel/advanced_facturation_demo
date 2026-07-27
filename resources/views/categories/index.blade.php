@extends('layouts.app')

@section('content')
<div class="app-page">
    @include('products._header_product')

    <div class="app-card">
        <header class="app-card-header">
            <h2 class="app-card-heading">Liste des categories</h2>
            <div class="app-toolbar-actions">
                <form action="" method="GET" class="app-search">
                    <i class="fas fa-search" aria-hidden="true"></i>
                    <input type="search" name="search" placeholder="Rechercher ici">
                </form>
                <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm">Ajouter</a>
            </div>
        </header>

        <div class="app-card-body--flush">
            <div class="app-table-wrap">
                <table class="table table-sm app-table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Date de creation</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->title}}</td>
                            <td>{{ $value->description }}</td>
                            <td>{{ $value->created_at }}</td>
                            <td class="d-flex justify-content-around">
                                <a href="{{ route('categories.edit', $value) }}" class="btn btn-outline-info btn-sm mr-2">Modifier</a>
                                <form class="form-delete" action="{{ route('categories.destroy' , $value) }}" style="display: inline;" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-outline-danger btn-sm delete_client">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="app-pagination">
            {{ $categories->links()}}
        </div>
    </div>
</div>
@endsection
