<div>
    {{-- Be like water. --}}
    <div>
        <input type="text" wire:change="searchClient" wire:model="clientName">
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

</div>
