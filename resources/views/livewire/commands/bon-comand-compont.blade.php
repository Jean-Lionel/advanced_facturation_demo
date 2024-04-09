<div>
    {{-- Be like water. --}}

    <h1>Je suis en bonne sante </h1>

   <div class="row">
    <div class="col-md-12">
        @if($founisseurs)
            @foreach ($founisseurs as $item)
            <button type="button" class="btn btn-primary">
                 <span class="badge bg-secondary">{{ $item->name }}</span>
                 <span class="badge bg-secondary">{{ $item->telephone }}</span>
              </button>
            @endforeach
        @endif
    </div>
    <div>
        <input type="text" class="form-control" wire:model="search">
    </div>
   </div>
</div>
