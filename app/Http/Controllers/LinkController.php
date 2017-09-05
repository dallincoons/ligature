<?php

namespace App\Http\Controllers;

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
        //
    }

    public function store(Request $request)
    {
        $link = $this->repository->create($request->all());

        return response()->json($link, 201);
    }
}
