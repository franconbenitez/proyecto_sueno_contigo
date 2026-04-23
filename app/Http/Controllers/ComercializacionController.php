<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComercializacionController extends Controller
{
    public function index()
    {
        return view('comercializacion');
    }
}