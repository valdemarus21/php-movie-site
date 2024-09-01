<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Kernel\View\View;
use Exception;

class MovieController extends Controller
{
    /**
     * @throws Exception
     */
    public function index(): void
    {
        $view = new View();
        $view->page('movies');
    }

    public function add(): void
    {
        $this->view('admin/movies/add');
    }

    /**
     * @throws Exception
     */
    public function store(): void
    {

        $file = $this->request()->file('image');
        $filePath = $file->move('movies');

        dd($this->storage()->url($filePath));


        $validation = $this->request()->validate([
            'username' => ['required', 'min:3', 'max:50']
        ]);
        if (!$validation) {
            foreach ($this->request()->errors() as $field => $errors) {
                $this->session()->set($field, $this->request()->errors());
            }
            $this->redirect('/admin/movies/add');
        } else {
//            dd('validation passed');
            $id = $this->db()->insert('movies',
            ['name'=>$this->request()->input('username'),

                ]);

            dd('movie added successfully with id ' . $id);
        }
    }
}