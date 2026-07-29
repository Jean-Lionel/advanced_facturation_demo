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
            @endphp

            <div class="form-group">
                <label for="type_paiement_cart_vente">MODE DE PAIEMENT</label>
                <select required class="form-control" name="type_paiement" id="type_paiement_cart_vente">
                    <option value="">Choisissez ...</option>
                    @foreach (TYPE_PAYMENT as $key => $label)
                        @if ((int) $key !== 3 || $useCredit)
                            <option value="{{ $key }}" {{ (string) $oldTypePaiement === (string) $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>

            @if ($useCredit)
                <div class="form-group" id="montant_restant_cart_vente_group" style="display: {{ (string) $oldTypePaiement === '3' ? 'block' : 'none' }};">
                    <label for="montant_restant_cart_vente">MONTANT RESTANT A PAYER</label>
                    <input type="number"
                           min="0"
                           max="{{ $cartTotal }}"
                           step="0.01"
                           name="montant_restant"
                           id="montant_restant_cart_vente"
                           value="{{ old('montant_restant', $cartTotal) }}"
                           class="form-control">
                </div>
            @endif
        </div>
    </div>

    @if ($useCredit)
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var typePaiement = document.getElementById('type_paiement_cart_vente');
                var montantRestantGroup = document.getElementById('montant_restant_cart_vente_group');
                var montantRestantInput = document.getElementById('montant_restant_cart_vente');
                var cartTotal = '{{ $cartTotal }}';

                if (!typePaiement || !montantRestantGroup || !montantRestantInput) {
                    return;
                }

                function toggleMontantRestant() {
                    var isCredit = typePaiement.value === '3';
                    montantRestantGroup.style.display = isCredit ? 'block' : 'none';
                    montantRestantInput.required = isCredit;

                    if (isCredit && !montantRestantInput.value) {
                        montantRestantInput.value = cartTotal;
                    }
                }

                typePaiement.addEventListener('change', toggleMontantRestant);
                toggleMontantRestant();
            });
        </script>
    @endif
</div>
