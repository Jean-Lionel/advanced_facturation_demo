@extends('layouts.app')
@section('content')
@include('users._header_config')

<div>
    <div class="border  border-white  ">
        <a href="{{ route('export_model_product') }}">Télécharger le model pour les produits de stock</a>
    </div>
    <div class="container" id="error_fields">

    </div>
    <div>
        <form id="data" method="post" enctype="multipart/form-data">
            @csrf
            <input name="file" type="file" />
            <button class="btn btn-info">Visualiser</button>
        </form>
        <div>
            <button class="btn btn-primary" id="validate">Validate</button>
        </div>
        <div>
            <div class="progress" id="progressbar">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
            </div>
        </div>
    </div>

    <div id="readed_file">

    </div>
</div>
@endsection

@section('javascript')
<script>
    $(document).ready(function(){
        var currentFileData = [];
        $("#progressbar").hide();
        $("form#data").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $("#progressbar").show();
            $.ajax({
                url: '{{ route('import_data') }}',
                type: 'POST',
                data: formData,
                success: function (data) {
                    currentFileData = data.items;
                    $("#readed_file").html(data.html);

                    $("#progressbar").hide();
                },
                error: function (data) {
                    $("#readed_file").html(data);
                    console.log(data)
                },
                cache: false,
                contentType: false,
                processData: false,

            });
        });

        $("#validate").on("click", function(e){
            e.preventDefault();
            $("#progressbar").show();
            $.ajax({
                url: '{{ route('save_import_data') }}',
                type: 'POST',

                data: {
                    _token : $('input[name="_token"]').val(),
                    items : currentFileData
                },
                success: function (data) {

                    let ul = `<>
                        <li> TOTAL DES  ENREGISTREMENT  = ${data.count}</li>
                        `
                        for(const item of Object.values(data.response)){
                            ul += `<li> ${JSON.stringify(item)}</li>`
                        }

                        ul += `</ol>`

                        $("#readed_file").html(ul);

                    $("#progressbar").hide();
                },
                error: function (data) {
                    $("#readed_file").html(data);
                    console.log(data)
                    $("#progressbar").hide();
                },
            });
        });
    });
</script>
@stop
