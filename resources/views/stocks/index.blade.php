@extends('layouts.app')

@section('content')

<div>
    @include('products._header_product')


	<div class="row">


		<div class="col-md-6 d-flex justify-content-between">
			<a href="{{ route('stockes.create') }}"
			class="btn btn-primary btn-sm">Nouveau stock</a>
			<h4 class="text-center">
				Liste des stockes
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
				<th scope="col">Designation</th>
				<th scope="col">Description</th>

				<th scope="col">Date de creation</th>
				<th scope="col">Action</th>
			</tr>
		</thead>
		<tbody>

			@foreach ($stocks as $value)
			{{-- expr --}}
			<tr>
				<td>{{ $value->id }}</td>
				<td>
					{{ $value->name}}
				</td>

				<td>{{ $value->description }}</td>
				<td>{{ $value->created_at }}</td>
				<td class="d-flex justify-content-around">

					<a href="{{ route('stockes.edit', $value) }}" class="mr-2 btn btn-outline-info btn-sm">
                        <span class="fa fa-edit"></span>
                        Modifier</a>

					<a href="{{ route('product_stock.show', $value) }}" class="mr-2 btn btn-outline-info btn-sm">
                        <span class="fa fa-sitemap"></span>
                        products</a>

                    <a href="{{ route('stockes.show', $value) }}" class="mr-2 btn btn-outline-warning btn-sm">
                        <i class="fas fa-shopping-cart"></i>
                        Commandes
                    </a>

					{{--  <form class="form-delete" action="{{ route('stockes.destroy' , $value) }}" style="display: inline;" method="POST">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<button class="btn btn-outline-danger btn-sm delete_client"

                    onclick="return confirm('Voulez-vous supprimer ?')"

                    >Supprimer</button>  --}}
				</form>


				</td>
			</tr>
			@endforeach


		</tbody>
	</table>


</div>

<div class="col-md-12" style="height: 20px; overflow: hidden;">
		{{ $stocks->links()}}
</div>


@endsection
