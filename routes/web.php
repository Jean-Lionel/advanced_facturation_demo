<?php

use App\Http\Controllers\Api\CacheAdvancedController;
use App\Http\Controllers\BienvenuHistoriqueController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\CompteController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\ObrDeclarationController;
//use App\Http\Controllers\CompteController;
use App\Http\Controllers\ObrStockController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaiementDetteController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductStockController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SyncronizeController;
use App\Http\Controllers\Tools\ImportDataController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VenteController;
use App\Jobs\ObrSendInvoince;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');
Route::get('send_invoice', function () {
    ObrSendInvoince::dispatch();
});
Route::group(['middleware' => ['auth']], function () {
    //
    Route::get('/', [VenteController::class, 'index']);
    Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
    Route::resource('obr_declarations', ObrDeclarationController::class);
    Route::get('obr_declarations_hostory', [ObrDeclarationController::class, 'hostory'])->name('obr_declarations_hostory');
    Route::get('sendInvoinceToObr/{invoince_id?}', [ObrDeclarationController::class,'sendInvoinceToObr']);
    Route::post('cancelInvoice', [ObrDeclarationController::class,'cancelInvoice']);
    Route::get('obr_declarations_cancel', [ObrDeclarationController::class,'obr_declarations_cancel'])->name('obr_declarations_cancel');
    Route::resource('stockes', StockController::class);
    Route::get('bar_code', [ProductController::class, 'bar_code'])->name('bar_code');
    Route::resource('products', ProductController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('ventes', VenteController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('entreprises', EntrepriseController::class);
    Route::get('backup_database', [EntrepriseController::class , 'backup_database'])->name('backup_database');
    Route::resource('depenses', DepenseController::class);
    Route::resource('users', UserController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('paimenent_dette', PaiementDetteController::class);
    Route::get('update_price', [CartController::class ,'update_product_price'])->name('update_price');
    Route::get('update_emballage', [CartController::class ,'update_emballage'])->name('update_emballage');
    Route::get('update_quantite', [CartController::class ,'update_quantite'])->name('update_quantite');
    Route::get('update_tva', [CartController::class ,'update_tva'])->name('update_tva');
    Route::get('rapport', [StockController::class , 'rapport'])->name('rapport');
    //Cart ROUTE
    Route::post('panier/ajouter', [CartController::class ,'store'])->name('panier.store');
    Route::get('panier/index', [CartController::class ,'index'])->name('panier.index');
    Route::get('panier/vente', [CartController::class ,'vente'])->name('panier.vente');
    Route::get('getClient/{id}', [ClientController::class,'getClient'])->name('getClient');
    Route::delete('panier/{id}', [CartController::class ,'destroy'])->name('cart.destroy');
    Route::post('update_panier', [CartController::class ,'updatePanier'])->name('cart.update_panier');
    Route::get('journal', [StockController::class , 'journal'])->name('stockes.journal');
    Route::get('canceledInvoince', [StockController::class, 'canceledInvoince'])->name('stockes.journal');
    Route::delete('cancelFactures/{order_id}', [StockController::class,'cancelFactures'])->name('cancelFactures');
    Route::get('canceledInvoince', [StockController::class, 'canceledInvoince'])->name('canceledInvoince');
    Route::get('journal_history', [StockController::class ,'journal_history'])->name('journal_history');
    Route::get('fiche_stock', [StockController::class ,'fiche_stock'])->name('fiche_stock');
    Route::get('mouvement_stock', [StockController::class ,'mouvement_stock'])->name('mouvement_stock');
    //Checkout Router PayMent
    Route::post('payement', [CheckoutController::class,'store'])->name('payement');
    Route::post('add_quantite_stock', [ProductController::class, 'add_quantite_stock'])->name('add_quantite_stock');
    Route::get('add_view/{product}', [ProductController::class, 'add_view'])->name('add_view');
    Route::get('bon_entre', [StockController::class ,'bonEntre'])->name('bon_entre');
    Route::get('movement_stock/{item_id}', [ProductController::class, 'movement_stock'])->name('movement_stock');
    Route::get('paimenet_dette', [CheckoutController::class,'paimenetDette'])->name('paimenet_dette');
    Route::get('retour_produit', [ObrStockController::class, 'retour_produit'])->name('retour_produit');
    Route::get('syncronize_to_obr', [SyncronizeController::class,  'syncronize'])->name('syncronize_to_obr');
    Route::get('obr_log', [SyncronizeController::class,  'obr_log'])->name('obr_log');
    Route::get('clear_cache', [CacheAdvancedController::class,  'index'])->name('clear_cache');
    Route::resource('comptes', CompteController::class);
    Route::resource('compte', CompteController::class);
    Route::get('syncronize_customer',[CompteController::class, 'syncronize_customer'] )->name('syncronize_customer');
    Route::resource('product_stock', ProductStockController::class);
    Route::get('rapport_detail', [RapportController::class , 'rapport_detail'])->name('rapport_detail');
    Route::get('partage_interet', [RapportController::class , 'partage_interet'])->name('partage_interet');
    Route::resource('commande', App\Http\Controllers\CommandeController::class);
    Route::get('bon_commande', [CommandeController::class, 'bon_commande'])->name('bon_commande');
    Route::resource('commande-detail', App\Http\Controllers\CommandeDetailController::class);
    Route::get('import_data', [ImportDataController::class, 'import_data'])->name('import_data_show');
    Route::get('export_model', [ImportDataController::class, 'export_model'])->name('export_model_product');
    Route::post('import', [ImportDataController::class, 'import'])->name('import_data');
    Route::post('save_import_data', [ImportDataController::class, 'save'])->name('save_import_data');
    Route::get('clients_abones/{id}', [ClientController ::class, 'abonne'] )->name('clients_abones');
    //recharge le compte
    Route::get('recharge/{id}', [CompteController::class , 'recharge'] )->name('recharge');
    Route::get('historique/{id}', [CompteController::class , 'historique'])->name('historique');
    Route::post('updatecompte', [CompteController::class, 'updatecompte'])->name('updatecompte');
    Route::resource('bienvenu-historique', BienvenuHistoriqueController::class);
    Route::get('commissionnaires', [ClientController::class, 'commissionnaires'])->name('commissionnaires');
    Route::get('make_commissionnaire/{id}', [ClientController::class, 'make_commissionnaire'])->name('make_commissionnaire');
    Route::resource('commission-detail', App\Http\Controllers\CommissionDetailController::class);
    Route::get('load_commission', [ClientController::class, 'load_commission'])->name('load_commission');
    Route::resource('order-interet', App\Http\Controllers\OrderInteretController::class);
    Route::resource('hr-chambre', App\Http\Controllers\HrChambreController::class);
    Route::resource('partage_interethr-fiche', App\Http\Controllers\HrFicheController::class);
    Route::resource('hr-fiche-detail', App\Http\Controllers\HrFicheDetailController::class);
    Route::resource('hr-commande', App\Http\Controllers\HrCommandeController::class);
    Route::resource('banque', App\Http\Controllers\BanqueController::class);
    Route::resource('maison-location', App\Http\Controllers\MaisonLocationController::class);
    Route::resource('client-maison', App\Http\Controllers\ClientMaisonController::class);
    Route::resource('payment-location-mensuel', App\Http\Controllers\PaymentLocationMensuelController::class);
    Route::resource('historique-paiement', App\Http\Controllers\HistoriquePaymentController::class);
    Route::resource('non-paiement-location', App\Http\Controllers\NonPaymentLocationController::class);
    Route::prefix('/LocationMaison')->name('LocationMaison.')->group(function(){
        Route::resource('', App\Http\Controllers\ClientsNonPayeLoyersController::class)
               ->except([ 'edit', 'update', 'destroy','show','create']);
        Route::resource('All', App\Http\Controllers\ClientsNonPayeLoyersAllController::class)
                ->except([ 'edit', 'update', 'destroy','show','create']);
    }); 
    Route::view('clients_non_paye_loyers_all', 'location.non_paye_loyers_all')->name('clients_non_paye_loyers_all');
    Route::view('clients_half_paid', 'location.clients_half_paid')->name('clients_half_paid');
    Route::view('rapport_revenue','reports.rapport_revenue' )->name('rapport_revenue');
    Route::resource('client-history', App\Http\Controllers\ClientHistoryController::class);
});
require __DIR__ . '/jetstream.php';

Route::resource('periode-paiment-location', App\Http\Controllers\PeriodePaimentLocationController::class);


