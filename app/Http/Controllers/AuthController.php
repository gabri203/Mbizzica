<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
//Mostra la form registrazione appena l'utente preme register nel welcome.blade
public function show_register_form(): View{

        return view('register');
}
//Verifica tramite la funzione validate([])
// che viene richiamata tramite -> gli permette di validare tramite la associazione
// delle stringhe name,email,password a cui gli vengono associati il 'required'
// che entra dentro name ver verificare se dentro name c'è almeno delle stringhe che abbiano un massimo di 255 caratteri,e cosi via con gli altri required che vanno a verificare
// se l'utente ha effettivamente ha inserito una email valida con @ ecc
// poi password la stessa cosa con il required|confirmed che richiede
// la confermazione della password e poi |min:8 che vuol dire con un minimo di 8 caratteri può essere confermata la password registrata
public function register(Request $request){

    $request -> validate([
        'name'=>'required|string|max:255',
        'email'=>'required|email|unique:users',
        'password'=>'required|confirmed|min:8'
    ]);
// Richiama il Model User che comunicherà con la tabella users e mi crearà un nuovo record
// Infatti qui vediamo che gli ho specifica che nelle collonne name,email e password
// deve inserire dall'oggetto $request quello che contiene name,email,password
//quello faccio nuovamente è usare la freccia di associazione che consegna il name e email dal oggetto $request
    User::create([
        'name'=> $request->name,
        'email'=> $request->email,
        'password'=> Hash::make($request->password)
    ]);

//Infine faccio un return reindirizzalo alla route login con un messaggio Registrazione completata con successo
    return redirect()->route('login')->with('success','Registrazione completata con successo'); //dopo la function di registrazione lo reindirizzo nella route 'login' che il nome che ho dato al percorso che contiene la function login con la logica
}

//mostra la form login
public function show_login_form(): View{

    return view('login');
}

//$credentials conterrà le stringhe email,password prese dal form
public function login(Request $request): RedirectResponse{
// Gli viene dato all'oggetto $credentials l'altro oggetto $request contenente le informazioni inserite dall'utente nel form
// effettivamente l'oggetto $request fa una chimata alla funzione validate([])
// per validare una assocciazione dell'email al required email cioè è richiesto una email valida la stessa cosa password

    $credentials = $request->validate([
        'email'=>['required', 'email'],
        'password'=>['required'],
       ]);


    if(Auth::attempt($credentials)){

        $request->session()->regenerate();

        return redirect()->route('2fa.abilita')->with('success','Registrazione completata con successo');
    }
    //se nel caso fallisce la registrazione cioè l'utente o ha sbagliato ad inserire oppure non c'è nel database
    //mi manda questo messaggio in dietro e lo prendo nel show login con @if session('fail') genericamente se nel caso non entra nel if di sopra della autenticazione poichè ho usato il return back() e with
    return back()->with('fail','mail o password sbagliata riprova di nuovo');



}

//Logout
public function logout(Request $request){
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect()->route('login')->with('success','Registrazione completata con successo!');
}





}
