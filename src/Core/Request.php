<?php

namespace App\Core;

class Request
{
    private array $routeParams = [];

    public function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function getPath(): string
    {
        $path = $_GET['url'] ?? '/';
        // Enlever le slash final s'il y en a un (sauf pour la racine)
        if ($path !== '/' && substr($path, -1) === '/') {
            $path = substr($path, 0, -1);
        }
        
        // Si url n'était pas vide mais ne commence pas par un slash, on l'ajoute
        if ($path !== '/' && strpos($path, '/') !== 0) {
            $path = '/' . $path;
        }

        return $path;
    }

    public function setRouteParams(array $params): self
    {
        $this->routeParams = $params;
        return $this;
    }

    public function getRouteParams(): array
    {
        return $this->routeParams;
    }
}
