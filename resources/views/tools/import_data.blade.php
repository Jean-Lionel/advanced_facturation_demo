@extends('layouts.app')

@section('content')
<div class="app-page">
    @include('users._header_config')

    <div class="app-card mb-3">
        <header class="app-card-header">
            <h2 class="app-card-heading">Importation Excel</h2>
            <div class="app-toolbar-actions">
                <a href="{{ route('export_model_product') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-download"></i> Télécharger le modèle
                </a>
            </div>
        </header>

        <div class="app-card-body">
            <div id="error_fields" class="mb-3"></div>

            <form id="data" method="post" enctype="multipart/form-data">
                @csrf
                <div class="app-form-grid">
                    <div class="form-group mb-0">
                        <label for="import_file">Fichier Excel</label>
                        <div class="custom-file">
                            <input
                                type="file"
                                class="custom-file-input"
                                id="import_file"
                                name="file"
                                accept=".xlsx,.xls,.csv"
                                required
                            >
                            <label class="custom-file-label" for="import_file" data-browse="Parcourir">
                                Choisir un fichier...
                            </label>
                        </div>
                    </div>
                    <div class="form-group mb-0 d-flex align-items-end">
                        <div class="app-form-actions mt-0 border-0 pt-0">
                            <button type="submit" class="btn btn-primary btn-sm">Visualiser</button>
                            <button type="button" class="btn btn-outline-secondary btn-sm" id="validate">Valider</button>
                        </div>
                    </div>
                </div>
            </form>

            <div class="progress mt-3" id="progressbar" style="height: 8px;">
                <div
                    class="progress-bar progress-bar-striped progress-bar-animated"
                    role="progressbar"
                    aria-valuenow="100"
                    aria-valuemin="0"
                    aria-valuemax="100"
                    style="width: 100%; background-color: var(--app-primary, #5c3fd8);"
                ></div>
            </div>
        </div>
    </div>

    <div class="app-card">
        <header class="app-card-header">
            <h2 class="app-card-heading">Aperçu des données</h2>
        </header>
        <div class="app-card-body--flush">
            <div id="readed_file">
                <p class="text-muted text-center py-4 mb-0">
                    Aucun fichier chargé. Choisissez un fichier puis cliquez sur Visualiser.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
    $(document).ready(function () {
        var currentFileData = [];
        $("#progressbar").hide();

        $(".custom-file-input").on("change", function () {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName || "Choisir un fichier...");
        });

        $("form#data").submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $("#progressbar").show();

            $.ajax({
                url: '{{ route('import_data') }}',
                type: 'POST',
                data: formData,
                success: function (data) {
                    currentFileData = data.items;
                    $("#readed_file").html(
                        '<div class="app-table-wrap">' + data.html + '</div>'
                    );
                    $("#progressbar").hide();
                },
                error: function (data) {
                    $("#readed_file").html(
                        '<div class="p-3 text-danger">Erreur lors de la lecture du fichier.</div>'
                    );
                    console.log(data);
                    $("#progressbar").hide();
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });

        $("#validate").on("click", function (e) {
            e.preventDefault();

            if (!currentFileData.length) {
                alert("Veuillez d'abord visualiser un fichier.");
                return;
            }

            $("#progressbar").show();
            $.ajax({
                url: '{{ route('save_import_data') }}',
                type: 'POST',
                data: {
                    _token: $('input[name="_token"]').val(),
                    items: currentFileData
                },
                success: function (data) {
                    let html = `
                        <div class="p-3">
                            <p class="app-meta mb-2">
                                Total des enregistrements : <b>${data.count}</b>
                            </p>
                            <ul class="mb-0 pl-3">
                    `;

                    for (const item of Object.values(data.response)) {
                        html += `<li><small>${JSON.stringify(item)}</small></li>`;
                    }

                    html += `
                            </ul>
                        </div>
                    `;

                    $("#readed_file").html(html);
                    $("#progressbar").hide();
                },
                error: function (data) {
                    $("#readed_file").html(
                        '<div class="p-3 text-danger">Erreur lors de la validation.</div>'
                    );
                    console.log(data);
                    $("#progressbar").hide();
                }
            });
        });
    });
</script>
@stop
