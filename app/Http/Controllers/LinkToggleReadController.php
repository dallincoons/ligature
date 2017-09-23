<?php

namespace App\Http\Controllers;

use App\Link;

class LinkToggleReadController extends Controller
{
    public function store(Link $link)
    {
        $read = $link->toggleRead();

        return response()->json($read, 200);
    }
}
