<?php

use Illuminate\Support\Facades\Route;
use App\Models\Livre;
use App\Models\Categorie;
use Illuminate\Http\Request;

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

Route::get('/', function () {
    return view('index');
});

Route::get('accueil', function () {
    return view('accueil');
});

Route::get('liste', function () {
    //Avec requête SQL
    // $livres = DB::select('select * from ltp1livres', []);
    //dump($livres);

    //Avec Query Builder
    // $livres = DB::table('ltp1livres')->get();
    //dump($livres);

    //Avec ORM Eloquent (avant, on crée la classe Livre avec php artisan)
    $livres=Livre::join('categories', 'categorie_id', '=', 'categories.id')->get();


    // 

    return view('liste_livres',["livres"=>$livres]);

});

Route::get('meslivres', function (Request $request) {
    $id = Auth::user()->id;
    $livres=Livre::join('categories', 'categorie_id', '=', 'categories.id')->where('user_id', $id)->select("livres.id", "titre", "resume", "prix", "user_id", "categories.libelle")->get();
    return view('meslivres',["livres"=>$livres]);
});

// AJOUT

Route::get('ajouter', function (Request $request) {
    $categories=Categorie::get();
    return view('ajout_livre', ["categories"=>$categories]);
});

Route::get('ajout', function (Request $request) {
    $livre = new Livre; // nouvel objet instance du modèle
    $livre->titre = $request->input('titre'); // définition des propriétés
    $livre->resume = $request->input('resume'); // définition des propriétés
    $livre->prix = $request->input('prix'); // définition des propriétés
    $livre->categorie_id = $request->input('categorie_id'); // définition des propriétés
    $livre->user_id = Auth::user()->id;
    $livre->save();// sauvegarde dans la BD Insert into

    if ($livre) {
        $message = "Votre livre a bien été ajouté !";
    }

    $id = Auth::user()->id;
    $livres=Livre::join('categories', 'categorie_id', '=', 'categories.id')->where('user_id', $id)->select("livres.id", "titre", "resume", "prix", "user_id", "categories.libelle")->get();

    return view('meslivres', ["livres"=>$livres, 'message'=>$message]);
});

// RECHERCHE

Route::get('recherche', function (Request $request) {
    $livres=Livre::where('titre', 'like', '%'.$request->input('search').'%')->get();
    return view('resultat_recherche', ["livres"=>$livres]);
});

// MODIFICATION

Route::get('modification', function (Request $request) {
    $idlivre = $request->input('id');
    $livre = Livre::find($idlivre);

    $categories=Categorie::get();

    return view('modification_livre', ["livre"=>$livre,"categories"=>$categories]);

});

Route::get('modifier', function (Request $request) {
    $livre = Livre::find($request->input('id')); 
    $livre->titre = $request->input('titre'); // nouvelles valeurs
    $livre->resume = $request->input('resume'); // nouvelles valeurs
    $livre->prix = $request->input('prix'); // nouvelles valeurs
    $livre->save(); // sauvegarde dans la BD Update set

    $id = Auth::user()->id;
    $livres=Livre::join('categories', 'categorie_id', '=', 'categories.id')->where('user_id', $id)->select("livres.id", "titre", "resume", "prix", "user_id", "categories.libelle")->get();

    return view('meslivres', ["livres"=>$livres]);
});

// SUPPRESSION

Route::get('supprimer', function (Request $request) {
    $livre = Livre::find($request->input('id'));
    $livre->delete();

    $id = Auth::user()->id;
    $livres=Livre::join('categories', 'categorie_id', '=', 'categories.id')->where('user_id', $id)->select("livres.id", "titre", "resume", "prix", "user_id", "categories.libelle")->get();

    return view('meslivres', ["livres"=>$livres]);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');