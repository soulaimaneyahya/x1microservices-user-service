<?php

namespace App\Http\Controllers\Books;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Services\Books\BookService;
use App\Http\Controllers\Controller;
use App\Services\Authors\AuthorService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class BookController extends Controller
{
    use ApiResponser;

    public BookService $bookService;
    public AuthorService $authorService;

    public function __construct(BookService $bookService, AuthorService $authorService)
    {
        $this->bookService = $bookService;
        $this->authorService = $authorService;
    }

    public function index(): JsonResponse
    {
        return $this->successResponse($this->bookService->obtainBooks());
    }

    public function store(Request $request): JsonResponse
    {
        $this->authorService->obtainAuthor($request->author_id);

        return $this->successResponse($this->bookService->createBook($request->all(), Response::HTTP_CREATED));
    }

    public function show($bookId): JsonResponse
    {
        return $this->successResponse($this->bookService->obtainBook($bookId));
    }

    public function update(Request $request, $bookId): JsonResponse
    {
        return $this->successResponse($this->bookService->editBook($request->all(), $bookId));
    }

    public function destroy($bookId): JsonResponse
    {
        return $this->jsonResponse($this->bookService->deleteBook($bookId), Response::HTTP_RESET_CONTENT);
    }
}
