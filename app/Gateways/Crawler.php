<?php

namespace App\Gateways;

interface Crawler
{
    public function get(string $url);
}
