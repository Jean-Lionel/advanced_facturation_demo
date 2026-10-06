<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}

    PRICE EST {{ $price }}
    <div class="pb-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">

          <!-- Shopping cart table -->
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col" class="border-0 bg-light">
                    <div class="p-2 px-3 text-uppercase">Product</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="p-2 px-3 text-uppercase">MARGE DES PRIX ( #FBU)</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">

                    <div class="p-2 px-3">
                      PRIX UNITAIRE
                    </div>



                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">PRIX</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">QUANTITE</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">SUPPRIMMER</div>
                  </th>
                </tr>
              </thead>
              <tbody>


                @foreach ($products as $product)
                {{-- expr --}}

                <tr>
                  <th scope="row" class="border-0">
                    {{$product->name}}
                  </th>

                   <th scope="row" class="border-0">
                    {{getPrice($product->model->price_min) . ' - '. getPrice($product->model->price_max)}}

                  </th>

                  <th>

                    <input type="number" wire:keydown="changePrice({{ $product->rowId  }})" class="price_input"  value="{{ $product->price }}" class="form-control">

                  </th>

                  <th>
                    {{ getPrice($product->subtotal())  }}
                  </th>

                  <td class="border-0 align-middle">

                   <select name="qty" id="qty" class="quantite quantite_select" data-id="{{ $product->rowId }}" class="custom-select">
                     @for ($i = 1; $i <=$product->model->quantite ; $i++)

                     {{-- expr --}}
                     <option value="{{ $i }}" {{ ($i == $product->qty) ? 'selected':'' }}>{{ $i }}</option>
                     @endfor
                   </select>
                 </td>
                 <td class="border-0 align-middle">

                   <form action="{{ route('cart.destroy',$product->rowId) }}" method="post">
                     @csrf
                     @method('DELETE')
                     <button type="submit" ><i class="fa fa-trash"></i></button>
                   </form>

                 </td>
               </tr>
               @endforeach

             </tbody>
           </table>
         </div>
         <!-- End -->
       </div>
     </div>

     <div class="row py-5 p-4 bg-white rounded shadow-sm">
      <div class="col-lg-6">
        <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">INFORMATION DU CLIENT</div>
        <div class="p-1">

         <form action="{{ route('payement') }}" method="post">
          @csrf

          @method('post')

          <div class="form-group">
            <input required="" type="text" name="name" value="{{ old('name') }}" placeholder="Entrer le nom ici" aria-describedby="button-addon3" class="form-control border-2">



         </div>

         <div class="form-group">
           <input type="text" name="telephone" placeholder="Entrer le numéro du téléphone" aria-describedby="button-addon3" class="form-control border-2">
         </div>


          @php
            $useCredit = filter_var(env('APP_USE_CREDIT', false), FILTER_VALIDATE_BOOLEAN);
            $cartTotal = Cart::total(0, '.', '');
            $oldTypePaiement = old('type_paiement');
            $oldMontantPaye = old('montant_paye');
            $oldMontantRestant = old('montant_restant');
            $useBanque = filter_var(env('APP_USE_BANQUE', false), FILTER_VALIDATE_BOOLEAN);
            $oldBanqueId = old('banque_id');

            if ($oldMontantPaye === null && $oldMontantRestant !== null) {
              $oldMontantPaye = max(0, (float) $cartTotal - (float) $oldMontantRestant);
            }

            $oldMontantPaye = $oldMontantPaye ?? 0;
            $montantRestant = max(0, (float) $cartTotal - (float) $oldMontantPaye);
          @endphp

          <div class="form-group">
            <label for="type_paiement">MODE DE PAIEMENT</label>
           <select required="" class="form-control" name="type_paiement" id="type_paiement_card_vente">
             <option value="">Choisissez ...</option>
             <option value="1" {{ in_array($oldTypePaiement, ['1', 'CACHE']) ? 'selected' : '' }}>EN CACHE</option>
             <option value="3" {{ in_array($oldTypePaiement, ['3', 'DETTE']) ? 'selected' : '' }}>CREDIT</option>
	           </select>
	         </div>

         @if ($useBanque)
         <div class="form-group">
           <label for="banque_id_card_vente">BANQUE</label>
           <select  class="form-control" name="banque_id" id="banque_id_card_vente">
             <option value="">Choisissez ...</option>
             @foreach ($banques as $banque)
               <option value="{{ $banque->id }}" {{ (string) $oldBanqueId === (string) $banque->id ? 'selected' : '' }}>
                 {{ $banque->display_name }}
               </option>
             @endforeach
           </select>
         </div>
         @endif

         @if ($useCredit)
         <div id="montant_restant_card_vente_group" style="display: {{ in_array($oldTypePaiement, ['3', 'DETTE']) ? 'block' : 'none' }};">
          <div class="form-group">
            <label for="montant_paye_card_vente">MONTANT PAYE</label>
            <input type="number"
                   min="0"
                   max="{{ $cartTotal }}"
                   step="0.01"
                   name="montant_paye"
                   id="montant_paye_card_vente"
                   value="{{ $oldMontantPaye }}"
                   class="form-control border-2">
          </div>
          <input type="hidden"
                 name="montant_restant"
                 id="montant_restant_card_vente"
                 value="{{ old('montant_restant', $montantRestant) }}">
          <p class="text-muted">
            MONTANT RESTANT A PAYER :
            <b id="montant_restant_card_vente_text">{{ getPrice($montantRestant) }}</b>
          </p>
         </div>
         @endif

         <button type="submit" class="btn btn-dark rounded-pill py-2 btn-block">Valider</button>
       </form>


        {{--  <div class="input-group mb-4 border rounded-pill p-2">
          <input type="text" placeholder="Apply coupon" aria-describedby="button-addon3" class="form-control border-0">
          <div class="input-group-append border-0">
            <button id="button-addon3" type="button" class="btn btn-dark px-4 rounded-pill"><i class="fa fa-gift mr-2"></i>Enregistrer</button>
          </div>
        </div> --}}
      </div>
      <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Instructions pour le client</div>


    </div>
    <div class="col-lg-6">
      <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Déscription  </div>
      <div class="p-4">

        <ul class="list-unstyled mb-4">
          <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">PHTVA </strong><strong>{{getPrice(Cart::subtotal())}}</strong></li>

          <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">TVA</strong><strong>{{ getPrice(Cart::tax()) }}</strong></li>
          <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total</strong>
            <h5 class="font-weight-bold">{{ getPrice(Cart::total()) }}</h5>
          </li>
        </ul>



      </div>
    </div>
  </div>
</div>

@if ($useCredit)
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var typePaiement = document.getElementById('type_paiement_card_vente');
    var montantRestantGroup = document.getElementById('montant_restant_card_vente_group');
    var montantPayeInput = document.getElementById('montant_paye_card_vente');
    var montantRestantInput = document.getElementById('montant_restant_card_vente');
    var montantRestantText = document.getElementById('montant_restant_card_vente_text');
    var cartTotal = Number('{{ $cartTotal }}');

    if (!typePaiement || !montantRestantGroup || !montantPayeInput || !montantRestantInput || !montantRestantText) {
      return;
    }

    function updateMontantRestant() {
      var montantPaye = Number(montantPayeInput.value || 0);

      if (montantPaye < 0) {
        montantPaye = 0;
      }

      if (montantPaye > cartTotal) {
        montantPaye = cartTotal;
      }

      montantPayeInput.value = montantPaye;
      var montantRestant = Math.max(0, cartTotal - montantPaye);
      montantRestantInput.value = montantRestant.toFixed(2);
      montantRestantText.textContent = montantRestant.toLocaleString('fr-FR') + ' #FBU';
    }

    function toggleMontantRestant() {
      var isCredit = typePaiement.value === '3' || typePaiement.value === 'DETTE';
      montantRestantGroup.style.display = isCredit ? 'block' : 'none';
      montantPayeInput.required = isCredit;
      montantPayeInput.disabled = !isCredit;
      montantRestantInput.disabled = !isCredit;

      if (isCredit) {
        updateMontantRestant();
      }
    }

    typePaiement.addEventListener('change', toggleMontantRestant);
    montantPayeInput.addEventListener('input', updateMontantRestant);
    toggleMontantRestant();
  });
</script>
@endif
