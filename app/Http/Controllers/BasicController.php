<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BasicController extends Controller
{
    public function index()
    {
        return view('homepage', ["title" => "Homepage"]);
    }

    public function about()
    {
        return view('about', [
            "nama" => "Ihsan Miftahul Huda",
            "job"  => "Web Developer",
            "alamat" => "Jl. Raya Cibaduyut No. 1",
            "image" => "profile.png"
        ]);
    }
}
