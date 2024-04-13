
@extends('layouts.app')

@section('content')
@include('users._header_config')

<div>
    <div class="border  border-white  ">
        <a href="{{ route('export_model_product') }}">Télécharger le model pour les produits de stock</a>
    </div>


    <div>
        <form id="data" method="post" enctype="multipart/form-data">
            @csrf
            <input name="file" type="file" />
            <button>Submit</button>
        </form>
    </div>

    <div id="readed_file">

    </div>
</div>
@endsection

@section('javascript')
<script>
    $(document).ready(function(){
        $("form#data").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: '{{ route('import_data') }}',
                type: 'POST',
                data: formData,
                success: function (data) {

                    $("#readed_file").html(data);
                    console.log(data)

                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
    });
</script>
@stop
