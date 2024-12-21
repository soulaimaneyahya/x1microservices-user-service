<?php

namespace App\Services\Books;

use App\Traits\RequestServices;

class BookService
{
    use RequestServices;

    /**
     * The base uri to consume the books service
     * @var string
     */
    public $baseUri;

    /**
     * The secret to consume the authors service
     * @var string
     */
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.books.base_uri');
        $this->secret = config('services.books.secret');
    }

    public function obtainBooks(): array
    {
        return $this->performRequest('GET', '/books');
    }

    public function createBook(array $data): array
    {
        return $this->performRequest('POST', '/books', $data);
    }

    public function obtainBook(string $bookId): array
    {
        return $this->performRequest('GET', "/books/{$bookId}");
    }

    public function editBook(array $data, string $bookId): array
    {
        return $this->performRequest('PUT', "/books/{$bookId}", $data);
    }

    public function deleteBook(string $bookId): null
    {
        return $this->performRequest('DELETE', "/books/{$bookId}");
    }
}
