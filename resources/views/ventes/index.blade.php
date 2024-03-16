@extends('layouts.app')
@section('content')

<div>
	<div class="row">
		<div class="col-md-4 d-flex justify-content-between">
			<h4 class="text-center">
                <a href="{{ route('ventes.create') }}">Facturation des Services</a>
			</h4>
		</div>
		<div class="col-md-4 d-flex justify-content-between">
			<h4 class="text-center">
				Liste des produits
			</h4>
		</div>
		<div class="col-md-4">
			<form action="">
				<input type="search" name="search" id="search" value="{{    $search }}"  class="form-control form-control-sm" placeholder="Rechercher ici ">
			</form>
		</div>
	</div>

	<table class="table table-sm">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">CODE</th>
				<th scope="col">Designation</th>
				<th scope="col">Prix</th>
				<th scope="col">Qte</th>
				<th scope="col">Date d'expiration</th>
				<th scope="col">Action</th>
			</tr>
		</thead>
		<tbody id="body_table">

			{!! $value_products !!}
		</tbody>
	</table>

</div>

{{-- <div class="col-md-12" style="height: 100px; overflow: hidden;">
	{{ $products->links()}}
</div> --}}

@if (Cart::content()->count() > 0)
{{-- expr --}}
<div>
	<ul class="list-group">
		<div class="row">
			@foreach (Cart::content() as $product)
			{{-- expr --}}
			<div class="col-md-4">
				<li class="list-group-item m-2 d-flex justify-content-between align-items-center">
					{{ $product->name }}
					<span class="badge badge-primary badge-pill">{{getPrice( $product->model->price) }}</span>
					<form action="{{ route('cart.destroy',$product->rowId) }}" method="post">
                     @csrf
                     @method('DELETE')
                     <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                   </form>
				</li>
			</div>
			@endforeach
		</div>
	</ul>
</div>
@endif

@endsection


@section('javascript')

<script>
	const searchEL = $("#search")

    searchEL.on('keyup', function(e){
        let value = e.target.value
      //  window.location = '/ventes?search='+value
        $.ajax({
            url: '/ventes',
            type: 'GET',
            data: {
                'search': value
            },
            success: function(data){

                $("#body_table").html(data)
            },
            error: function(data){
                console.log(data);
            }
        })

    })

    function addToCartProduct(product_id){

        $.ajax({
            url: '{{ route('panier.store') }}',
            type: 'POST',
            data: {
                'id': product_id,
                '_token' :  '{{ csrf_token() }}'
            },
            success: function(data){
                window.location.reload();
            },
            error: function(data){
                console.log(data);
            }
        })
    }
</script>


@stop
