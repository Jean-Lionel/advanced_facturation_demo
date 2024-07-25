<div>
    {{-- Be like water. --}}
    <div class="row">
        <div wire:loading>
            @livewire('loading.checkout')
          </div>
    </div>
    <div>
        <div class="row">
            <p class="col-6">
                <input type="text" class="form-control form-control-sm " wire:change="searchClient" wire:model="clientName">
            </p>
            <p class="col-6">Rechercher le client Assossier </p>
            
        </div>
        <div>
            @if (count($searchableClients) )
            @foreach ($searchableClients as $item)
            <div class="d-flex justify-between gap-3 display-6">
                <div>{{++$loop->index }}</div>
                <div class="badge badge-info m-1">{{ $item->name }}</div>
                <div class="badge badge-info m-1"> TEL :  {{ $item->telephone }}</div>
                <div class="badge badge-info m-1">NIF:  {{ $item->customer_TIN }}</div>
                <div class="badge badge-info m-1">{{ $item->addresse }}</div>
                <div>
                    <button class="btn btn-danger btn-sm" wire:click="addClientToMaison({{$item->id  }})">
                        <i class="fa fa-add"></i>
                        Ajouter
                    </button>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
    
    <div>
        @if ($clients)
        <h4 class="text-center">Liste des clients </h4>
        <div
        class="table-responsive"
        >
        <table
        class="table table-hover table-striped "
        >
        <thead>
            <tr>
                <th>#</th>
                <th scope="col">NOM</th>
                <th scope="col">NIF</th>
                <th scope="col">TELEPHONE</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach ($clients as $item)
            <tr class="">
                <td>{{ ++$loop->index }}</td>
                <td scope="row">{{ $item->client?->name }}</td>
                <td scope="row">{{ $item->client?->customer_TIN }}</td>
                <td scope="row">{{ $item->client?->telephone }}</td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>

@endif
</div>

</div>
