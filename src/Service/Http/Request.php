<?php

declare(strict_types=1);

namespace App\Service\Http;

final class Request
{
    private function get(array $parameters, string $key): mixed
    {
        return $this->has($parameters, $key) ? $parameters[$key] : null;
    }

    private function has(array $parameters, string $key): bool
    {
        return isset($parameters[$key]);
    }

   
    public function __construct(private array $query, private array $request, private array $server)
    {
    }

    
    public function getRequest(string $key): mixed
    {
        return $this->get($this->request, $key);
    }

    public function hasRequest(string $key): bool
    {
        return $this->has($this->request, $key);
    }

    public function getAllRequest(): ?array
    {
        return $this->request;
    }

    
    public function getQuery(string $key): mixed
    {
        return $this->get($this->query, $key);
    }

    public function hasQuery(string $key): bool
    {
        return $this->has($this->query, $key);
    }

  
    
    public function getServer(string $key): mixed
    {
        return $this->get($this->server, $key);
    }

    public function hasServer(string $key): bool
    {
        return $this->has($this->server, $key);
    }

    public function getMethod(): string
    {
        return $this->getServer('REQUEST_METHOD');
    }
}
