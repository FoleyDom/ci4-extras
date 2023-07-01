<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MoodsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class MoodsController extends BaseController
{
    public function index()
    {
        $model = new MoodsModel();

        $data = [
            'title' => 'Home Page',
            'tab_title' => 'Home Page'
        ];

        echo view('templates/global_header', $data);
        echo view('moods/index', $data);
        echo view('templates/global_footer');
    }
}
