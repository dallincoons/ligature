<?php

namespace App\Http\Controllers;

use App\Link;
use App\Repositories\LinkRepository;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    const PAGINATE_LIMIT = 15;

    /**
     * @var LinkRepository
     */
    private $repository;

    public function __construct(LinkRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        return response()->json($this->repository->paginate(self::PAGINATE_LIMIT), 200);
    }

    public function store(Request $request)
    {
        if (Link::duplicateExists($request->url)) {
            return response()->json([
                'error' => 'Url has already been stored: ' . $request->url
            ], 422);
        }

        $this->repository->create($request->all());

        return response()->json($this->repository->all(), 201);
    }

    public function destroy(Link $link)
    {
        $link->delete();

        return response()->json($this->repository->all(), 200);
    }
}
