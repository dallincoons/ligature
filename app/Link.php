<?php

namespace App;

use App\Gateways\Crawler;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Link extends Model
{
    use Searchable;

    protected $fillable = [
        'description', 'url', 'read'
    ];

    protected $casts = [
        'read' => 'integer'
    ];

    /**
     * @param string $url
     * @return mixed
     */
    public static function getHeader(string $url)
    {
        $crawler = app(Crawler::class);

        return array_first($crawler->get($url)->filter('h1')->each(function($node){
            return $node->text();
        }));
    }

    /**
     * @param string $url
     * @return string
     */
    public static function prefixUrl(string $url)
    {
        if (starts_with($url, 'http://') || starts_with($url, 'https://')) {
            return $url;
        }

        return 'http://' . $url;
    }

    /**
     * @return bool
     */
    public function toggleRead()
    {
        $this->read = !$this->read;

        return $this->save();
    }
}
