@extends('layouts.app')

@section('content')

<div>
	<div class="d-flex justify-content-end d-gap-3">
		<div>
			
        <a href="{{ route('products.create') }}"><span class="fa fa-seedling"></span> Entre</a>
      
		</div>
		<div><a href="{{ route('categories.index') }}"><span class="fa fa-paper-plane"></span> Category</a></div>
	</div>
	<div class="row">
		<div class="col-md-6 d-flex justify-content-between">
			<a href="{{ route('bon_entre') }}" 
			class="btn btn-primary btn-sm">Les entres et les sorties</a>
			<h4 class="text-center">
				Liste des produits
			</h4>
		</div>
		<div class="col-md-6">
			<form action="">
				<input type="text" name="search" class="form-control form-control-sm" value="{{ $search }}" placeholder="Rechercher ici ">
			</form>
		</div>
	</div>
	
	<table class="table table-sm">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">CODE</th>
				<th scope="col"> @sortablelink('name','Designation') </th>
				<th scope="col">@sortablelink('price','P U')  </th>
				<th scope="col">@sortablelink('quantite','Qté')</th>
				<th scope="col">@sortablelink('unite_mesure','Unite')</th>
				<th scope="col">@sortablelink('quantite_alert','Alert')</th>
				
				<th scope="col">Category</th>
				<th scope="col">Date d'expiration</th>
				
				<th scope="col">Date d'entre</th>
				<th scope="col">Action</th>
			</tr>
		</thead>
		<tbody>

			@foreach ($products as $value)
			{{-- expr --}}
			<tr>
				<td>{{ $value->id }}</td>
				<td>{{ $value->code_product }}</td>
				<td>
					{{ $value->name}}
				</td>

				<td>{{ $value->price }}</td>
				<td class="{{ $value->quantite >= $value->quantite_alert ? 'bg-success' : 'bg-danger'  }}">

					{{ $value->quantite }}

				</td>

				<td>
					{{$value->unite_mesure}}
				</td>

				<td>
					@if ($value->quantite <= $value->quantite_alert)
					{{-- expr --}}
					<i class="fa fa-exclamation-triangle text-danger" aria-hidden="true"></i> 
				    @endif
			   </td>

				<td><b>{{ $value->category->title }}</b></td>
				<td>{{ $value->date_expiration }}</td>
				<td>{{ $value->created_at }}</td>
				<td class="d-flex justify-content-around">
					<a href="{{ route('products.edit', $value) }}" class="btn btn-outline-info btn-sm mr-2">Modifier</a>
					<a href="{{ route('add_view',$value) }}" class="btn btn-info btn-sm mr-2">Ajouter</a>


					<a href="{{ route('products.show', $value) }}" class="btn btn-outline-warning btn-sm mr-2">Afficher</a>
					<form class="form-delete" action="{{ route('products.destroy' , $value) }}" style="display: inline;" method="POST">
						{{ csrf_field() }}
						{{ method_field('DELETE') }}
						<button class="btn btn-outline-danger btn-sm delete_client" onclick="return confirm('Voulez-vous supprimer ?')">Supprimer</button>
					</form>


				</td>
			</tr>
			@endforeach


		</tbody>
	</table>



</div>

<div class="col-md-12" style="height: 100px; overflow: hidden;">
	{{ $products->links()}}
</div>


@endsection