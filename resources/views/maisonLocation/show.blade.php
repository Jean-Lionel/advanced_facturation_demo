
    @extends('layouts.app')

    @section('content')
    @include('maisonLocation._header')
      <div class="row">
        <div class="col-4">
        
            <div class="card" style="width:18rem;">
              
              <div class="card-body">
                <h5 class="card-title">
                  NOM :   {{  $maisonLocation->name ?? "" }}
                </h5>
                <h6 class="card-subtitle mb-2 text-muted ">
                  PRIX :   {{ getPrice($maisonLocation->montant) }}
                </h6>
                <p class="card-text"> {{ $maisonLocation->description }}</p>
                b5
              </div>
            </div>
        </div>
        <div class="col-8">
            @livewire('location.add-client', [
                'maison_id' => $maisonLocation->id
            ])
        </div>
      </div>
    @endsection

