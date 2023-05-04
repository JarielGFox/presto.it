<?php

namespace App\Http\Controllers;

use App\Mail\InfoMail;
use App\Models\Property;
use App\Models\Stat;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Advert;
use App\Models\Image;


class PageController extends Controller
{
    public function homePage()
    {
        $randomImages = $this->getRandomImages(3);
        return view('welcome', ['randomImages' => $randomImages]);
    }

    public function myAccount()
    {
        return view('auth.account');
    }

    public function categoryShow(Category $category)
    {
        return view('adverts.categoryShow', compact('category'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function sendEmail(Request $request)
    {
        $data = [
            "nome" => $request->nome,
            "telefono" => $request->telefono,
            "mail" => $request->mail,
            "messaggio" => $request->messaggio
        ];


        Mail::to('amministrazione@presto.it')->send(new InfoMail($data));

        return redirect()->route('thank-you');
    }

    public function thankYou()
    {
        return view('grazie');
    }

    public function setLanguage($lang)
    {
        //dd($lang);
        session()->put('locale', $lang);
        return redirect()->back();
    }

    public function getRandomImages($count = 50)
    {
        return Image::whereHas('advert', function ($query) {
            $query->where('is_accepted', true);
        })->inRandomOrder()->take($count)->get();
    }

    public static function approvedAdvertsCount($userId)
    {
        return Advert::where('user_id', $userId)->where('is_accepted', true)->count();
    }
}
