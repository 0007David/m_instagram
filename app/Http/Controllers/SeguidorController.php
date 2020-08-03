<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeguidorController extends Controller
{
    public function index()
    {
        return view('seguido');
    }
}
