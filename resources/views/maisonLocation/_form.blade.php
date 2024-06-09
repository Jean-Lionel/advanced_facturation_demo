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
        <div class="form-group col-3">
            <label for=""></label>
            <button type="submit" class="btn btn-primary form-control">Enregistrer</button>
        </div>
        
        
        
    </div>
</div>