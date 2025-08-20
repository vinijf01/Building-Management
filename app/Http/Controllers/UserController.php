<?php

namespace App\Http\Controllers;

use App\Models\Properties;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function beranda(){
        $all = Properties::orderBy('created_at', 'desc')->get();
        $eksklusif = Properties::where('category', 'eksklusif')->get();
        $reguler = Properties::where('category', 'reguler')->get();

        return view('welcome', compact('eksklusif', 'reguler', 'all'));
    }

     // Show detail booking
    public function show($slug)
    {
        $product = Properties::where('slug', $slug)->firstOrFail();

        // Jika ingin menambahkan properti lain atau data tambahan
        $relatedProducts = Properties::where('slug', '!=', $slug)->take(10)->get();

        return view('productDetail', compact('product', 'relatedProducts'));
    }
}
