<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InformacionController extends Controller
{
    /**
     * Muestra la página de información general.
     */
    public function index()
    {
        return view('informacion');
    }
}