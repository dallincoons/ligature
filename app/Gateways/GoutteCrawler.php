<?php

namespace App\Gateways;

class GoutteCrawler implements Crawler
{
    public function get(string $url)
    {
        return \Goutte::request('GET', $url);
    }
}
