<div>
    {{-- The whole world belongs to you. --}}

    <div class="card">
        <h4>Facturation des Services</h4>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Déscription</th>
                <th>Quantité</th>
                <th>Prices</th>
                <th>Taxes</th>
                <th>Prix HTVA</th>
                <th>Prix Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $table_length as $key )
            <tr>
                <td>
                    <input type="text" wire:model="description.{{ $key }}">
                </td>
                <td>
                    <input type="text">
                </td>
                <td>
                    <input type="text">
                </td>
                <td>
                    <input type="text">
                </td>
                <td>5</td>
                <td>5</td>
                <td>
                    <button class="btn btn-danger" wire:click="removeItem({{  $key }})">
                        <span class="fa fa-trash"></span>
                    </button>
                </td>
            </tr>
          @endforeach
            <tr>
                <td colspan="6"></td>
                <td>
                    <button class="btn btn-sm btn-primary"
                    wire:click="addColumn"
                    >
                        <span class="fa fa-plus"></span>
                        Ajouter </button>

                    <button class="btn btn-sm btn-primary"
                    wire:click="saveValue"
                    >
                        <span class="fa fa-file"></span>
                        Save </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
