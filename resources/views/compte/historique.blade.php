@extends('layouts.app')

@section('content')
<div class="container">
    @php
        $count = 1;
    @endphp
    <h3 class="text-center mb-4">Historique</h3>
    <table id="historique-table" class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    {{-- <th>Compte ID</th>
                    <th>Client ID</th> --}}
                    <th>Mode de Paiement</th>
                    <th>Titre</th>
                    <th>Montant</th>
                    <th>Description</th>
                    <th>Utilisateur</th>
                    <th>Date de Création</th>
                </tr>
            </thead>
            <tbody>
                @foreach($historiques as $historique)
                <tr>
                    <td>{{ $count }}</td>
                    {{-- <td>{{ $historique->compte_id }}</td>
                    <td>{{ $historique->client_id }}</td> --}}
                    <td>{{ $historique->mode_payement }}</td>
                    <td>{{ $historique->title }}</td>
                    <td>{{ $historique->montant }}</td>
                    <td>{{ $historique->description }}</td>
                    <td>{{ $historique->user->name }}</td>
                    <td>{{ $historique->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                @php
                    $count++;
                @endphp
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#historique-table').DataTable();
        });
    </script>


</div>
</div>

@endsection
