<?php

namespace App;

use App\Gateways\Crawler;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = [
        'description', 'url'
    ];

    public static function getHeader($url)
    {
        $crawler = app(Crawler::class);

        return array_first($crawler->get($url)->filter('h1')->each(function($node){
            return $node->text();
        }));
    }

    public static function prefixUrl($url)
    {
        if (starts_with($url, 'http://') || starts_with($url, 'https://')) {
            return $url;
        }

        return 'http://' . $url;
    }
}
