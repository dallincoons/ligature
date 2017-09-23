<?php

namespace App\Http\Controllers;

use App\Link;
use App\Requests\UrlCheckStoreRequest;

class UrlCheckController extends Controller
{
    public function store(UrlCheckStoreRequest $request)
    {
        $preparedUrl = Link::prefixUrl($request->url);

        return response()->json(['heading' => Link::getHeader($preparedUrl), 'url' => $preparedUrl], 200);
    }
}
