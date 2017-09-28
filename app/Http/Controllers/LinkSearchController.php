<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;

class LinkSearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('query');

        $links = Link::search($query)->get();

        return response()->json($links, 200);
    }
}
