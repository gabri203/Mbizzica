<?php

namespace App\Http\Controllers;

use PragmaRX\Google2FALaravel\Support\Authenticator;
use Illuminate\Http\Request;
use PragmaRX\Google2FALaravel\Google2FA;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\User;
class AutenticazioneDueFattori extends Controller
{

    public function autenticazione_due_fattori(Request $request):View
    {
        $google2fa = app('pragmarx.google2fa');
        $secret = $google2fa->generateSecretKey();
        $user=auth()->user();
        $user->google2fa_secret = encrypt($secret);
        $user->save();
        $qrImage = $google2fa->getQRCodeInline(config('app.name'),$user->email,$secret);


        return view('2fa.abilita',compact('qrImage','secret'));
    }

    public function verify2fa(Request $request)
    {
    $request->validate([
        'otp' => 'required',
    ]);

    $google2fa = app('pragmarx.google2fa');
    $user = auth()->user();

    $secret = decrypt($user->google2fa_secret);

    if ($google2fa->verifyKey($secret, $request->otp)) {
        //mi fa passare con successo
        return redirect()->route('profile')->with('success', '2FA attivata');
    }

    return back()->withErrors(['otp' => 'Codice errato']);
    }

    public function show_profile(): View
    {
        return view('profile');
    }

}
