<div>
    <div class="row">
        
        @include('shared.input',[
        'type' => 'text',
        'name' => 'name',
        'label' => 'Nom',
        'class' => 'col-4'
        ])
        
        @include('shared.input',[
        'type' => 'number',
        'name' => 'montant',
        'class' => 'col-2'
        ])
        
        @include('shared.input',[
        'type' => 'text',
        'name' => 'description',
        'class' => 'col-4'
        ])

        <div  class="mb-3 form-group">
            <label for="">PRIX DE TVA</label>
            <select name="" id="" class="form-control form-control-sm">
                <option value=""></option>
                @foreach (TVA_RANGES as $taux)
                    <option value="{{  $taux }}">{{ $taux }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-3">
            <label for=""></label>
            <button type="submit" class="btn btn-primary form-control">Enregistrer</button>
        </div>
        
        
        
    </div>
</div>