<>
    {{-- Be like water. --}}
    
    <div class="row">
       
        <div class="col">
            <label for="startDate">Du</label>
            <input type="date" wire:model="startDate" id="startDate" class="form-control form-control-sm">
        </div>
        <div class="col">
            <label for="endDate">Au</label>
            <input type="date" wire:model="endDate" id="endDate" class="form-control form-control-sm">
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
    </div>
</div>
