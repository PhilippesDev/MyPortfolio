<?php

namespace App\Core;

class Router
{
    private Request $request;
    private array $routes = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get(string $path, $callback): void
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post(string $path, $callback): void
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        
        $callback = $this->routes[$method][$path] ?? false;

        // Support basique pour les paramètres d'URL dynamiques (ex: /{lang})
        if ($callback === false) {
            foreach ($this->routes[$method] as $route => $cb) {
                // Remplacer {param} par une regex
                $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<\1>[a-zA-Z0-9_-]+)', $route);
                $pattern = "@^" . $pattern . "$@D";
                
                if (preg_match($pattern, $path, $matches)) {
                    $callback = $cb;
                    
                    // Extraire les paramètres nommés
                    $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                    $this->request->setRouteParams($params);
                    break;
                }
            }
        }

        if ($callback === false) {
            http_response_code(404);
            echo "<h1>404 - Page Introuvable</h1>";
            return;
        }

        // Si le callback est un tableau (ex: [Controller::class, 'method'])
        if (is_array($callback)) {
            $controller = new $callback[0]();
            $callback[0] = $controller;
        }

        return call_user_func($callback, $this->request);
    }
}
