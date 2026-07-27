@extends('layouts.app')

@section('content')

<div class="vente-page">
    @include('ventes._header')

    <div class="vente-workspace">
        {{-- Products card --}}
        <section class="vente-card vente-products">
            <header class="vente-card-header">
                <h2 class="vente-card-heading">Liste des produits</h2>
                <div class="vente-search">
                    <i class="fas fa-search" aria-hidden="true"></i>
                    <input
                        type="search"
                        name="search"
                        id="search"
                        value="{{ $search }}"
                        placeholder="Code, nom, prix…"
                        autocomplete="off"
                    >
                </div>
            </header>

            <div class="vente-datatable">
                <div class="vente-datatable-scroll formTableHead">
                    <table class="vente-table">
                        <thead>
                            <tr>
                                <th class="col-center">#</th>
                                <th>Code</th>
                                <th>Désignation</th>
                                <th class="col-num">Prix HTVA</th>
                                <th class="col-num">TVA %</th>
                                <th class="col-num">Prix TVAC</th>
                                <th class="col-num">Qté</th>
                                <th>Expiration</th>
                                <th class="col-action">Action</th>
                            </tr>
                        </thead>
                        <tbody id="body_table">
                            {!! $value_products !!}
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        {{-- Cart card --}}
        <aside class="vente-card vente-cart">
            <header class="vente-card-header vente-cart-header">
                <h2 class="vente-card-heading">Panier</h2>
                <span class="vente-badge" id="vente-cart-badge">{{ Cart::count() }}</span>
            </header>

            <div class="vente-cart-body" id="paniers_content">
                {!! $paniers_content !!}
            </div>

            <footer class="vente-cart-footer">
                <a href="{{ route('panier.index') }}" class="vente-btn-primary">
                    <i class="fas fa-arrow-right"></i>
                    Continuer vers le panier
                </a>
            </footer>
        </aside>
    </div>
</div>

@endsection

@section('javascript')

<script>
    const searchEL = $("#search");

    searchEL.on('keyup', function (e) {
        updateTableData(e.target.value);
    });

    function updateCartBadge() {
        let count = 0;
        $("#paniers_content #panier_content tr").each(function () {
            if ($(this).find('.vente-cart-empty').length) {
                return;
            }
            const qtyText = $(this).find('td').eq(2).text().trim();
            const qty = parseInt(qtyText, 10);
            count += Number.isFinite(qty) ? qty : 0;
        });
        const badge = document.getElementById('vente-cart-badge');
        if (badge) {
            badge.textContent = count;
            badge.classList.toggle('is-empty', count === 0);
        }
    }

    function updateTableData(value = '') {
        $.ajax({
            url: '/ventes',
            type: 'GET',
            data: { 'search': value },
            success: function (data) {
                $("#body_table").html(data);
            },
            error: function (data) {
                console.log(data);
            }
        });
    }

    function addToCartProduct(product_id) {
        $.ajax({
            url: '{{ route('panier.store') }}',
            type: 'POST',
            data: {
                'id': product_id,
                '_token': '{{ csrf_token() }}'
            },
            success: function (data) {
                $("#paniers_content").html(data.panier);
                updateTableData(searchEL.val() || '');
                updateCartBadge();
            },
            error: function (data) {
                console.log(data);
                alert(JSON.strinfy(data));
            }
        });
    }

    function removeToContent(product_id) {
        $.ajax({
            url: `panier/${product_id}`,
            type: 'DELETE',
            data: {
                'id': product_id,
                '_token': '{{ csrf_token() }}'
            },
            success: function (data) {
                $("#paniers_content").html(data.panier);
                updateTableData(searchEL.val() || '');
                updateCartBadge();
            },
            error: function (data) {
                console.log(data);
                alert(JSON.strinfy(data));
            }
        });
    }

    updateCartBadge();
</script>

@stop
