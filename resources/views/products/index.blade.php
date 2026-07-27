@extends('layouts.app')

@section('content')
<div class="app-page">
    @include('products._header_product')

    <div class="app-card">
        <header class="app-card-header">
            <h2 class="app-card-heading">Liste des produits</h2>
            <div class="app-toolbar-actions">
                <form action="" method="GET" class="app-toolbar-filters">
                    <select name="category" class="form-control form-control-sm app-toolbar-select">
                        <option value="">Toutes les catégories</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->title }}
                            </option>
                        @endforeach
                        <option value="STOCK_VIDE" {{ request('category') == 'STOCK_VIDE' ? 'selected' : '' }}>STOCK VIDE</option>
                        <option value="STOCK_NON_VIDE" {{ request('category') == 'STOCK_NON_VIDE' ? 'selected' : '' }}>STOCK NON VIDE</option>
                    </select>
                    <div class="app-search">
                        <i class="fas fa-search" aria-hidden="true"></i>
                        <input type="text" name="search" value="{{ $search }}" placeholder="Rechercher ici">
                    </div>
                    <button type="submit" class="btn btn-outline-secondary btn-sm">OK</button>
                </form>
                <a href="{{ route('bon_entre') }}" class="btn btn-primary btn-sm">Entrées &amp; Sorties</a>
            </div>
        </header>

        <div class="app-card-body--flush">
            <div class="app-table-wrap">
                <table class="table table-sm app-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>CODE</th>
                            <th>@sortablelink('name','Désignation')</th>
                            <th>TVA (%)</th>
                            <th>@sortablelink('price','P.U.')</th>
                            <th>@sortablelink('quantite','Qté')</th>
                            <th>@sortablelink('unite_mesure','Unité')</th>
                            <th>@sortablelink('quantite_alert','Alerte')</th>
                            <th>Catégorie</th>
                            <th>Mouvement</th>
                            <th>Modifié le</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->code_product }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->taux_tva }}</td>
                                <td>{{ $value->price }}</td>
                                <td class="app-table-qty {{ $value->quantite >= $value->quantite_alert ? 'is-ok' : 'is-low' }}">
                                    {{ $value->quantite }}
                                </td>
                                <td>{{ $value->unite_mesure }}</td>
                                <td class="text-center">
                                    @if ($value->quantite <= $value->quantite_alert)
                                        <i class="fa fa-exclamation-triangle text-danger"
                                           title="Le stock de {{ $value->name }} est en dessous de l'alerte. Il devrait être de {{ $value->quantite_alert }}"></i>
                                    @endif
                                </td>
                                <td><strong>{{ $value->category->title ?? 'aucune' }}</strong></td>
                                <td>
                                    <a href="{{ route('movement_stock', $value->id) }}">
                                        {{ $value->mouvements->last()->item_movement_type ?? '' }}
                                    </a>
                                </td>
                                <td>{{ $value->updated_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="app-table-actions">
                                        <a href="{{ route('add_view',$value) }}" class="btn btn-info btn-sm">Mouvement</a>
                                        <a href="{{ route('products.edit', $value) }}" class="btn btn-outline-info btn-sm">Modifier</a>
                                        <a href="{{ route('products.show', $value) }}" class="btn btn-outline-warning btn-sm">Afficher</a>
                                        <form action="{{ route('products.destroy', $value) }}" method="POST" class="d-inline" onsubmit="return confirm('Voulez-vous supprimer ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">Supprimer</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="app-pagination">
            {{ $products->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection
