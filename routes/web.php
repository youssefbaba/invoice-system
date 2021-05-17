<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/terms', function () {
    return view('terms');
})->name('terms');


// Auth::routes();
Auth::routes(['verify' => true]);

Route::middleware(['auth', 'is.admin'])->group(function () {
    Route::get('/admin', 'AdminController@index')->name('admin');
    Route::get('/listadministrateurs', 'AdminController@listadmin')->name('admin.listadmin');
    Route::get('/listutilisateurs', 'AdminController@listuser')->name('admin.listuser');
    Route::get('editroleuser/{user_id}', 'AdminController@edit')->name('admin.edit');
    Route::put('updateroleuser/{user_id}', 'AdminController@update')->name('admin.update');
    Route::get('deleteuser/{user_id}', 'AdminController@deleteuser')->name('admin.delete');
    Route::get('showuser/{user_id}', 'AdminController@show')->name('admin.show');
    Route::get('/adduser', 'AdminController@create')->name('admin.create');
});
Route::get('/dashboard', 'chartController@chartdirham')->name('dashboard');;








//create a group route for clients

Route::middleware(['auth', 'verified'])->group(function () {

    /*start the toute for the client*/
    Route::resource('clients', 'clientsController')->middleware('auth');

    // route de déconnexion
    Route::get('/deconnexion', 'clientsController@deconnexion')->name('deconnexion');

    //route pour voir client
    Route::get('voirplus/{id}', 'clientsController@voirplus')->name('voirplus');

    Route::post('/clients_search', 'clientsController@search')->name('recherche_client');
});

//create a group route for factures
Route::middleware(['auth', 'verified'])->group(function () {
    /*start the toute for the facture*/
    Route::get('generer_pdf_facture/{id}', 'facturesController@genererpdff')->name('facture.generpdff');
    Route::get('voirplus_facture/{id}', 'facturesController@facture_voirplus')->name('factures.voirplus');
    Route::get('edit_facture/{facture_id}/{client_id}', 'facturesController@editfacture')->name('factures.editfacture');
    Route::get('edit_facture_vide/{facture_id}', 'facturesController@editfacture_vide')->name('factures.editfacture_vide');
    Route::get('showfactureprovisoir', 'facturesController@factureprovi')->name('factures.provi');
    Route::get('showfacturefinalise/{facture_id}', 'facturesController@facturefinalisechange')->name('facture.change.finalise');
    Route::get('showfacturefinalise', 'facturesController@facturefinalise')->name('factures.finalise');
    Route::get('changefacturepayé/{facture_id}', 'facturesController@facturepayéchange')->name('facture.change.payé');
    Route::get('deletefacture/{facture_id}', 'facturesController@deletefacture')->name('deletefacture');
    Route::get('showfacturepaye', 'facturesController@facturepaye')->name('factures.paye');
    Route::get('showfactureapaye', 'facturesController@factureapaye')->name('factures.apayé');
    Route::get('changefactureanulle/{facture_id}', 'facturesController@annulepaiement')->name('facture.anulle_paiement');
    Route::resource('factures', 'facturesController')->middleware('auth');
    Route::get('create_facture/{id}', 'facturesController@create_facture_client')->name('create_determine_facture');
    Route::get('duplicate_facture/{facture_id}/{client_id}', 'facturesController@duplicatefacture')->name('factures.duplicatefacture');
    Route::get('duplicate_facture_vide/{facture_id}', 'facturesController@duplicatefacture_vide')->name('factures.duplicatefacture_vide');
    Route::get('duplicateen_devise/{facture_id}', 'facturesController@duplicateen_devise')->name('devises.duplicateen_devise');
    Route::post('/facture_search', 'facturesController@search')->name('recherche_facture');
});

