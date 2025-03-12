@extends('layouts.app')
@section('content')
<div class="px-4 px-lg-0">
    <!-- For demo purpose -->
    <!-- End -->
    <div class="pb-5">
        <div class="container">

            <div class="row">
                <div class="p-1 mb-1 bg-white rounded shadow-sm col-lg-12">
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
                                            class="form-control"
                                            min="0" value="0" step="any"
                                            >
                                        </th>
                                        <th>
                                            <span id="price_tvac_{{ $product->rowId }}" >{{ $product->model->price_tvac  }}</span>
                                        </th>

                                        {{--                  <td >--}}
                                            {{--                    <input type="text" class="embalage" data-product="{{ $product->rowId }}" style="width:50px;" value="{{$product->options['embalage']}}"/>--}}
                                            {{--                    <b>Kg/Sac</b>--}}
                                            {{--                  </td>--}}

                                            <td class="align-middle border-0">

                                                <input type="number"
                                                value="{{$product->qty}}"
                                                data-id="{{ $product->rowId }}" class="quantite quantite_select" min="1" max="{{$product->model->quantite }}"
                                                step="any"
                                                >

                                            </td>

                                            <th>
                                                <span id="{{ $product->rowId }}">
                                                {{ getPrice($product->subtotal())  }}

                                            </span>
                                            </th>

                                            <td class="align-middle border-0">

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
                    <div class="p-1 py-2 bg-white rounded shadow-sm row">
                        <div class="col-lg-6">
                            <div class="px-1 py-1 bg-light rounded-pill text-uppercase font-weight-bold">INFORMATION DU CLIENT</div>
                            <div class="p-1">
                                {{$errors}}
                                <form action="{{ route('payement') }}" method="post">

                                    {{--  <input type="hidden" name="currentTva" value="{{ $currentTva }}">  --}}
                                    <div class="form-group">
                                        <input type="text" id="chercherClient" name="chercherClient" placeholder="Recherche Ici" class="border-2 form-control form-control-sm">
                                    </div>
                                    <div class="d-flex justify-content-between">

                                        <p>
                                            {{--  <input type="text" name="clientNumber" id="clientNumber" placeholder="
                                            Recherche Ici ">  --}}
                                            {{--  <button onclick="searchClient()" class="btn-sm btn-info">Rechercher</button>  --}}
                                        </p>

                                        <p >
                                            {{--  <input  type="checkbox" style="cursor:pointer" name="vat_customer_payer" id="vat_customer_payer">  --}}
                                            <a href="{{ route('clients.create') }}" class="btn btn-primary btn-sm"> Nouveau client </a>
                                        </p>

                                    </div>
                                    <p id="screenError">

                                    </p>
                                    <div>

                                        <input type="hidden" id="date_facturation" value="{{ date('Y-m-d') }}"  name="date_facturation">
                                        <input type="hidden" id="client_id"   name="client_id">
                                    </div>

                                    @csrf
                                    @method('post')
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <input  disabled type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Entrer le nom ici" aria-describedby="button-addon3" class="border-2 form-control">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <input  disabled name="telephone" id="telephone" placeholder="Numéro du téléphone" aria-describedby="button-addon3" class="border-2 form-control">
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <input  disabled id="customer_TIN" name="customer_TIN" placeholder="Numéro nif du client" aria-describedby="button-addon3" class="border-2 form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input  disabled id="addresse_client"  placeholder="Adresse du client" aria-describedby="button-addon3" class="border-2 form-control">
                                            <span id="search_response"></span>
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
                                    @if (env('APP_USE_ABONEMENT', false))
                                        <div class="form-group">
                                            <input type="hidden" name="commissionaire_id" id="selectedCommisionnaire">
                                            <input type="text" class="form-control" id="commissionaire_id" placeholder="PORTEUR" aria-describedby="button-addon3" class="border-2 ">
                                        </div>
                                    @endif

                                    <button type="submit" class="py-2 btn btn-dark rounded-pill btn-block">Valider</button>
                                </form>
                                {{--  <div class="p-2 mb-4 border input-group rounded-pill">
                                    <input type="text" placeholder="Apply coupon" aria-describedby="button-addon3" class="border-0 form-control">
                                    <div class="border-0 input-group-append">
                                        <button id="button-addon3" type="button" class="px-4 btn btn-dark rounded-pill"><i class="mr-2 fa fa-gift"></i>Enregistrer</button>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="px-1 py-1 bg-light rounded-pill text-uppercase font-weight-bold">Instructions pour le client</div>
                        </div>
                        <div class="col-lg-6">
                            <div class="px-1 py-1 bg-light rounded-pill text-uppercase font-weight-bold">Déscription  </div>
                            <div class="p-2">
                                <ul class="mb-2 list-unstyled">
                                    <li class="py-2 d-flex justify-content-between border-bottom"><strong class="text-muted">PHTVA </strong>
                                        <h5 id="prix_hors_tva" class="font-weight-bold">
                                            <span>{{getPrice(Cart::subtotal())}}</span>
                                        </h5>
                                    </li>
                                    <li class="py-2 d-flex justify-content-between border-bottom"><strong class="text-muted">TVA</strong>
                                        <h5 id="prix_hors_tax" class="font-weight-bold">
                                            {{ getPrice(Cart::tax()) }}
                                        </h5></li>
                                        <li class="py-2 d-flex justify-content-between border-bottom"><strong class="text-muted">Total</strong>
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

                const searchCommissionnaire = async () => {
                    try {
                        const x = await fetch('{{ route('load_commission') }}')
                        .then(res => res.json());
                        return x; // either true or false
                    } catch (err) {
                        return false; // definitely offline
                    }
                };
                const loadingCliens = async () => {
                    try {
                        const x = await fetch('{{ route('getClient','ALL') }}')
                        .then(res => res.json());
                        return x; // either true or false
                    } catch (err) {
                        return false; // definitely offline
                    }
                };


                $(document).ready(async function()  {
                    var tags = await searchCommissionnaire();
                    var clients = await loadingCliens();

                    const currentTag = tags.map(tag => `${tag.name} |  ${tag.telephone} |${tag.id}`);
                    const currentsClients = clients.map(tag => `${tag.name} |TEL :  ${tag.telephone ?? ""} | NIF: ${tag.customer_TIN ?? ""}  |#${tag.id}`);
                    console.log("TAGS HERE ", currentTag);
                    console.log("tags ", tags);

                    $("#commissionaire_id").autocomplete({
                        source: currentTag,
                        /* focus : showResult,
                        change :showResult,*/
                        select : checkUser
                    });
                    $("#chercherClient").autocomplete({
                        source: currentsClients,
                        /*focus : showResult,
                        change :showResult,*/
                        select : selectClient
                    });

                    function checkUser(event, ui) {
                        let id = ui.item.value.split('|')[2];
                        $("#selectedCommisionnaire").val(id);
                    }
                    function selectClient(event, ui) {
                        //console.log(ui.item.value);
                        const id = ui.item.value.split('|#')[1];
                        const client = clients.filter(client => client.id == id)[0];
                        $("#client_id").val(id)
                        $("#name").val(client.name)
                        $("#telephone").val(client.telephone)
                        $("#addresse_client").val(client.addresse)
                        $("#customer_TIN").val(client.customer_TIN)
                    }

                    function showResult(event, ui) {
                        // $('#cityName').text(ui.item.label)

                    }
                });



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

                function searchClient(client){
                    $("#name").val(client.name)
                    $("#telephone").val(client.telephone)
                    $("#addresse_client").val(client.addresse)
                    $("#customer_TIN").val(client.customer_TIN)

                }




            </script>

            @endsection
