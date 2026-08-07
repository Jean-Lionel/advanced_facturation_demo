<div>
    {{-- Stop trying to control. --}}
    <style>
        .cart{
            display: block;
            border: 1px solid #123;
            box-shadow: 0 5px 15px 0 hsla(0, 0%,0%, 0,15);
        }
    </style>
    <div class="row">
        <div wire:loading>
            @livewire('loading.checkout')
          </div>
    </div>

    <div class="row">
        <div class="col-md-2">

            <div class="cart ">
                <div class="head">
                    <h5 class="text-center">Nom de l'article</h5>
                    <h6 class="text-sm text-center">Catégorie</h6>
                </div>
                <div>
                    <img src="" alt="">
                </div>
                <div class="d-flex justify-content-between">
                    <div>Qté en stock</div>
                    <div class="d-flex justify-content-between">

                        <button>-</button>
                        <input type="text" style="width:50px;">
                        <button>+</button>
                    </div>


                </div>

                <div>Ajouter</div>
            </div>
        </div>
        <div class="col-md-6">
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
                <label for="type_paiement_cart_vente">MODE DE PAIEMENT</label>
                <select required class="form-control" name="type_paiement" id="type_paiement_cart_vente">
                    <option value="">Choisissez ...</option>
                    @foreach (TYPE_PAYMENT as $key => $label)
                        <option value="{{ $key }}" {{ (string) $oldTypePaiement === (string) $key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            @if ($useBanque)
                <div class="form-group">
                    <label for="banque_id_cart_vente">BANQUE</label>
                    <select  class="form-control" name="banque_id" id="banque_id_cart_vente">
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
                <div id="montant_restant_card_vente_group" style="display: {{ (string) $oldTypePaiement === '3' ? 'block' : 'none' }};">
                    <div class="form-group">
                        <label for="montant_paye_card_vente">MONTANT PAYE</label>
                        <input type="number"
                               min="0"
                               max="{{ $cartTotal }}"
                               step="0.01"
                               name="montant_paye"
                               id="montant_paye_card_vente"
                               value="{{ $oldMontantPaye }}"
                               class="form-control">
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
        </div>
    </div>

    @if ($useCredit)
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var typePaiement = document.getElementById('type_paiement_cart_vente');
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
                    var isCredit = typePaiement.value === '3';
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
</div>
