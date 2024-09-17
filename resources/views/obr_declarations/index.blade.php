@extends('layouts.app')
@section('content')
<div>
    @include('entreprises.header')
    <div class="row">
        <div class="col-6">
            <button class="btn btn-sm btn-primary" id="btn_syncronize">
                <i class="fa fa-recycle"></i> Sycnronize</button>
            <div id="loader_file">
                <div class="spinner-border text-success" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>
            </div>
        </div>
        <div class="col-6">
            <h5>Facture en attente</h5>
        </div>
    </div>
    
    <table class="table table-bordered tab-content table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>Client</th>
                <th>Montant</th>
                <th>Tax</th>
                <td>Product</td>
                <td>Date</td>
                <td>Motif </td>
                <td>Erreur Externe </td>
                <td>Status</td>
                <th>
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            {{-- expr --}}
            <tr>
                <td>{{$order->id}}</td>
                <td>{{ $order->client->name ?? "" }}</td>
                <td>{{ $order->amount }}</td>
                <td>{{ $order->tax }}</td>
                <td>
                    <ul>
                        <li  class="d-flex justify-content-between">
                            <b>Désignation</b>
                            <b>qté</b>
                            <b>Prix</b>
                        </li>
                        @foreach ($order->products as $element)
                        {{-- expr --}}
                        <li class="d-flex justify-content-between">
                            <span>{{ $element['name'] }}</span>
                            <span>{{ $element['quantite'] }}</span>
                            <span>{{ $element['price'] }}</span>
                        </li>
                        <small>{{ $order->invoice_signature }}</small>
                        @endforeach
                    </ul>
                </td>
                <td>{{ $order->created_at }}</td>
                <td class="bg-warning">
                    @if (!isset($order->obrPointer->msg))
                    <span  >Verfié si vous avez une connection internet </span>
                    @endif
                </td>
                <td>
                    {{ $order->obrPointer->msg ?? "" }}
                </td>
                <td @if ( $order->canceled_or_connection)
                    class="bg-danger"
                    @endif>
                    {{  $order->canceled_or_connection }} </td>
                    <td>
                        <a href="{{ route('orders.show', $order->id)}}">Afficher</a>
                        <div id="button_{{$order->id}}">
                            @if ( ! $order->canceled_or_connection)
                            <button  onclick="cancelIncome('{{$order->invoice_signature}}', {{$order->id}})">Annuler</button>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @stop
    
    @section('javascript')
    
    <script>

        $('#loader_file').hide();

        $("#btn_syncronize").on("click", function(){
            $('#loader_file').show();
            $.ajax({
                url: "{{ route('syncronizeInvoices') }}",
                type: 'GET',
                data: {},
                success: function(data){
                    alert("Success!");
                    $('#loader_file').hide();
                },
                error: function(data){
                    alert("Success!");
                    console.log(data);
                    $('#loader_file').hide();
                }
            })
        });
        function getMotif(){
            let motif = prompt("Quel est le motif d'annulation de cet Facture ? ")
            if(motif == null) return;
            if(motif.trim() == ""){
                alert("La facture n  a pas ete anuler ajouter le motif");
                return  getMotif();
            }
            return motif;
        }
        
        function cancelIncome(invoice_signature, order_id){
            let motif = getMotif();
            let cancel_amount = 0;
            if(motif){
                cancel_amount = confirm('Voulez aussi faire le retour des Marchandises en Stock');
            }
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            
            $("#order_"+order_id).html(`<div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
            </div>`)
                $.ajax({
                    url: 'cancelInvoice',
                    type: 'post',
                    data: {
                        invoice_signature :invoice_signature,
                        _token: CSRF_TOKEN,
                        order_id: order_id,
                        motif : motif,
                        cancel_amount : cancel_amount,
                        internet_connection : 'NON_INTERNET',
                    },
                    success: function (data) {
                        console.log(data);
                        $("#button_"+order_id).html(`
                    <span class="bg-warning">${data.msg} </span>
                    `)
                    }
                });
            }
            function sendInvoice(invoince_id){
                $("#button_"+invoince_id).html(`
            <div  class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            `)
                
                $.ajax({
                    url: 'sendInvoinceToObr/'+invoince_id,
                    type: 'get',
                    success: function (data) {
                        console.log(data)
                        $("#button_"+invoince_id).html(`
                    <div class="${data.success ? 'bg-primary' :'bg-danger'}"> ${data.msg}</div>
                    `)
                    }
                });
            }
        </script>
        
        @stop
        