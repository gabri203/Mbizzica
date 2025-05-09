<?php

namespace App\Http\Controllers;

use App\Models\Paste;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PasteController extends Controller
{
    public function create(): View
    {
        $paste = Paste::create([
            'content'=>'',
            'expires_at'=>Carbon::now()->addDays(2),
        ]);

        session()->put('paste.id',$paste->id);


        return view('paste.create',compact('paste'));

    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'content'=>['required','string'],
            'expires_at'=>['nullable','date','after:now'],
        ]);

        $id = session('paste.id');
        $paste = Paste::findOrFail($id);

        //aggiorna la sessione delle informazioni che ci sono dentro
        $paste->update($data);

        //Puliamo la sessione
        session()->forget('paste.id');//con forget pulisce dimendicando

        return redirect()->route('paste.show',$paste);
    }
    public function show(Paste $paste): View
    {
        if($paste->expires_at && $paste->expires_at->isPast()){
            //dd('prova');non è divertente questo bug non entra nel if per colpa del isPast() anzi del UTC che va in comflitto con L'UTC del app.php di config
            $paste->delete();
            abort(404);
        }
        return view('paste.show',compact('paste'));

    }

   /* public function destroy()
    {
        $paste->delete();

        return redirect()->route('paste.create')->with('success','Paste eliminato');

    }*/





}
