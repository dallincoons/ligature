<?php

namespace App;

use App\Gateways\Crawler;
use App\Repositories\LinkRepository;
use App\Scopes\BelongsToAuthUser;
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

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new BelongsToAuthUser);

        static::creating(function($model){
            if(!$model->user_id){
                $model->user_id = \Auth::user()->getKey();
            }
        });
    }

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

    public static function duplicateExists($url)
    {
        $repository = app(LinkRepository::class);

        return $repository->findByField('url', $url)->count() > 0;
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
