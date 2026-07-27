@extends('layouts.app')
@section('content')
<div class="vente-page">
    @include('ventes._header')

    <div class="vente-stack">
        <section class="vente-card">
            <header class="vente-card-header">
                <h2 class="vente-card-heading">Panier</h2>
                <a href="{{ route('ventes.index') }}" class="btn vente-btn vente-btn-ghost">
                    <i class="fas fa-arrow-left"></i> Retour vente
                </a>
            </header>

            <div class="vente-card-body p-0">
                <div class="vente-table-card" style="border:none; border-radius:0;">
                    <table class="vente-table">
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th class="col-num">Prix revient</th>
                                <th class="col-num">Qté stock</th>
                                <th class="col-num">TVA (%)</th>
                                <th class="col-num">P.U HTVA</th>
                                <th class="col-num">P.U TTC</th>
                                <th>Quantité</th>
                                <th class="col-num">P.T HTVA</th>
                                <th class="col-action">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($paniers as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td class="col-num">{{ getPrice($product->model->price_max) }}</td>
                                    <td class="col-num">{{ $product->model->quantite }}</td>
                                    <td class="col-num">{{ $product->model->taux_tva }}</td>
                                    <td>
                                        <input
                                            type="number"
                                            class="price_input"
                                            data-product="{{ $product->rowId }}"
                                            data-tva="{{ $product->model->taux_tva }}"
                                            value="{{ $product->price }}"
                                            min="0"
                                            step="any"
                                        >
                                    </td>
                                    <td class="col-num">
                                        <span id="price_tvac_{{ $product->rowId }}">{{ $product->model->price_tvac }}</span>
                                    </td>
                                    <td>
                                        <input
                                            type="number"
                                            value="{{ $product->qty }}"
                                            data-id="{{ $product->rowId }}"
                                            class="quantite quantite_select"
                                            min="1"
                                            max="{{ $product->model->quantite }}"
                                            step="any"
                                        >
                                    </td>
                                    <td class="col-num">
                                        <span id="{{ $product->rowId }}">{{ getPrice($product->subtotal()) }}</span>
                                    </td>
                                    <td class="col-action">
                                        <form action="{{ route('cart.destroy', $product->rowId) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn vente-btn vente-btn-danger" title="Supprimer">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center text-muted py-4">Aucun produit dans le panier</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <form action="{{ route('payement') }}" method="post">
            @csrf
            @method('post')

            <div class="vente-split">
                <section class="vente-card">
                    <header class="vente-card-header">
                        <h2 class="vente-card-heading">Information du client</h2>
                        <a href="{{ route('clients.create') }}" class="btn vente-btn vente-btn-accent">Nouveau client</a>
                    </header>

                    <div class="vente-card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="vente-field vente-client-search">
                            <label for="chercherClient">Recherche client</label>
                            <div class="vente-client-search-wrap">
                                <i class="fas fa-search" aria-hidden="true"></i>
                                <input
                                    type="search"
                                    id="chercherClient"
                                    name="chercherClient"
                                    placeholder="Nom, téléphone ou NIF..."
                                    class="form-control"
                                    autocomplete="off"
                                >
                            </div>
                        </div>

                        <p id="screenError" class="mb-0"></p>

                        <input type="hidden" id="date_facturation" value="{{ date('Y-m-d') }}" name="date_facturation">
                        <input type="hidden" id="client_id" name="client_id">

                        <div id="client_info_panel" class="vente-client-panel is-empty">
                            <div class="vente-client-panel-empty" id="client_info_empty">
                                Aucun client sélectionné
                            </div>
                            <div class="vente-client-panel-content d-none" id="client_info_content">
                                <div class="vente-client-panel-name" id="client_display_name">—</div>
                                <div class="vente-client-panel-grid">
                                    <div>
                                        <span>Téléphone</span>
                                        <b id="client_display_phone">—</b>
                                    </div>
                                    <div>
                                        <span>NIF</span>
                                        <b id="client_display_nif">—</b>
                                    </div>
                                    <div class="vente-client-panel-full">
                                        <span>Adresse</span>
                                        <b id="client_display_address">—</b>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if (env('APP_USE_ABONEMENT', false))
                            <div class="vente-field mt-3 mb-0">
                                <label for="commissionaire_id">Porteur</label>
                                <input type="hidden" name="commissionaire_id" id="selectedCommisionnaire">
                                <input type="text" class="form-control form-control-sm" id="commissionaire_id" placeholder="Rechercher un porteur">
                            </div>
                        @endif
                    </div>
                </section>

                <section class="vente-card">
                    <header class="vente-card-header">
                        <h2 class="vente-card-heading">Description</h2>
                    </header>
                    <div class="vente-card-body">
                        <div class="vente-field mb-3">
                            <label for="type_paiement">Mode de paiement</label>
                            <select required class="form-control" name="type_paiement" id="type_paiement">
                                <option value="">Choisissez ...</option>
                                <option value="1">en espèce</option>
                                <option value="2">banque</option>
                                <option value="3">à crédit</option>
                                <option value="4">autres</option>
                            </select>
                        </div>

                        <ul class="vente-meta-list">
                            <li>
                                <span>Monnaie de paiement</span>
                                <select name="invoice_currency" class="vente-inline-control" style="width:auto; min-width:100px;">
                                    @foreach (TYPE_MONNAIE as $currency)
                                        <option value="{{ $currency }}">{{ $currency }}</option>
                                    @endforeach
                                </select>
                            </li>
                            <li>
                                <span>PHTVA</span>
                                <h5 id="prix_hors_tva" class="mb-0 font-weight-bold">
                                    <span>{{ getPrice(Cart::subtotal()) }}</span>
                                </h5>
                            </li>
                            <li>
                                <span>TVA</span>
                                <h5 id="prix_hors_tax" class="mb-0 font-weight-bold">{{ getPrice(Cart::tax()) }}</h5>
                            </li>
                            <li>
                                <span>Total</span>
                                <h5 class="mb-0 font-weight-bold">
                                    <b id="total_montant">{{ getPrice(Cart::total()) }}</b>
                                </h5>
                            </li>
                        </ul>

                        <div class="mt-3">
                            <button type="submit" class="vente-btn-primary">
                                <i class="fas fa-check"></i> Valider
                            </button>
                        </div>
                    </div>
                </section>
            </div>
        </form>
    </div>
</div>
@stop

@section('javascript')
<script>
    const searchCommissionnaire = async () => {
        try {
            const x = await fetch('{{ route('load_commission') }}').then(res => res.json());
            return x;
        } catch (err) {
            return false;
        }
    };
    const loadingCliens = async () => {
        try {
            const x = await fetch('{{ route('getClient','ALL') }}').then(res => res.json());
            return x;
        } catch (err) {
            return false;
        }
    };

    $(document).ready(async function () {
        var tags = await searchCommissionnaire();
        var clients = await loadingCliens();

        const currentTag = tags.map(tag => `${tag.name} |  ${tag.telephone} |${tag.id}`);
        const currentsClients = clients.map(tag => `${tag.name} |TEL :  ${tag.telephone ?? ""} | NIF: ${tag.customer_TIN ?? ""}  |#${tag.id}`);

        $("#commissionaire_id").autocomplete({
            source: currentTag,
            select: checkUser
        });
        $("#chercherClient").autocomplete({
            source: currentsClients,
            select: selectClient
        });

        function checkUser(event, ui) {
            let id = ui.item.value.split('|')[2];
            $("#selectedCommisionnaire").val(id);
        }
        function selectClient(event, ui) {
            const id = ui.item.value.split('|#')[1];
            const client = clients.filter(client => client.id == id)[0];
            if (!client) return;
            $("#client_id").val(id);
            searchClient(client);
        }
    });

    function prixVenteTvac(price, taux = 0.18) {
        return Math.round(price * (1 + taux));
    }

    let price_input = $('.price_input');
    let quantite_select = $('.quantite_select');
    let embalage = $('.embalage');

    embalage.on('blur', function () {
        let product_id = this.getAttribute('data-product');
        let embalage = this.value;
        var current_tva = $("#current_tva").val();
        $.ajax({
            url: '{{ route('update_emballage') }}',
            method: 'get',
            data: { product_id, embalage, current_tva }
        }).done(function (data) {
            $("#" + data.rowId).html(data.cart)
            $("#prix_hors_tva").html(data.prix_hors_tva);
            $("#total_montant").html(data.total_montant);
            $("#prix_hors_tax").html(data.prix_hors_tax);
        }).catch(function (error) {
            console.log(error)
        })
    });

    price_input.on('keyup', function () {
        let product_id = this.getAttribute('data-product');
        let tva = this.getAttribute('data-tva');
        let price = this.value;
        var current_tva = $("#current_tva").val();
        const prix_tva = prixVenteTvac(this.value, tva);

        $("#price_tvac_" + product_id).html(prix_tva)
        $.ajax({
            url: '{{ route('update_price') }}',
            method: 'get',
            data: { product_id, price, current_tva }
        }).done(function (data) {
            $("#" + data.rowId).html(data.cart)
            $("#prix_hors_tva").html(data.prix_hors_tva);
            $("#total_montant").html(data.total_montant);
            $("#prix_hors_tax").html(data.prix_hors_tax);
        }).catch(function (error) {
            console.log(error)
        })
    });

    quantite_select.on('keyup', function () {
        var rowId = this.getAttribute('data-id');
        var qty = this.value;
        var current_tva = $("#current_tva").val();

        $.ajax({
            url: "{{ asset('update_quantite') }}",
            method: 'get',
            data: { rowId, qty, current_tva }
        }).done(function (data) {
            $("#" + data.rowId).html(data.cart)
            $("#prix_hors_tva").html(data.prix_hors_tva);
            $("#total_montant").html(data.total_montant);
            $("#prix_hors_tax").html(data.prix_hors_tax);
        }).catch(function (error) {
            console.log(error)
        })
    })

    function searchClient(client) {
        $("#client_display_name").text(client.name || "—");
        $("#client_display_phone").text(client.telephone || "—");
        $("#client_display_nif").text(client.customer_TIN || "—");
        $("#client_display_address").text(client.addresse || "—");
        $("#client_info_empty").addClass("d-none");
        $("#client_info_content").removeClass("d-none");
        $("#client_info_panel").removeClass("is-empty");
    }
</script>
@endsection
