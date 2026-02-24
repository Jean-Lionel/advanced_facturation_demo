<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\FollowProduct;
use App\Models\ObrMouvementStock;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class InspectionSeeder extends Seeder
{
    public function run()
    {
        $products = [
            // Lot 1
            ['lot' => 'LOT1', 'name' => 'CARTOUCHE 05A Original', 'unite_mesure' => 'PCE', 'price' => 150000, 'qte' => 5, 'category_id' => 1],
            [ 'lot' => 'LOT1', 'name' => 'Classeur', 'unite_mesure' => 'PCE', 'price' => 10000, 'qte' => 50, 'category_id' => 1],
            ['lot' => 'LOT1', 'name' => 'ENCRE COLLECTEUR RETYPE', 'unite_mesure' => 'PCE', 'price' => 5000, 'qte' => 40, 'category_id' => 1],
            ['lot' => 'LOT1', 'name' => 'ENVELOPPE SAC A2', 'unite_mesure' => 'BOX/50', 'price' => 100000, 'qte' => 15, 'category_id' => 1],
            ['lot' => 'LOT1', 'name' => 'ENVELOPPE SAC A3', 'unite_mesure' => 'BOX/50', 'price' => 80000, 'qte' => 15, 'category_id' => 1],
            ['lot' => 'LOT1', 'name' => 'ENVELOPPE SAC A4', 'unite_mesure' => 'BOX/50', 'price' => 65000, 'qte' => 15, 'category_id' => 1],
            ['lot' => 'LOT1', 'name' => 'ENVELOPPE EMBALLAGE MEDOC GF', 'unite_mesure' => 'PCE', 'price' => 1200, 'qte' => 1000, 'category_id' => 1],
            ['lot' => 'LOT1', 'name' => 'ENVELOPPE EMBALLAGE MEDOC GF', 'unite_mesure' => 'PCE', 'price' => 1500, 'qte' => 1000, 'category_id' => 1],
            ['lot' => 'LOT1', 'name' => 'PAPIER IMPRIMANTE THERMAL PAPER ROLL', 'unite_mesure' => 'ROULEAUX', 'price' => 7000, 'qte' => 150, 'category_id' => 1],
            ['lot' => 'LOT1', 'name' => 'PILE CRAYON SONY GF', 'unite_mesure' => 'CARTON/24', 'price' => 6000, 'qte' => 5, 'category_id' => 1],
            ['lot' => 'LOT1', 'name' => 'PILE SONY PF', 'unite_mesure' => 'CARTON/24', 'price' => 7000, 'qte' => 10, 'category_id' => 1],
            ['lot' =>'LOT1','name'=>'POST IT (SELF ADHESIVE) 7.6cm*12.7cm','unite_mesure'=>'B/12','price'=>10000,'qte'=>5,'category_id'=>1],
            ['lot'=>'LOT1','name'=>'RAME DE PAPIER DOUBLE A','unite_mesure'=>'RAME','price'=>48000,'qte'=>100,'category_id'=>1],
            ['lot'=>'LOT1','name'=>'REGISTRE (Manuscrip Book 2QR) 5mm square','unite_mesure'=>'PCE','price'=>18000,'qte'=>80,'category_id'=>1],
            ['lot'=>'LOT1','name'=>'Stylo Bleu (bic)','unite_mesure'=>'B/50','price'=>50000,'qte'=>20,'category_id'=>1],
            ['lot'=>'LOT1','name'=>'Stylo Noir (bic)','unite_mesure'=>'B/50','price'=>50000,'qte'=>5,'category_id'=>1],
            [ 'lot' => 'LOT1', 'name' => 'TONER GPR-18 ORIGINAL', 'unite_mesure' => 'PCE', 'price' => 200000, 'qte' => 6, 'category_id' => 1],

            // Lot 3
            [ 'lot' => 'LOT3', 'name' => 'Adaptateur', 'unite_mesure' => 'PCE', 'price' => 15000, 'qte' => 20, 'category_id' => 1],
            ['lot' => 'LOT3', 'name' => 'AMPOULE DE 35 W', 'unite_mesure' => 'PCE', 'price' => 30000, 'qte' => 40, 'category_id' => 1],
            ['lot' => 'LOT3', 'name' => 'Ampoule de 9 W', 'unite_mesure' => 'PCE', 'price' => 15000, 'qte' => 80, 'category_id' => 1],
            ['lot' => 'LOT3', 'name' => 'Boite d\'attache 8 mm', 'unite_mesure' => 'Bte', 'price' => 25000, 'qte' => 5, 'category_id' => 1],
            ['lot' => 'LOT3', 'name' => 'Cadenas grand', 'unite_mesure' => 'PCE', 'price' => 30000, 'qte' => 20, 'category_id' => 1],
            ['lot' =>'LOT3','name'=>'Cadenas petit','unite_mesure'=>'PCE','price'=>15000,'qte'=>20,'category_id'=>1],
            ['lot' => 'LOT3', 'name' => 'Verrou', 'unite_mesure' => 'PCE', 'price' => 30000, 'qte' => 5, 'category_id' => 1],
            ['lot' => 'LOT3', 'name' => 'Chargeur de balance adulte', 'unite_mesure' => 'PCE', 'price' => 300000, 'qte' => 2, 'category_id' => 1],
            ['lot' => 'LOT3', 'name' => 'Cylindre', 'unite_mesure' => 'PCE', 'price' => 30000, 'qte' => 40, 'category_id' => 1],
            ['lot' => 'LOT3', 'name' => 'Huile moteur scope', 'unite_mesure' => 'Litre', 'price' => 100000, 'qte' => 60, 'category_id' => 1],
            ['lot' => 'LOT3', 'name' => 'Fiche male', 'unite_mesure' => 'PCE', 'price' => 10000, 'qte' => 10, 'category_id' => 1],
            ['lot' =>'LOT3','name'=>'Multiprise','unite_mesure'=>'PCE','price'=>40000,'qte'=>5,'category_id'=>1],
            ['lot'=>'LOT3','name'=>'Cerrure','unite_mesure'=>'PCE','price'=>80000,'qte'=>10,'category_id'=>1],
            ['lot'=>'LOT3','name'=>'Teflon','unite_mesure'=>'PCE','price'=>10000,'qte'=>3,'category_id'=>1],
            ['lot'=>'LOT3','name'=>'Socket','unite_mesure'=>'PCE','price'=>155555,'qte'=>5,'category_id'=>1],
            ['lot'=>'LOT3','name'=>'Torche','unite_mesure'=>'PCE','price'=>15555,'qte'=>15,'category_id'=>1],
            ['lot' => 'LOT3', 'name' => 'Tube 22w', 'unite_mesure' => 'PCE', 'price' => 20000, 'qte' => 60, 'category_id' => 1],
            ['lot' => 'LOT3', 'name' => 'Tube 11w', 'unite_mesure' => 'PCE', 'price' => 20000, 'qte' => 10, 'category_id' => 1],
            ['lot' => 'LOT3', 'name' => 'Ventouse pour douche', 'unite_mesure' => 'PCE', 'price' => 30000, 'qte' => 2, 'category_id' => 1],
            ['lot' => 'LOT3', 'name' => 'Filtre a Air pour GE', 'unite_mesure' => 'PCE', 'price' => 250000, 'qte' => 1, 'category_id' => 1],
            ['lot' => 'LOT3', 'name' => 'Filtre a mazout', 'unite_mesure' => 'PCE', 'price' => 250000, 'qte' => 1, 'category_id' => 1],
            ['lot'=>'LOT3','name'=>'Filtre a huile','unite_mesure'=>'PCE','price'=>180000,'qte'=>1,'category_id'=>1],
            ['lot'=>'LOT3','name'=>'Batterie de démarrage','unite_mesure'=>'PCE','price'=>155555,'qte'=>1,'category_id'=>1],
            ['lot'=>'LOT3','name'=>'Prise encastre','unite_mesure'=>'PCE','price'=>15555,'qte'=>20,'category_id'=>1],
            ['lot'=>'LOT3','name'=>'Prise apparente','unite_mesure'=>'PCE','price'=>15555,'qte'=>15,'category_id'=>1   ],
            ['lot'=>'LOT3','name'=>'Câble VOB de 1,5mm','unite_mesure'=>'PCE','price'=>25555,'qte'=>2,'category_id'=>1],
            ['lot'=>'LOT3','name'=>'Câble VOB de 2,5mm','unite_mesure'=>'PCE','price'=>300000,'qte'=>10,'category_id'=>1],
            ['lot'=>'LOT3','name'=>'Interrupteur apparent','unite_mesure'=>'PCE','price'=>10000,'qte'=>20,'category_id'=>1],

            // Lot 6
            [ 'lot'=>'LOT6', 'name' => 'Matelas 00m avec épaisseur 15cm', 'unite_mesure' => 'PCE', 'price' => 250000, 'qte' => 30, 'category_id' => 3],

            // Lot 2
            [ 'lot'=>'LOT2', 'name' => 'AIR FRESHNER', 'unite_mesure' => 'FLACON', 'price' => 25000, 'qte' => 10, 'category_id' => 1],
            ['lot'=>'LOT2','name'=>'Balais simple','unite_mesure'=>'PCE','price'=>10000,'qte'=>25,'category_id'=>1],
            ['lot'=>'LOT2','name'=>'Bassin moyen','unite_mesure'=>'PCE','price'=>12000,'qte'=>10,'category_id'=>1],
            ['lot'=>'LOT2','name'=>'Brosse a mur','unite_mesure'=>'PCE','price'=>15000,'qte'=>20,'category_id'=>1],
            ['lot'=>'LOT2','name'=>'Gant de ménage','unite_mesure'=>'Paire','price'=>8000,'qte'=>50,'category_id'=>1],
            ['lot'=>'LOT2','name'=>'Gobelet en plastique','unite_mesure'=>'PCE','price'=>2000,'qte'=>10,'category_id'=>1],
            ['lot'=>'LOT2','name'=>'Jague en plastique','unite_mesure'=>'PCE','price'=>10000,'qte'=>10,'category_id'=>1],
            ['lot'=>'LOT2','name'=>'Laclette','unite_mesure'=>'PCE','price'=>8000,'qte'=>30,'category_id'=>1],
            ['lot'=>'LOT2','name'=>'Machette','unite_mesure'=>'PCE','price'=>15000,'qte'=>1,'category_id'=>1],
            ['lot'=>'LOT2', 'name' => 'OMO 500g', 'unite_mesure' => 'Sachet', 'price' => 6000, 'qte' => 180, 'category_id' => 1],
            ['lot'=>'LOT2', 'name' => 'Petit essuime', 'unite_mesure' => 'PCE', 'price' => 2500, 'qte' => 15, 'category_id' => 1],
            ['lot'=>'LOT2','name'=>'PH (Papier Hygiénique)','unite_mesure'=>'PCE','price'=>2500,'qte'=>100,'category_id'=>1],
            ['lot'=>'LOT2','name'=>'Produit pour lavage vitre WINDOW AND GLASS CLEANER 750ML','unite_mesure'=>'FLACON/L','price'=>20000,'qte'=>10,'category_id'=>1],
            ['lot'=>'LOT2','name'=>'Savon lessive','unite_mesure'=>'Carton/24','price'=>30000,'qte'=>30,'category_id'=>1],
            ['lot'=>'LOT2','name'=>'Savon liquide','unite_mesure'=>'Bidon/5L','price'=>35000,'qte'=>200,'category_id'=>1],
            ['lot'=>'LOT2','name'=>'Savon médical','unite_mesure'=>'Carton/24','price'=>50000,'qte'=>15,'category_id'=>1],
            ['lot'=>'LOT2','name'=>'Sceau Diaba','unite_mesure'=>'PCE','price'=>50000,'qte'=>15,'category_id'=>1],
            ['lot'=>'LOT2','name'=>'Sceau petit','unite_mesure'=>'PCE','price'=>15000,'qte'=>20,'category_id'=>1],
            ['lot'=>'LOT2', 'name' => 'VIM', 'unite_mesure' => 'FLACON', 'price' => 8000, 'qte' => 192, 'category_id' => 1],
            ['lot'=>'LOT2', 'name' => 'Tissus bleu', 'unite_mesure' => 'Mettre', 'price' => 3000, 'qte' => 3, 'category_id' => 1],

            // Lot 4
            [ 'name' => 'Bon de sortie caisse', 'unite_mesure' => 'Carnet/100feilles', 'price' => 12000, 'qte' => 20, 'category_id' => 1],
            ['lot'=>'LOT4','name'=>'Bon de réquisition médicale','unite_mesure'=>'Carnet/100feilles','price'=>12000,'qte'=>10,'category_id'=>1],
            ['lot'=>'LOT4','name'=>'Autre Registre','unite_mesure'=>'Carnet/100feilles','price'=>12000,'qte'=>40,'category_id'=>1],
            ['lot'=>'LOT4','name'=>'Bordereau de Livraison','unite_mesure'=>'Carnet/100feilles','price'=>12000,'qte'=>10,'category_id'=>1],
            ['lot'=>'LOT4','name'=>'Carnet certificat médical','unite_mesure'=>'Carnet/100feilles','price'=>12000,'qte'=>15,'category_id'=>1],
            ['lot'=>'LOT4','name'=>'Facture personnel','unite_mesure'=>'Carnet/100feilles','price'=>12000,'qte'=>10,'category_id'=>1],
            ['lot'=>'LOT4','name'=>'Demande d\'examen','unite_mesure'=>'Carnet/100feilles','price'=>12000,'qte'=>200,'category_id'=>1],
            ['lot'=>'LOT4','name'=>'Ordonnancier','unite_mesure'=>'Carnet/100feilles','price'=>12000,'qte'=>200,'category_id'=>1],
            ['lot'=>'LOT4','name'=>'Registre labo GF','unite_mesure'=>'PCE','price'=>100000,'qte'=>10,'category_id'=>1],
            ['lot'=>'LOT4','name'=>'Carnet de facture des actes et autre acte médicaments','unite_mesure'=>'Carnet/100feilles','price'=>15000,'qte'=>10,'category_id'=>1],
        ];

        foreach ($products as $index => $item) {
            try {
                // Generate unique code
                $code = $item['lot'] . str_pad($index + 1, 4, '0', STR_PAD_LEFT);

                // Create product with 0 quantity first
                $product = Product::create([
                    'code_product' => $code,
                    'name' => $item['name'],
                    'unite_mesure' => $item['unite_mesure'],
                    'price' => $item['price'],
                    'price_max' => $item['price'] * 0.7, // Prix de revient = Prix unitaire
                    'price_min' => $item['price'] * 0.7, // Prix de vente = Prix unitaire - 20%
                    'price_tvac' => $item['price'] * 1.18, // Prix TTC = Prix unitaire + 18% TVA
                    'category_id' => 1,
                    'taux_tva' => 18, // TVA standard 18%
                    'quantite' => 0,
                    'quantite_alert' => 5,
                    'date_expiration' => Carbon::now()->addYears(2), // Expire dans 2 ans
                    'description' => 'Description',
                    'category_id' => $item['category_id'],
                    ]);

                // Now add quantity via "Entrée Normal" movement
                $stock_id = 1; // Default stock

                ProductDetail::create([
                    'user_id' => 1,
                    'stock_id' => $stock_id,
                    'product_id' => $product->id,
                    'prix_revient' => $item['price'],
                    'quantite' => $item['qte'],
                    'quantite_restant' => $item['qte'],
                    'description' => 'Import initial',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                // Update product quantity
                $product->quantite = $item['qte'];
                $product->save();

                // Save movement record
                ObrMouvementStock::saveMouvement(
                    $product,
                    'EN', // Entrée Normales
                    $item['price'],
                    $item['qte'],
                    'Qt initial'
                );

                // Track in follow_products
                FollowProduct::create([
                    'quantite' => $item['qte'],
                    'details' => $product->toJson(),
                    'action' => 'EN',
                    'product_id' => $product->id,
                ]);

                echo "✓ Produit créé: {$item['name']} (Qte: {$item['qte']})\n";

            } catch (\Exception $e) {
                echo "✗ Erreur pour {$item['name']}: " . $e->getMessage() . "\n";
            }
        }

        echo "\n=== Importation terminée ===\n";
    }
}
