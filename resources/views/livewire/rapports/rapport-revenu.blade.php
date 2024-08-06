<div>
{{-- Be like water. --}}
<div class="row">
    <div wire:loading>
        @livewire('loading.checkout')
      </div>
</div>
<div class="row">
    <div class="col">
        <label >Du</label>
        <input type="date" wire:model="startDate"  class="form-control form-control-sm">
    </div>
    <div class="col">
        <label >Au</label>
        <input type="date" wire:model="endDate" class="form-control form-control-sm">
    </div>
    <div class="col">
        <label for="">-</label>
        <button  class=" btn btn-primary form-control form-control-sm">OK</button>
    </div>
</div>

<div>
    <h1>
        Revenue du {{ $startDate}} au {{$endDate  }}
    </h1>
    @if ($revenues)
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>### </th>
                <th>Montant</th>
            </tr>
        </thead>
        <tbody>    
            @foreach($revenues as $key => $revenue)
            <tr>
                <td>{{ $key }}</td>
                <td>{{ $revenue }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
</div>

</div>