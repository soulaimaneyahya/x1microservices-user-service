<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\AuthorService;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthorController extends Controller
{
    use ApiResponser;

    /**
     * The service to consume the authors microservice
     * @var AuthorService
     */
    public $authorService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    public function index(): JsonResponse
    {
        return $this->successResponse($this->authorService->obtainAuthors());
    }

    public function store(Request $request): JsonResponse
    {
        return $this->successResponse($this->authorService->createAuthor($request->all(), Response::HTTP_CREATED));
    }

    public function show($authorId): JsonResponse
    {
        return $this->successResponse($this->authorService->obtainAuthor($authorId));
    }

    public function update(Request $request, $authorId): JsonResponse
    {
        return $this->successResponse($this->authorService->editAuthor($request->all(), $authorId));
    }

    public function destroy($authorId): JsonResponse
    {
        return $this->successResponse($this->authorService->deleteAuthor($authorId));
    }
}
