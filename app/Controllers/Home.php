<?php

namespace App\Controllers;

use App\Models\TodoModel;

class Home extends BaseController
{
    public function index()
    {
        $todoModel = new TodoModel();
        $data['todos'] = $todoModel->findAll();

        return view('todo_list', $data);
    }
}
