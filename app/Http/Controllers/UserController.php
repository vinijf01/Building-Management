<?php

namespace App\Http\Controllers;

use App\Models\Properties;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function beranda()
    {
        $all = Properties::orderBy('created_at', 'desc')->get();
        $eksklusif = Properties::where('category', 'eksklusif')->take(4)->get();
        $reguler = Properties::where('category', 'reguler')->take(4)->get();

        return view('welcome', compact('eksklusif', 'reguler', 'all'));
    }

    public function show($slug)
    {
        $product = Properties::where('slug', $slug)->firstOrFail();
        $relatedProducts = Properties::where('slug', '!=', $slug)->take(10)->get();

        return view('productDetail', compact('product', 'relatedProducts'));
    }

    public function collection(Request $request)
    {
        $query = Properties::query();

        if ($request->search) {
            $search = strtolower($request->search);
            $query->where(function($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
                ->orWhereRaw('LOWER(description) LIKE ?', ["%{$search}%"])
                ->orWhereRaw('LOWER(category) LIKE ?', ["%{$search}%"]);
            });
        }
        if ($request->room_type) {
            $query->where('category', $request->room_type);
        }

        if ($request->price_from) {
            $query->where('price', '>=', $request->price_from);
        }

        if ($request->price_to) {
            $query->where('price', '<=', $request->price_to);
        }

        if ($request->sort_price) {
            $query->orderBy('price', $request->sort_price);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // $all = $query->get();
        $all = $query->paginate(12)->appends($request->all());


        return view('products', compact('all'));
    }

}
