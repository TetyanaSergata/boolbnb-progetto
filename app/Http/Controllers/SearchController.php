<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request) {
        $data = $request->all();
        return view('search', compact('data'));
    }
}
