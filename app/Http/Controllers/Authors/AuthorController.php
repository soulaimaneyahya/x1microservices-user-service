<?php

namespace App\Http\Controllers\Authors;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Authors\AuthorService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthorController extends Controller
{
    use ApiResponser;

    public function __construct(
        public AuthorService $authorService
    ) {
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
        return $this->jsonResponse($this->authorService->deleteAuthor($authorId), Response::HTTP_RESET_CONTENT);
    }
}
