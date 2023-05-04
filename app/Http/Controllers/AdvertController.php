<?php

namespace App\Http\Controllers;

use App\Models\Advert;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class AdvertController extends Controller
{
    public $title;
    public $body;
    public $price;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adverts = Advert::All();
        $adverts = Advert::get()->sortByDesc('created_at');
        $categories = Category::All();

        $adverts = Advert::where('is_accepted', true)->orderByDesc('created_at')->paginate(9);

        return view('adverts.index', ['adverts' => $adverts], compact('categories', 'adverts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adverts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $advert = Advert::create([
            'title' => $this->title,
            'body' => $this->body,
            'price' => $this->price,
        ]);
        $advert->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Advert $advert)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Advert $advert)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Advert $advert)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Advert $advert)
    {
        //
    }

    public function advertDetail($id)
    {

        $advert = Advert::findOrFail($id);

        $adverts = Advert::all();

        return view('adverts.advdetail', compact('advert'));
    }

    public function searchAdverts(Request $request)
    {
        $adverts = Advert::search($request->searched)->where('is_accepted', true)->paginate(10);

        return view('adverts.index', compact('adverts'));
    }

    public static function approvedAdvertsCount($userId)
    {
        return Advert::where('user_id', $userId)->where('is_accepted', true)->count();
    }

    public static function lastApprovedAdverts($userId, $count = 5)
    {
        return Advert::where('user_id', $userId)
            ->where('is_accepted', true)
            ->select('title', 'category_id')
            ->with('category:id,name')
            ->latest()
            ->take($count)
            ->get();
    }
}
