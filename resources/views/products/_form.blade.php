@csrf

<div class="row">

    <div class="col-md-12">
        <h5 class="text-left">Nouveau Produit</h5>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="code_product">CODE DE PRODUIT</label>
            <input type="text" class="form-control {{$errors->has('code_product') ? 'is-invalid' : 'is-valid' }}" id="code_product" name="code_product" value="{{ old('code_product') ?? $product->code_product?? ' ' }}">

            {!! $errors->first('code_product', '<small class="help-block invalid-feedback">:message</small>') !!}

        </div>

    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="name">DESIGNATION</label>
            <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : 'is-valid' }}" id="name" name="name" value="{{ old('name') ?? $product->name?? ' ' }}">

            {!! $errors->first('name', '<small class="help-block invalid-feedback">:message</small>') !!}

        </div>

    </div>

    <div class="col-md-2">

        <div class="form-group">
            <label for="marque">MARQUE</label>
            <input type="text" class="form-control {{$errors->has('marque') ? 'is-invalid' : 'is-valid' }}" id="marque" name="marque" value="{{ old('marque') ?? $product->marque?? ' ' }}">

            {!! $errors->first('marque', '<small class="help-block invalid-feedback">:message</small>') !!}
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="quantite">QUANTITE</label>
            <input type="text" step="any" class="form-control {{$errors->has('quantite') ? 'is-invalid' : 'is-valid' }}" id="quantite" name="quantite" value="0" disabled>
            {!! $errors->first('quantite', '<small class="help-block invalid-feedback">:message</small>') !!}
        </div>
    </div>


    <div class="col-md-2">

        <div class="form-group">
            <label for="unite_mesure">UNITE DE MESURE</label>
            <input type="text" class="form-control {{$errors->has('unite_mesure') ? 'is-invalid' : 'is-valid' }}" id="unite_mesure" name="unite_mesure" value="{{ old('unite_mesure') ?? $product->unite_mesure?? ' ' }}">

            {!! $errors->first('unite_mesure', '<small class="help-block invalid-feedback">:message</small>') !!}
        </div>
    </div>

    <div class="col-md-2">

        <div class="form-group">
            <label for="price_min">PRIX D ACHAT</label>
            <input type="text"
            step="any"
            class="form-control {{$errors->has('price_min') ?  'is-valid' : 'is-invalid'  }}" id="price_min" name="price_min" value="{{ old('price_min') ?? $product->price_min?? ' ' }}">

            {!! $errors->first('price_min', '<small class="help-block invalid-feedback">:message</small>') !!}
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="price_max">PRIX DE REVIENT  TVAC</label>
            <input type="text"
            step="any"
            class="form-control {{$errors->has('price_max') ? 'is-invalid' : 'is-valid' }}" id="price_max" name="price_max" value="{{ old('price_max') ?? $product->price_max?? ' ' }}">
            {!! $errors->first('price_max', '<small class="help-block invalid-feedback">:message</small>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="price">TAUX DE TVA </label>


            <select name="taux_tva" id="taux_tva" class="form-control">
                @foreach (TAUX_TVA as $tva)
                    <option value="{{ $tva }}"
                        @if (old('taux_tva', $product->taux_tva ?? '') == $tva)
                            selected
                        @endif>
                        {{ $tva }}
                    </option>
                @endforeach
            </select>


            {!! $errors->first('taux_tva', '<small class="help-block invalid-feedback">:message</small>') !!}
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="price">PV HTVA </label>
            <input type="text" step="any" class="form-control {{$errors->has('price') ? 'is-invalid' : 'is-valid' }}" id="price" name="price" value="{{ old('price') ?? $product->price?? ' ' }}">
            {!! $errors->first('price', '<small class="help-block invalid-feedback">:message</small>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="price_tvac">PV TVAC </label>
            <input type="text" step="any" class="form-control {{$errors->has('price_tvac') ? 'is-invalid' : 'is-valid' }}" id="price_tvac" name="price_tvac" value="{{ old('price_tvac') ?? $product->price_tvac?? ' ' }}">
            {!! $errors->first('price_tvac', '<small class="help-block invalid-feedback">:message</small>') !!}
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="quantite_alert">QUANTITE MINIMUM</label>
            <input type="number" step="any" class="form-control {{$errors->has('quantite_alert') ? 'is-invalid' : 'is-valid' }}" id="quantite_alert" name="quantite_alert" value="{{ old('quantite_alert') ?? $product->quantite_alert?? ' ' }}">
            {!! $errors->first('quantite_alert', '<small class="help-block invalid-feedback">:message</small>') !!}
        </div>
    </div>


    <div class="col-md-3">
        <div class="form-group">
            <label for="date_expiration">{{ "DATE D'EXPIRATION"  }}</label>
            <input type="date" class="form-control {{$errors->has('date_expiration') ? 'is-invalid' : 'is-valid' }}" id="date_expiration" name="date_expiration" value="{{ old('date_expiration') ?? $product->date_expiration?? ' ' }}">
            {!! $errors->first('date_expiration', '<small class="help-block invalid-feedback">:message</small>') !!}
        </div>
    </div>


    <div class="col-md-3">

        <div class="form-group">
            <label for="category_id">CATEGORIE</label>
            <select name="category_id" id="" class="form-control {{$errors->has('category_id') ? 'is-invalid' : 'is-valid' }}">

                <option value="{{ $product->category_id ??""  }}">

                    {{ $product->category->title ?? "" }}
                </option>

                @foreach ($categories as $element)
                {{-- expr --}}
                <option value="{{$element->id}}">{{$element->title}}</option>
                @endforeach
            </select>
            {!! $errors->first('category_id', '<small class="help-block invalid-feedback">:message</small>') !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="description">Spécification techinque</label>
            <textarea name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' :'' }}" cols="30" >{{ old('description') ?? $product->description ?? "" }}</textarea>
            {!! $errors->first('description', '<small class="help-block invalid-feedback">:message</small>') !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for=""></label>
            <input type="submit" value="{{ $btnMessage ?? 'Enregitrer' }}" class="form-control btn-primary">
        </div>
    </div>

</div>


@section('javascript')
<script>
    const ARRONDIR_RESULTAT = "{{ ARRONDIR_RESULTAT }}";
    $(document).ready( function () {
       const tva = document.querySelector('#taux_tva');
       const price_tvac  = document.querySelector('#price_tvac');
       const price = document.querySelector('#price');

       price_tvac.addEventListener('input', function(e){
          price.value = prixVenteHorsTva(price_tvac.value, (tva.value / 100))
       })

       tva.addEventListener('input', function(e){
           price_tvac.value = prixVenteTvac(price.value ,(tva.value / 100))
           price.value = prixVenteHorsTva(price_tvac.value, (tva.value / 100))
       })

       price.addEventListener('input', function(e){
           price_tvac.value = prixVenteTvac(price.value ,(tva.value / 100))
       })
    })

    function prixVenteHorsTva(price, taux = 0.18){
        const res = price / (1 + taux );
        return ARRONDIR_RESULTAT ? res.toFixed(2) : Math.round(price / (1 + taux ));
    }

    function prixVenteTvac(price, taux){
        const res = price * (1 + taux );
        return ARRONDIR_RESULTAT ? res.toFixed(2) : Math.round(price * (1 + taux ));
    }

</script>
@append
