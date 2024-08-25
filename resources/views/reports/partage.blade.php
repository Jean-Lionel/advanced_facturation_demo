@extends('layouts.app')

{{-- Stocke Controller Journal --}}

@section('content')

@if(USE_ABONEMENT)
@include('journals._header_file')
@endif


        {{-- <table class="table table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>NUMERO DE FACTURE</th>
                    <th>COMMISSIONNAIRE</th>
                    <th>CLIENT</th>
                    <th>INTERET TOTAL</th>
                    <th>PARTAGE DES INTERET </th>
                    <th>DATE</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($interets as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->order_id }}</td>
                    <td>{{ $item->commisionnaire()?->name }}</td>
                    <td>{{ $item->client()?->name }}</td>
                    <td class="text-right">{{ $item->montant }}</td>
                    <td style="width: 200px;">
                        <ul>
                            @foreach ($item->interet as $key => $element )
                           <li class="d-flex justify-content-between">
                             <span>{{ $key }}</span> &nbsp; &nbsp;   <b>{{ $element }}</b> </li>
                        @endforeach
                        </ul>

                    </td>
                    <td>{{ $item->created_at}}</td>
                </tr>
                @endforeach
            </tbody>
        </table> --}}

        <div class="row">
            <div class="col-lg-8 col-md-12">
                <table id="interet" class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NUMERO DE FACTURE</th>
                            <th>COMMISSIONNAIRE</th>
                            <th>CLIENT</th>
                            <th>INTERET TOTAL</th>
                            <th>PARTAGE DES INTERET </th>
                            <th>DATE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($interets as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->order_id }}</td>
                            <td>{{ $item->commisionnaire()?->name }}</td>
                            <td>{{ $item->client()?->name }}</td>
                            <td class="text-right">{{ $item->montant }}</td>
                            <td style="width: 200px;">
                                <ul>
                                    @foreach ($item->interet as $key => $element )
                                   <li class="d-flex justify-content-between">
                                     <span>{{ $key }}</span> &nbsp; &nbsp;   <b>{{ $element }}</b> </li>
                                @endforeach
                                </ul>

                            </td>
                            <td>{{ $item->created_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4 col-md-12">
                <h4>Résumé des Partages</h4>

                <table class="table table-striped">
                    <tr>
                        <th>Entreprise</th>
                        <th>{{ $entrepriseTotal }}</th>
                    </tr>
                </table>
                <table class="table table-striped">
                    <tr>
                        <th>Informaticien</th>
                        <th >{{ $informaticienTotal }}</th>
                    </tr>
                </table>
                <h5>Commissionnaires</h5>
                <table class="table table-striped">
                        @foreach($commissionnaireTotals as $id => $total)
                            <tr>
                                <td>{{ $commissionnairesData[$id] ?? 'Inconnu' }}</td>
                                <td>{{ $total }}</td>
                            </tr>
                        @endforeach
                </table>
                <h5>Les  Client</h5>
                <table id="clients" class="table table-striped">

                        @foreach($clientTotals as $id => $total)
                            <tr>
                                <td>{{ $clientsData[$id] ?? 'Inconnu' }}</td>
                                <td>{{ $total }}</td>
                            </tr>
                        @endforeach
                </table>


            </div>

        </div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#interet').DataTable({
                "pageLength": 5
            });
        });

    </script>
@endsection
