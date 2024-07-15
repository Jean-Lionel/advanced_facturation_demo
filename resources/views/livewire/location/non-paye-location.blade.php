<div>
    {{-- Success is as dangerous as failure. --}}

    <div class="row my-2">
        <input type="date" class="form-control mr-3 col-1" wire:model='startDate'>
        <input type="date" class="form-control mr-3 col-1" wire:model='endDate'>
        <button type="submit" class="btn btn-outline-primary" wire:model='searchDate'>OK</button>
    </div>
    <div
        class="table-responsive"
    >
        <table
            class="table"
        >
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Montant</th>
                    <th scope="col">Description</th>
                    <th scope="col">Client</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($nonpays as $nonpay)
                    <tr class="">
                        <td scope="row">{{ $nonpay->id }}</td>
                        <td>{{ $nonpay->name }}</td>
                        <td>{{ $nonpay->montant }}</td>
                        <td>{{ $nonpay->description }}</td>
                        <td>
                            <ol>
                                @foreach ($nonpay->clients as $client)
                                    <li>
                                        Nom : {{ $client->name }} <br>
                                        Télephone: {{ $client->telephone}}
                                    </li>
                                @endforeach
                            </ol>
                        </td>
                    </tr>
               @endforeach

            </tbody>
        </table>
        {{ $nonpays->links() }}
    </div>

</div>
