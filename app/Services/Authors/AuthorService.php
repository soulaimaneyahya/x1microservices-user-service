<?php

namespace App\Services\Authors;

use App\Traits\RequestServices;

class AuthorService
{
    use RequestServices;

    /**
     * The base uri to consume the authors service
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
        $this->baseUri = config('services.authors.base_uri');
        $this->secret = config('services.authors.secret');
    }

    public function obtainAuthors(): array
    {
        return $this->performRequest('GET', '/authors');
    }

    public function createAuthor(array $data): array
    {
        return $this->performRequest('POST', '/authors', $data);
    }

    public function obtainAuthor(string $authorId): array
    {
        return $this->performRequest('GET', "/authors/{$authorId}");
    }

    public function editAuthor(array $data, string $authorId): array
    {
        return $this->performRequest('PUT', "/authors/{$authorId}", $data);
    }

    public function deleteAuthor(string $authorId): null
    {
        return $this->performRequest('DELETE', "/authors/{$authorId}");
    }
}
