<?php

namespace App\Http\Controllers;

use App\Http\Criteria\SortByCreatedAt;
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

    /**
     * LinkController constructor.
     * @param LinkRepository $repository
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function __construct(LinkRepository $repository)
    {
        $this->repository = $repository;
        $this->repository->pushCriteria(new SortByCreatedAt);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json($this->repository->paginate(self::PAGINATE_LIMIT), 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
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

    /**
     * @param Link $link
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Link $link)
    {
        $link->delete();

        return response()->json($this->repository->all(), 200);
    }
}
