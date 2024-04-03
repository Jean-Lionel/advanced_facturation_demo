<?php

use App\Http\Controllers\Api\CacheAdvancedController;
use App\Http\Controllers\ObrStockController;
use App\Http\Controllers\SyncronizeController;
use App\Jobs\ObrSendInvoince;
use Illuminate\Support\Facades\Auth;
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
    Route::get('/', 'VenteController@index');
    Route::get('product/create', 'ProductController@create')->name('product.create');
    Route::resource('obr_declarations', ObrDeclarationController::class);
    Route::get('obr_declarations_hostory', [\App\Http\Controllers\ObrDeclarationController::class, 'hostory'])->name('obr_declarations_hostory');
    Route::get('sendInvoinceToObr/{invoince_id?}', 'ObrDeclarationController@sendInvoinceToObr');
    Route::post('cancelInvoice', 'ObrDeclarationController@cancelInvoice');
    Route::get('obr_declarations_cancel', 'ObrDeclarationController@obr_declarations_cancel')->name('obr_declarations_cancel');
    Route::resource('stockes', StockController::class);
    Route::get('bar_code', 'ProductController@bar_code')->name('bar_code');
    Route::resource('products', ProductController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('ventes', VenteController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('entreprises', EntrepriseController::class);
    Route::get('backup_database', 'EntrepriseController@backup_database')->name('backup_database');
    Route::resource('depenses', DepenseController::class);
    Route::resource('users', UserController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('paimenent_dette', PaiementDetteController::class);
    Route::get('update_price', 'CartController@update_product_price')->name('update_price');
    Route::get('update_emballage', 'CartController@update_emballage')->name('update_emballage');
    Route::get('update_quantite', 'CartController@update_quantite')->name('update_quantite');
    Route::get('update_tva', 'CartController@update_tva')->name('update_tva');
    Route::get('rapport', 'StockController@rapport')->name('rapport');
    //Cart ROUTE
    Route::post('panier/ajouter', 'CartController@store')->name('panier.store');
    Route::get('panier/index', 'CartController@index')->name('panier.index');
    Route::get('panier/vente', 'CartController@vente')->name('panier.vente');
    Route::get('getClient/{id}', 'ClientController@getClient')->name('getClient');
    Route::delete('panier/{id}', 'CartController@destroy')->name('cart.destroy');
    Route::post('update_panier', 'CartController@updatePanier')->name('cart.update_panier');
    Route::get('journal', 'StockController@journal')->name('stockes.journal');
    Route::get('canceledInvoince', 'StockController@canceledInvoince')->name('stockes.journal');
    Route::delete('cancelFactures/{order_id}', 'StockController@cancelFactures')->name('cancelFactures');
    Route::get('canceledInvoince', 'StockController@canceledInvoince')->name('canceledInvoince');
    Route::get('journal_history', 'StockController@journal_history')->name('journal_history');
    Route::get('fiche_stock', 'StockController@fiche_stock')->name('fiche_stock');
    Route::get('mouvement_stock', 'StockController@mouvement_stock')->name('mouvement_stock');

    Route::get('/vider', function () {
        Cart::destroy();
    });
    //Checkout Router PayMent
    Route::post('payement', 'CheckoutController@store')->name('payement');
    Route::post('add_quantite_stock', 'ProductController@add_quantite_stock')->name('add_quantite_stock');
    Route::get('add_view/{product}', 'ProductController@add_view')->name('add_view');
    Route::get('bon_entre', 'StockController@bonEntre')->name('bon_entre');
    Route::get('movement_stock/{item_id}', 'ProductController@movement_stock')->name('movement_stock');
    Route::get('paimenet_dette', 'CheckoutController@paimenetDette')->name('paimenet_dette');
    Route::get('retour_produit', [ObrStockController::class, 'retour_produit'])->name('retour_produit');
    Route::get('syncronize_to_obr', [SyncronizeController::class,  'syncronize'])->name('syncronize_to_obr');
    Route::get('obr_log', [SyncronizeController::class,  'obr_log'])->name('obr_log');
    Route::get('clear_cache', [CacheAdvancedController::class,  'index'])->name('clear_cache');
    Route::resource('comptes', CompteController::class);

    Route::resource('compte', CompteController::class);
    Route::get('syncronize_customer',[CompteController::class, 'syncronize_customer'] )->name('syncronize_customer');
});

require __DIR__ . '/jetstream.php';

