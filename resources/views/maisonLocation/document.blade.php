@extends("layouts.app")


@section("content")
<div>
    @include("maisonLocation._header")

    <div>
        <form action="" class="form-inline">
            <div class="mr-2 mb-2 form-group">
                <label for="customerName">SHOP </label>
                <input type="text" class="form-control" name="customerName" placeholder="SHOP ">
            </div>

            <div class="mr-2 mb-2 form-group">
                <label for="shop_letter">SHOP LETTER</label>
                <select name="shop_letter" id="" class="form-control">
                    <option value=""></option>
                    <option value="TOUS">TOUS</option>
                    @foreach ($lettres as  $letter)
                    <option value="{{ $letter }}">{{ $letter }}</option>
                    @endforeach
                </select>
            </div>



            <button type="submit" class="mb-2 ml-2 btn btn-primary">Afficher</button>
        </form>

    </div>


</div>
@stop
