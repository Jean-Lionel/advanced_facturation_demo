<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}

    <div class="row">
        <div class="col-md-4">
            <div>
                <h3 class="text-center">Liste des produits</h3>
                <hr>
                <div>
                    <input type="search" class="form-control form-control-sm" placeholder="Rechercher ici ">
                </div>
            </div>
            <table>
                @foreach ($stockProducts as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>
                            <button class="btn btn-sm btn-primary" wire:click="addProduct({{ $item->id }})">
                                <span class="fa fa-plus"></span>

                            </button>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="col-md-4">
            <div>
                <h3 class="text-center">Liste des produits</h3>
                <hr>
                <hr>

                @if (session()->has($sesion_key))
                    // Key exists in the session
                   <table>
                    @foreach ($products_comandes as $product)
                    <tr>
                        <td>
                            <button class="btn btn-sm btn-danger" wire:click="removeProduct({{ $product->id }})">
                                <span class="fa fa-minus"></span>
                            </button>
                        </td>
                        <td>{{ $product->name }}</td>

                    </tr>
                    @endforeach
                   </table>
                @endif
            <div>

        </div>
    </div>
</div>
