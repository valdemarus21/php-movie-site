<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class LoginController extends Controller
{

    /**
     * @throws \Exception
     */
    public function index(): void
    {
        $this->view('login');
    }
    public function login(): void
    {

        $email = $this->request()->input('email');
        $password = $this->request()->input('password');


        if($this->getAuth()->attempt($email, $password)){

        $this->redirect('/');
        }
        $this->session()->set('error', 'Invalid credentials');
        $this->redirect('/login');

    }
    public function logout()
    {
        $this->getAuth()->logout();
        return $this->redirect('/login');
    }

}