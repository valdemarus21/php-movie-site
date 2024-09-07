<?php

namespace App\Kernel\View;

use App\Kernel\Auth\AuthInterface;
use App\Kernel\Exceptions\ViewNotFoundException;
use App\Kernel\Session\SessionInterface;
use App\Kernel\Storage\StorageInterface;

class View implements ViewInterface
{
    /**
     * @throws \Exception
     */
    public function __construct(
        private SessionInterface $session,
        private AuthInterface    $auth,
        private StorageInterface $storage,
    )
    {
    }

    private string $title;

    public function title() : string
    {
        return $this->title;
    }

    public function page(string $name, array $data = [], string $title = ''): void
    {
        $this->title = $title;
        extract(array_merge($this->defaultData(), $data));

        $viewPath = APP_PATH . "/views/pages/$name.php";
        if (!file_exists($viewPath)) {
            throw new ViewNotFoundException("Requested page is not found");
        } else {

            include_once $viewPath;

        }
    }

    /**
     * @param string $name
     * @param array $data
     * @throws ViewNotFoundException
     */
    public function component(string $name, array $data = []): void
    {
        $componentPath = APP_PATH . "/views/components/$name.php";
        if (!file_exists($componentPath)) {
            throw new ViewNotFoundException("component $name is not found");
        } else {
            extract(array_merge($this->defaultData(), $data));
            include $componentPath;

        }

    }

    private function defaultData(): array
    {
        return [
            'view' => $this,
            'session' => $this->session,
            'auth' => $this->auth,
            'storage' => $this->storage
        ];
    }
}