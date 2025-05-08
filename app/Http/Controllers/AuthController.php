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

        return redirect()->route('paste.create')->with('success','Registrazione completata con successo');
    }




}

//Logout
public function logout(Request $request){
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect()->route('login')->with('success','Registrazione completata con successo!');
}

// Mostra la casella di inserimento email di password dimentica
public function show_email_form(Request $request): View{
    return view('email');
}

public function email(Request $request){
        $request->validate([
        'email' => ['required','email']
    ]);
    // l'oggetto $user riceverà la tabella users specificando con il filtro where otterrà la collonna email e poi
    // inserendo $request->email filtro quello che gli viene passato all'oggetto $user che conterrà soltanto il contenuto dell'email
    $user = User::where('email',$request->email)->first();

    // se l'utente non si trova dentro la collonna 'email' cioè non corrisponde lemail entra in questo if che mi ritorna in dietro il forma per l'inserimento nuovamente la password
    if(!$user){
        return back()->withInput()->withErrors()->with('error','Email non trovata nel dataBase poichè non è ancora registrata!');
    }
    //Restituisce in $broker il servizio di reset password per il provider users
    $broker = password::broker('users');
    //crea il token $token->createToken("$user");
    $token = $broker->createToken($user);

    //qui mettiamo la logica di invio link all'utente

    //Costruzione dell'URL
    $url = url(route('password.reset',[
        'token' => $token,
        'email' => $user->email,

    ],false));

    //Invio all'email dell'utente con Mailable
    Mail::to($user->email)->send(new App\Mail\ResetPasswordMail($url));

    //ritorna indietro all'utente con un messaggio Password reset inviata con succ................
    return back()->with('succes','Password reset inviata con successo alla tua email!');


}

public function password(Request $request){
    $request->validate([
        'token'=> 'required|string',
        'email'=> 'required|email',
        'password'=> 'required|confirmed|min:8'

    ]);

    // 2) Si provo a resettare la password usando il broker 'users'
    $status = Password::broker('users')->reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $newPassword) {
            // qui aggiorniamo la password dell'utente
            $user->password = Hash::make($newPassword);
            $user->save();
        }
    );

    // 3) Se il reset è andato a buon fine, reindirizzo al login con un messaggio
    if ($status === Password::PASSWORD_RESET) {
        return redirect()->route('login')->with('success', 'Password modificata con successo.');
    }

    // 4) Altrimenti torni indietro con l’errore (es. token scaduto o non valido)
    return back()->withErrors(['email' => 'Impossibile resettare la password. Riprova.'])->onlyInput('email');


}

//mostra la home page
public function show_home_form(Request $request): View{
    return view('paste.create');
}


}