//create a group route for avoirs
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('create_avoir/{facture_id}/{client_id}', 'AvoirController@create_avoir')->name('avoirs.addavoirs');
    Route::resource('avoirs', 'AvoirController')->middleware('auth');
    Route::get('voirplus_avoir/{id}', 'AvoirController@avoir_voirplus')->name('avoirs.voirplus');
    Route::get('showavoirfinalise/{avoir_id}', 'AvoirController@avoirfinalisechange')->name('avoir.change.finalise');
    Route::get('edit_avoir/{avoir_id}/{client_id}', 'AvoirController@editavoir')->name('avoirs.editavoir');
    Route::get('generer_pdf_avoir/{id}', 'AvoirController@genererpdfa')->name('avoir.genererpdfa');
    Route::get('duplicateen_devise/{avoir_id}', 'AvoirController@duplicateen_devise')->name('avoirs.duplicateen_devise');
    Route::get('duplicateen_facture/{avoir_id}/{client_id}', 'AvoirController@duplicateen_facture')->name('avoirs.duplicateen_facture');
    Route::get('changeavoirremboursé/{avoir_id}', 'AvoirController@avoirrembourséchange')->name('avoir.change.remboursé');
    Route::get('changeavoiranulle/{avoir_id}', 'AvoirController@annuleremboursement')->name('avoir.anulle_remboursement');
    Route::get('showavoirprovisoir', 'AvoirController@avoirprovi')->name('avoirs.provi');
    Route::get('showavoirfinalise', 'AvoirController@avoirfinalise')->name('avoirs.finalise');
    Route::get('showavoirrembourse', 'AvoirController@avoirrembourse')->name('avoirs.rembourse');
    Route::get('deleteavoir/{avoir_id}', 'AvoirController@deleteavoir')->name('deleteavoir');
    Route::post('/avoir_search', 'AvoirController@search')->name('recherche_avoir');






    Route::get('edit_facture_vide/{facture_id}', 'facturesController@editfacture_vide')->name('factures.editfacture_vide');
    Route::get('create_facture/{id}', 'facturesController@create_facture_client')->name('create_determine_facture');
    Route::get('duplicate_facture_vide/{facture_id}', 'facturesController@duplicatefacture_vide')->name('factures.duplicatefacture_vide');
});



//create route group for devis
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('devises', 'devisesController')->middleware('auth');
    Route::get('edit_devis/{devi_id}/{client_id}', 'devisesController@editdevis')->name('devises.editdevis');
    Route::get('edit_devis_vide/{devi_id}', 'devisesController@editdevis_vide')->name('devises.editdevis_vide');
    Route::get('showdevis_provi', 'devisesController@showprovi')->name('devises.showprovi');
    Route::get('showdevis_finalise', 'devisesController@showfinalise')->name('devises.showfinalise');
    Route::get('showdevis_refuse', 'devisesController@showrefuse')->name('devises.showrefuse');
    Route::get('showdevis_sign', 'devisesController@showsigne')->name('devises.showsigne');
    Route::get('finalise_devi/{id}', 'devisesController@finalisedevi')->name('devises.finalise');
    Route::get('signe_devi/{id}', 'devisesController@signéedevi')->name('devises.signe');
    Route::get('refuse_devi/{id}', 'devisesController@refusedevi')->name('devises.refuse');
    Route::get('voirplus_devi/{id}', 'devisesController@voirplus_devi')->name('devises.voirplus');
    Route::get('deletedevise/{devi_id}', 'devisesController@deletedevise')->name('deletedevise');
    Route::get('duplicate_devis/{devi_id}/{client_id}', 'devisesController@duplicatedevise')->name('devises.duplicatedevise');
    Route::get('duplicate_devis_vide/{devi_id}', 'devisesController@duplicatedevise_vide')->name('devises.duplicatedevise_vide');
    Route::post('store_duplicate', 'devisesController@store_duplicate')->name('store_duplicate');
    Route::get('generer_pdf_devis/{id}', 'devisesController@genererpdf')->name('devise.generpdf');
    Route::get('create_devis/{id}', 'devisesController@create_devis_client')->name('create_determine_devis');
    Route::get('duplicateen_facture/{devi_id}', 'devisesController@duplicateen_facture')->name('devises.duplicateen_facture');
    Route::post('/devis_search', 'devisesController@search')->name('recherche_devi');
    // Route::post('/', 'devisesController@storedevi')->name('devises.storedevi');
});


//create route for charts
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard/charteuro', 'chartController@charteuro')->name('dash.charteuro');
    Route::get('dashboard/chartdollar', 'chartController@chartdollar')->name('dash.chartdollar');

    // Route::get('/home', 'HomeController@index')->name('home');
    Route::get('dashboard/chiffre_affaire', 'chartController@chiffre_affaire')->name('dash.chiffre_affaire');
    Route::get('dashboard/debours', 'chartController@debours')->name('dash.debours');
});
//create route for user
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('user', 'UserController@index')->name('user');
});
//create route for parametre
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('parametre', 'parametreController@index')->name('parametre');
    Route::post('parametre_cordonne/{user_id}', 'parametreController@update')->name('parametre.update');
    Route::get('parametreCompte', 'parametreController@parametre_compte')->name('parametre.compte');
    Route::post('parametre_UpdateCompte/{user_id}', 'parametreController@updateCompte')->name('parametre.updateCompte');
    Route::get('parametreDelete', 'parametreController@parametre_delete')->name('parametre.delete');
    Route::post('parametre_DeleteCompte/{user_id}', 'parametreController@delete_account')->name('parametre.deleteCompte');
});

//create route for connecion par media
Route::get('login/facebook', 'Auth\LoginController@redirectToProvider')->name('login_facebook');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');


Route::get('login/google', 'Auth\LoginController@redirectToProvider1')->name('login_google');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback1');
