@extends('layouts.app')

@section('content')

<div class="">
    @include('products._header_product')

    <div class="row align-items-center mb-3">
        <div class="col-md-6 d-flex justify-content-between align-items-center">
            <a href="{{ route('bon_entre') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-box-arrow-in-down"></i> Entrées & Sorties
            </a>
            <h4 class="mb-0 text-center flex-grow-1">Liste des produits</h4>
        </div>

        <div class="col-md-6">
            <form action="" method="GET" class="d-flex gap-2">
                <select name="category" class="form-select form-select-sm">
                    <option value="">Toutes les catégories</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->title }}
                        </option>
                    @endforeach
                    <option value="STOCK_VIDE" {{ request('category') == 'STOCK_VIDE' ? 'selected' : '' }}>STOCK VIDE</option>
                    <option value="STOCK_NON_VIDE" {{ request('category') == 'STOCK_NON_VIDE' ? 'selected' : '' }}>STOCK NON VIDE</option>
                </select>

                <input type="text" name="search" class="form-control form-control-sm" value="{{ $search }}" placeholder="Rechercher ici">
                <button type="submit" class="btn btn-outline-secondary btn-sm">OK</button>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-sm align-middle">
            <thead class="table-light">
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
                        <td class="{{ $value->quantite >= $value->quantite_alert ? 'bg-success text-white' : 'bg-danger text-white' }}">
                            {{ $value->quantite }}
                        </td>
                        <td>{{ $value->unite_mesure }}</td>
                        <td class="text-center">
                            @if ($value->quantite <= $value->quantite_alert)
                                <i class="fa fa-exclamation-triangle text-danger"
                                   title="Le stock de {{ $value->name }} est en dessous de l'alerte. Il devrait être de {{ $value->quantite_alert }}">
                                </i>
                            @endif
                        </td>
                        <td><strong>{{ $value->category->title ?? 'aucune' }}</strong></td>
                        <td>
                            <a href="{{ route('movement_stock', $value->id) }}">
                                {{ $value->mouvements->last()->item_movement_type ?? '' }}
                            </a>
                        </td>
                        <td>{{ $value->updated_at->format('d/m/Y') }}</td>
                        <td class="d-flex gap-1 flex-wrap">
                            <a href="{{ route('add_view',$value) }}" class="btn btn-info btn-sm">Mouvement</a>
                            <a href="{{ route('products.edit', $value) }}" class="btn btn-outline-info btn-sm">Modifier</a>
                            <a href="{{ route('products.show', $value) }}" class="btn btn-outline-warning btn-sm">Afficher</a>
                            <form action="{{ route('products.destroy', $value) }}" method="POST" onsubmit="return confirm('Voulez-vous supprimer ?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $products->appends(request()->query())->links() }}
    </div>
</div>

@endsection
