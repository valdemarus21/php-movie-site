<?php

namespace App\Kernel\Controller;

use App\Kernel\Auth\AuthInterface;
use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Http\Redirect;
use App\Kernel\Http\RedirectInterface;
use App\Kernel\Http\Request;
use App\Kernel\Http\RequestInterface;
use App\Kernel\Session\Session;
use App\Kernel\Session\SessionInterface;
use App\Kernel\Storage\StorageInterface;
use App\Kernel\View\View;
use App\Kernel\View\ViewInterface;

abstract class Controller
{
    private ViewInterface $view;
    private RequestInterface $request;

    private RedirectInterface $redirect;
    private SessionInterface $session;
    private DatabaseInterface $database;

    private AuthInterface $auth;
    private StorageInterface $storage;
    public function storage():StorageInterface
    {
        return $this->storage;
    }
    public function setStorage(StorageInterface $storage): void
    {
        $this->storage = $storage;
    }
    public function getAuth(): AuthInterface
    {
        return $this->auth;
    }

    public function setAuth(AuthInterface $auth): void
    {
        $this->auth = $auth;
    }
    /**
     * @throws \Exception
     */
    public function view(string $name, array $data = [], string $title = ''): void
    {
        $this->view->page($name, $data, $title);
    }
    public function db():DatabaseInterface
    {
        return $this->database;
    }
    public function setDatabase(DatabaseInterface $database):void
    {
        $this->database = $database;
    }
    public function setView(ViewInterface $view): void
    {
        $this->view = $view;
    }

    public function request(): RequestInterface
    {
        return $this->request;
    }

    public function setRequest(RequestInterface $request): void
    {
        $this->request = $request;
    }

    public function setRedirect(RedirectInterface $redirect): void
    {
        $this->redirect = $redirect;
    }

    public function redirect(string $url): RedirectInterface
    {
        return $this->redirect->to($url);
    }

    public function session(): SessionInterface
    {
        return $this->session;
    }

    public function setSession(SessionInterface $session): void
    {
        $this->session = $session;
    }
}