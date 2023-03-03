<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarCodeController extends Controller
{
    public function index()
    {
        $variable = 'HERR-001';
        return view('barcode', compact('variable'));
    }
}
