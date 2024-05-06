@extends('layouts.app')
@section('content')
<div class="px-4 px-lg-0">
    <!-- For demo purpose -->
    <!-- End -->
    <div class="pb-5">
        <div class="container">

            <div class="row">
                <div class="col-lg-12 p-1 bg-white rounded shadow-sm mb-1">
                    <!-- Shopping cart table -->
                    <div>
                        {{--  <form action="" >
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group ">
                                        @php
                                        $currentTva = \Request::get('current_tva') ?? 18 ;
                                        @endphp
                                        <label for="">TVA EST DE <b> {{ $currentTva }} % </b> </label>
                                        <select  id="current_tva" name="current_tva">
                                            @foreach(["", 18,10,4,0] as $value)
                                            <option value="{{$value}}"
                                            @if ($value == $currentTva)
                                            selected="selected"
                                            @endif
                                            > {{ $value }}</option>
                                            @endforeach
                                        </select>

                                        <small id="helpId" class="text-muted">%</small>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group ">
                                        <label for="">POURCENTAGE</label>
                                        <button type="submit" class="btn btn-primary btn-sm form-control form-control-sm" >Valider</button>
                                    </div>

                                </div>
                            </div>

                        </form>  --}}

                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class=" text-uppercase">Produit</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class=" text-uppercase">PRIX Revient</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class=" text-uppercase">Qté en Stock</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="text-uppercase">TVA (%)</div>
                                    </th>

                                    <th scope="col" class="border-0 bg-light">
                                        <div class="text-uppercase">
                                            P.U HTVA
                                        </div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="text-uppercase">
                                            P.U TTC
                                        </div>
                                    </th>

                                    {{--                  <th scope="col" class="border-0 bg-light">--}}
                                        {{--                    <div class="py-2 text-uppercase">CONDITIONEMENT</div>--}}
                                        {{--                  </th>--}}
                                        <th scope="col" class="border-0 bg-light">
                                            <div class="py-2 text-uppercase">QUANTITE</div>
                                        </th>
                                        <th scope="col" class="border-0 bg-light">
                                            <div class="py-2 text-uppercase">P.T HTVA </div>
                                        </th>
                                        <th scope="col" class="border-0 bg-light">
                                            <div class="py-2 text-uppercase">Action</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($paniers as $product)

                                    {{-- expr --}}
                                    <tr>
                                        <th scope="row" class="border-0">
                                            {{$product->name}}
                                        </th>

                                        <th scope="row" class="border-0">
                                            {{getPrice($product->model->price_max)}}
                                        </th>
                                        <th>
                                            {{ $product->model->quantite }}
                                        </th>
                                        <th>{{ $product->model->taux_tva }}</th>
                                        <th>
                                            <input type="number" class="price_input" data-product="{{ $product->rowId }}"
                                            value="{{ $product->price }}"
                                            data-tva="{{ $product->model->taux_tva }}"
                                            class="form-control">
                                        </th>
                                        <th>
                                            <span id="price_tvac_{{ $product->rowId }}" >{{ $product->model->price_tvac  }}</span>
                                        </th>

                                        {{--                  <td >--}}
                                            {{--                    <input type="text" class="embalage" data-product="{{ $product->rowId }}" style="width:50px;" value="{{$product->options['embalage']}}"/>--}}
                                            {{--                    <b>Kg/Sac</b>--}}
                                            {{--                  </td>--}}

                                            <td class="border-0 align-middle">

                                                <input type="number"
                                                value="{{$product->qty}}"

                                                data-id="{{ $product->rowId }}" class="quantite quantite_select" min="1" max="{{$product->model->quantite }}" >

                                            </td>

                                            <th>
                                                <span id="{{ $product->rowId }}">{{ getPrice($product->subtotal())  }}</span>
                                            </th>

                                            <td class="border-0 align-middle">

                                                <form action="{{ route('cart.destroy',$product->rowId) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" ><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>

                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <!-- End -->
                        </div>
                    </div>
                    <div class="row py-2 p-1 bg-white rounded shadow-sm">
                        <div class="col-lg-6">
                            <div class="bg-light rounded-pill px-1 py-1 text-uppercase font-weight-bold">INFORMATION DU CLIENT</div>
                            <div class="p-1">
                                {{$errors}}
                                <form action="{{ route('payement') }}" method="post">

                                    {{--  <input type="hidden" name="currentTva" value="{{ $currentTva }}">  --}}
                                    {{--  <p> SEARCHH CLIENT <input id="autocompleteInput"></p>  --}}
                                    <div class="d-flex justify-content-between">

                                        <p>
                                            <input type="text" name="clientNumber" id="clientNumber" placeholder="Numero du client">
                                            <button onclick="searchClient()" class="btn-sm btn-info">Rechercher</button>
                                        </p>
                                        <p >
                                            <input  type="checkbox" style="cursor:pointer" name="vat_customer_payer" id="vat_customer_payer">
                                            <a href="{{ route('clients.create') }}" class="btn btn-primary btn-sm"> Nouveau client </a>
                                        </p>

                                    </div>
                                    <div>
                                        <label for="">Date de Facturation</label>
                                        <input type="hidden" id="date_facturation" value="{{ date('Y-m-d') }}"  name="date_facturation">
                                    </div>

                                    @csrf
                                    @method('post')
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <input  required="" type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Entrer le nom ici" aria-describedby="button-addon3" class="form-control border-2">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <input  type="text" name="telephone" id="telephone" placeholder="Numéro du téléphone" aria-describedby="button-addon3" class="form-control border-2">
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <input  type="text" id="customer_TIN" name="customer_TIN" placeholder="Numéro nif du client" aria-describedby="button-addon3" class="form-control border-2">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input  type="text" id="addresse_client" name="addresse_client" placeholder="Adresse du client" aria-describedby="button-addon3" class="form-control border-2">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="type_paiement">MODE DE PAIEMENT</label>
                                        <select required="" class="form-control" name="type_paiement" id="">
                                            <option value="">Choisissez ...</option>
                                            <option value="1">en espèce</option>
                                            <option value="2">banque</option>
                                            <option value="3">à crédit</option>
                                            <option value="4">autres</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-dark rounded-pill py-2 btn-block">Valider</button>
                                </form>
                                {{--  <div class="input-group mb-4 border rounded-pill p-2">
                                    <input type="text" placeholder="Apply coupon" aria-describedby="button-addon3" class="form-control border-0">
                                    <div class="input-group-append border-0">
                                        <button id="button-addon3" type="button" class="btn btn-dark px-4 rounded-pill"><i class="fa fa-gift mr-2"></i>Enregistrer</button>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="bg-light rounded-pill px-1 py-1 text-uppercase font-weight-bold">Instructions pour le client</div>
                        </div>
                        <div class="col-lg-6">
                            <div class="bg-light rounded-pill px-1 py-1 text-uppercase font-weight-bold">Déscription  </div>
                            <div class="p-2">
                                <ul class="list-unstyled mb-2">
                                    <li class="d-flex justify-content-between py-2 border-bottom"><strong class="text-muted">PHTVA </strong>
                                        <h5 id="prix_hors_tva" class="font-weight-bold">
                                            <span>{{getPrice(Cart::subtotal())}}</span>
                                        </h5>
                                    </li>
                                    <li class="d-flex justify-content-between py-2 border-bottom"><strong class="text-muted">TVA</strong>
                                        <h5 id="prix_hors_tax" class="font-weight-bold">
                                            {{ getPrice(Cart::tax()) }}
                                        </h5></li>
                                        <li class="d-flex justify-content-between py-2 border-bottom"><strong class="text-muted">Total</strong>
                                            <h5 class="font-weight-bold">
                                                <b id="total_montant">{{ getPrice(Cart::total()) }}</b>
                                            </h5>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            @stop


            @section('javascript')

            <script>

                var tags = [
                "jQuery", "java", "php",
                "MySQL", "javascript",
                "html", "C#", "C", "MongoDB","LIONEL",
                ];

                $("#autocompleteInput").autocomplete({
                    source: tags,
                    select : showResult,
                   /* select : showResult,
                focus : showResult,
                change :showResult */

                });

                function showResult(event, ui) {
                   // $('#cityName').text(ui.item.label)
                    alert("Selected: " + ui.item.value + " aka ");
                }

                function prixVenteTvac(price, taux = 0.18){
                    return Math.round(price * (1 + taux ));
                }

                let price_input = $('.price_input');
                let quantite_select = $('.quantite_select');
                let embalage = $('.embalage');

                embalage.on('blur', function(){
                    let product_id = this.getAttribute('data-product');
                    let embalage = this.value;
                    var current_tva = $("#current_tva").val();
                    $.ajax(
                    {
                        url : '{{ route('update_emballage') }}',
                        method : 'get',
                        data : {product_id , embalage , current_tva}
                    }

                    ).done(function(data){

                        $("#"+data.rowId).html(data.cart)

                        $("#prix_hors_tva").html(data.prix_hors_tva);
                        $("#total_montant").html(data.total_montant);
                        $("#prix_hors_tax").html(data.prix_hors_tax);
                        console.log(data)
                    })
                    .catch(function(error){
                        console.log(error)
                    })

                });


                price_input.on('keyup', function(){
                    let product_id = this.getAttribute('data-product');
                    let tva = this.getAttribute('data-tva');
                    let price = this.value;
                    var current_tva = $("#current_tva").val();
                    const prix_tva =  prixVenteTvac(this.value , tva);

                    $("#price_tvac_" + product_id).html(prix_tva)
                    $.ajax(
                    {
                        url : '{{ route('update_price') }}',
                        method : 'get',
                        data : {product_id , price,current_tva}
                    }

                    ).done(function(data){

                        $("#"+data.rowId).html(data.cart)

                        $("#prix_hors_tva").html(data.prix_hors_tva);
                        $("#total_montant").html(data.total_montant);
                        $("#prix_hors_tax").html(data.prix_hors_tax);
                        console.log(data)
                    })
                    .catch(function(error){
                        console.log(error)
                    })

                });


                quantite_select.on('keyup',function(){
                    var rowId = this.getAttribute('data-id');
                    var qty = this.value;
                    var current_tva = $("#current_tva").val();

                    $.ajax({
                        url : "{{ asset('update_quantite') }}",
                        method : 'get',
                        data : {
                            rowId, qty, current_tva
                        }

                    }).done(function(data){
                        $("#"+data.rowId).html(data.cart)

                        $("#prix_hors_tva").html(data.prix_hors_tva);
                        $("#total_montant").html(data.total_montant);
                        $("#prix_hors_tax").html(data.prix_hors_tax);

                        console.log(data)
                    }).catch(function(error){
                        console.log(error)
                    })

                })

                function searchClient(){
                    window.event.preventDefault();

                    const client_id = $("#clientNumber").val();
                    $.ajax({
                        url : "{{ asset('getClient') }}/" + client_id,
                        method : 'get'
                    }).done(function(data){
                        const client = data.client;

                        $("#name").val(client.name)
                        $("#telephone").val(client.telephone)
                        $("#addresse_client").val(client.addresse)
                        $("#customer_TIN").val(client.customer_TIN)
                        $("#vat_customer_payer").val(client.vat_customer_payer)

                    }).catch(function(error){
                        console.log(error)
                    })
                }



                // var selects = document.querySelectorAll("#qty")

                // Array.from(selects).forEach( function(element, index) {

                    //   element.addEventListener('change',function(){

                        //     var token = $('meta[name="csrf-token"]').attr('content');

                        //     $.ajaxSetup({
                            //       headers: {

                                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                                //       }

                                //     });

                                //       $.ajax({

                                    //        type:'POST',

                                    //        url:"{{ route('cart.update_panier') }}",

                                    //        data:{rowId : rowId, qty :qty },

                                    //        success:function(data){

                                        //         location.reload();
                                        //         console.log(data)

                                        //       },
                                        //       error: function(error){
                                            //         console.log(error)
                                            //       }
                                            //     });



                                            //   });

                                            // })

                                        </script>

                                        @endsection
