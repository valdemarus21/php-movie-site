<?php

namespace App\Kernel\Router;

use App\Kernel\Auth\AuthInterface;
use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Http\Redirect;
use App\Kernel\Http\RedirectInterface;
use App\Kernel\Http\Request;
use App\Kernel\Http\RequestInterface;
use App\Kernel\Middleware\AbstractMiddleware;
use App\Kernel\Session\Session;
use App\Kernel\Session\SessionInterface;
use App\Kernel\Storage\StorageInterface;
use App\Kernel\View\View;
use App\Kernel\View\ViewInterface;

class Router implements RouterInterface
{
    private array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    /**
     * @param View $view
     * @param Request $request
     */
    public function __construct(
        private ViewInterface     $view,
        private RequestInterface  $request,
        private RedirectInterface $redirect,
        private SessionInterface  $session,
        private DatabaseInterface $database,
        private AuthInterface $auth,
        private StorageInterface $storage,
    )
    {
        $this->initRoutes();
    }

    private function notFound(): void
    {
        echo '404 | not found';
        exit;
    }

    private function findRoute($uri, $method): Route|false
    {

        if (!isset($this->routes[$method][$uri])) {
            return false;
        } else {
            return $this->routes[$method][$uri];
        }

    }

    public function dispatch(string $uri, string $method): void
    {
        $route = $this->findRoute($uri, $method);

        if (!$route) {
            $this->notFound();
            return;
        }
        if($route->hasMiddleware()){
            foreach ($route->getMiddlewares() as $middleware){
                /** @var AbstractMiddleware $middleware */
                $middleware = new $middleware($this->request, $this->auth, $this->redirect);
                $middleware->handle();
            }
        }
        if (is_array($route->getAction())) {

            /** @var TYPE_NAME $controller */
            /** @var TYPE_NAME $action */


            [$controller, $action] = $route->getAction();
            $controller = new $controller();
            call_user_func([$controller, 'setView'], $this->view);
            call_user_func([$controller, 'setRequest'], $this->request);
            call_user_func([$controller, 'setRedirect'], $this->redirect);
            call_user_func([$controller, 'setSession'], $this->session);
            call_user_func([$controller, 'setDatabase'], $this->database);
            call_user_func([$controller, 'setAuth'], $this->auth);
            call_user_func([$controller, 'setStorage'], $this->storage);
            call_user_func([$controller, $action]);
        } else {

            call_user_func($route->getAction());

        }


    }

    public function getRoutes(): array
    {
        return require_once APP_PATH . '/config/routes.php';
    }

    private function initRoutes()
    {
        $routes = $this->getRoutes();
        foreach ($routes as $route) {

            $this->routes[$route->getMethod()][$route->getUri()] = $route;
        }
    }
    /**
     * @return Route[]
     */
}