<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class AuthorService
{
    use ConsumesExternalService;

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

    public function obtainAuthors(): string
    {
        return $this->performRequest('GET', '/authors');
    }

    public function createAuthor($data): string
    {
        return $this->performRequest('POST', '/authors', $data);
    }

    public function obtainAuthor($authorId): string
    {
        return $this->performRequest('GET', "/authors/{$authorId}");
    }

    public function editAuthor($data, $authorId): string
    {
        return $this->performRequest('PUT', "/authors/{$authorId}", $data);
    }

    public function deleteAuthor($authorId): string
    {
        return $this->performRequest('DELETE', "/authors/{$authorId}");
    }
}
