@extends('layouts.app')
@section('content')
<div class="vente-page">
    @include('ventes._header')
    @livewire('ventes.service-vente')
</div>
@stop

@section('javascript')
<script>
    const loadingClients = async () => {
        try {
            return await fetch('{{ route('getClient', 'ALL') }}').then(res => res.json());
        } catch (err) {
            return [];
        }
    };

    $(document).ready(async function () {
        const clients = await loadingClients();
        if (!Array.isArray(clients) || !clients.length) {
            return;
        }

        const currentClients = clients.map(client =>
            `${client.name} |TEL :  ${client.telephone ?? ""} | NIF: ${client.customer_TIN ?? ""}  |#${client.id}`
        );

        function selectClient(event, ui) {
            event.preventDefault();

            const id = ui.item.value.split('|#')[1];
            const client = clients.find(item => String(item.id) === String(id));

            $("#chercherClientService").val(client ? client.name : ui.item.value);

            const root = document.getElementById('service-vente-root');
            const livewireId = root ? root.getAttribute('wire:id') : null;

            if (livewireId && window.Livewire) {
                window.Livewire.find(livewireId).call('selectClient', id);
            }
        }

        $("#chercherClientService").autocomplete({
            source: currentClients,
            minLength: 1,
            select: selectClient
        });
    });
</script>
@endsection
