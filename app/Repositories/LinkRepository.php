<?php

namespace App\Repositories;

use App\Link;
use Prettus\Repository\Eloquent\BaseRepository;

class LinkRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Link::class;
    }
}
