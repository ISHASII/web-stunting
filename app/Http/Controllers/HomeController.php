<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Puskesmas;

class HomeController extends Controller
{
    public function index()
    {
        $galleries = Gallery::orderBy('created_at', 'desc')->limit(6)->get();
        $puskesmas = Puskesmas::first();

        return view('public.home', compact('galleries', 'puskesmas'));
    }
}
