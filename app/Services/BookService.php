<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class BookService
{
    use ConsumesExternalService;

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

    public function obtainBooks(): string
    {
        return $this->performRequest('GET', '/books');
    }

    public function createBook($data): string
    {
        return $this->performRequest('POST', '/books', $data);
    }

    public function obtainBook($bookId): string
    {
        return $this->performRequest('GET', "/books/{$bookId}");
    }

    public function editBook($data, $bookId): string
    {
        return $this->performRequest('PUT', "/books/{$bookId}", $data);
    }

    public function deleteBook($bookId): string
    {
        return $this->performRequest('DELETE', "/books/{$bookId}");
    }
}
