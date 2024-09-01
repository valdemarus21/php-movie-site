<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\CategoryService;

class AdminController extends Controller
{
    private CategoryService $categoryService;

    /**
     * @throws \Exception
     */
    public function index():void
    {
        $categories = new CategoryService($this->db());
        $this->view('admin/index', [
            'categories'=>$categories->all()
        ]);

    }

}