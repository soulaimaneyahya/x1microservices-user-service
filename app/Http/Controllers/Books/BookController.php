<?php

namespace App\Http\Controllers\Books;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\Books\BookService;
use App\Http\Controllers\Controller;
use App\Services\Authors\AuthorService;
use Symfony\Component\HttpFoundation\JsonResponse;

class BookController extends Controller
{
    use ApiResponser;

    /**
     * The service to consume the books microservice
     * @var BookService
     */
    public $bookService;

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
        return $this->successResponse($this->bookService->deleteBook($bookId));
    }
}
