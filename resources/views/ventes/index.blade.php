@extends('layouts.app')
@section('content')

@include("ventes._header")

<div class="row container-fluid">

    <div class="col-md-8">
        <div class="row">
            <div class="col-md-8">
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
        <div class="fixTableHead">
        <table class="table table-sm ">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">CODE</th>
                    <th scope="col">Designation</th>
                    <th scope="col">Prix HTVA</th>
                    <th scope="col">TVA (%)</th>
                    <th scope="col">Prix TVAC</th>
                    <th scope="col">Qte</th>
                    <th scope="col">{{ "Date d'expiration" }}</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="body_table">
                {!! $value_products !!}
            </tbody>
        </table>
    </div>
    </div>
    <div class="col-md-4">
        <div class="row" id="paniers_content">
            {!! $paniers_content !!}
        </div>
    </div>
</div>

@endsection


@section('javascript')

<script>
    const searchEL = $("#search")

    searchEL.on('keyup', function(e){
        let value = e.target.value
        //  window.location = '/ventes?search='+value
        updateTableData(value);

    })

    function updateTableData( value = ''){
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
    }

    function addToCartProduct(product_id){
        $.ajax({
            url: '{{ route('panier.store') }}',
            type: 'POST',
            data: {
                'id': product_id,
                '_token' :  '{{ csrf_token() }}'
            },
            success: function(data){
                $("#paniers_content").html(data.panier);
                updateTableData();
            },
            error: function(data){
                console.log(data);
                alert(JSON.strinfy(data));
            }
        })
    }
    //route('cart.destroy',

    function removeToContent(product_id){
        $.ajax({
            url: `panier/${product_id}`,
            type: 'DELETE',
            data: {
                'id': product_id,
                '_token' :  '{{ csrf_token() }}'
            },
            success: function(data){
                $("#paniers_content").html(data.panier);
                updateTableData();
            },
            error: function(data){
                console.log(data);
                alert(JSON.strinfy(data));
            }
        }
        )
    }
</script>


@stop
