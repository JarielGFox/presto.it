<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advert;
use Illuminate\Support\Facades\Mail;
use App\Mail\BecomeReviser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $adverts_to_check = Advert::whereNull('is_accepted')->get();
        $adverts_to_check_count = $adverts_to_check->count();

        return view('admin.panel', compact('adverts_to_check_count', 'adverts_to_check'));
    }

    public function acceptAdvert(Advert $advert)
    {
        $advert->setAccepted(true);
        return redirect()->back()->with('message', 'Inserzione accettata!');
    }

    public function rejectAdvert(Advert $advert)
    {
        $advert->setAccepted(false);
        return redirect()->back()->with('message', 'Inserzione rifiutata!');
    }

    public function becomeReviser()
    {
        Mail::to('amministrazione@presto.it')->send(new BecomeReviser(Auth::user()));
        return redirect()->back()->with('message', 'Richiesta inoltrata correttamente!');
    }

    public function makeReviser(User $user)
    {
        Artisan::call('presto:set-role', ["email" => $user->email]);
        return redirect('/')->with('message', 'Hai reso l\'utente un Revisore!');
    }
}
