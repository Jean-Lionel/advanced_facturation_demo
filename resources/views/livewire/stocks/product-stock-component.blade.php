<div>
    In work, do what you enjoy.



    <div class="row">
        <div class="col-md-3">
            <input type="text" class="form-control" wire:model="searchProduct">

            <table class="table-sm table">
                @foreach ($pendingProducts as $p1)
                <tr>
                    <td>{{ $p1->name }}</td>
                    <td>{{ $p1->unite_mesure }}</td>
                    <td>
                        <button class="btn btn-primary btn-sm" wire:click="addProduct({{ $p1->id }})">
                            {{--  <span class="fa fas fa-arrows-alt-h"></span>
                            <span class="fas fa-sync"></span>  --}}
                            <span class="fas fa-arrow-right"></span>
                        </button>
                    </td>
                </tr>

                @endforeach
            </table>
        </div>
        <div class="col-md-8">
            <input type="text" class="form-control" wire:model="searchStockProduct">

            <table>
                <thead>

                </thead>
                <tbody>
                    @foreach ( $stock->products  as $item)
                    <tr>
                        <td>{{ $item }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
