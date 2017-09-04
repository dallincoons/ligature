<?php

namespace App\Http\Controllers;

use App\Requests\UrlCheckStoreRequest;

class UrlCheckController
{
    public function store(UrlCheckStoreRequest $request)
    {
        $crawler = \Goutte::request('GET', $request->url);

        $h1Text = array_first($crawler->filter('h1')->each(function($node){
            return $node->text();
        }));

        return response()->json(['heading' => $h1Text], 200);
    }
}
