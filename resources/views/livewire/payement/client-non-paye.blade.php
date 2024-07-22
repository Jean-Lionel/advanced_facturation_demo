<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    
    <div>
        <select wire:model="periodeID" id="" class="form-control form-control-sm">
            
            @foreach ($periodeList as $item)
            <option value="{{ $item->id }}"> {{ $item->periode }}</option>
            @endforeach
        </select>
    </div>
    @if ($curentNonPay)
    <table class="table  ">
        <thead>
            <tr>
                <th>ID</th>
                <th>Maison </th>
                <th>Locataire</th>
        
            </tr>
        </thead>
        <tbody>
            @foreach ($curentNonPay as  $item)
            <tr>
                <td>{{  ++ $loop->index}}</td>
                <td>{{  $item->name }}</td>
                <td>
                    @foreach ($item->clients as $c)
                    <p>
                        {{ $c->name }} TEL : {{ $c->telephone}}
                    </p>
                    @endforeach
                </td>
                <td>
                    {{ $item->periode }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
