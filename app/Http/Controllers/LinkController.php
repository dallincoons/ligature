<?php

namespace App\Http\Controllers;

use App\Link;
use App\Repositories\LinkRepository;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    /**
     * @var LinkRepository
     */
    private $repository;

    public function __construct(LinkRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return response()->json($this->repository->all(), 200);
    }

    public function store(Request $request)
    {
        $this->repository->create($request->all());

        return response()->json($this->repository->all(), 201);
    }

    public function destroy(Link $link)
    {
        $link->delete();

        return response()->json($this->repository->all(), 200);
    }
}
