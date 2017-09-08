<?php

namespace App\Http\Controllers;

use App\Link;
use App\Requests\UrlCheckStoreRequest;

class UrlCheckController
{
    public function store(UrlCheckStoreRequest $request)
    {
        return response()->json(['heading' => Link::getHeader($request->url)], 200);
    }
}
