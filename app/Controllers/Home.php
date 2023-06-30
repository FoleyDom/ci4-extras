<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home Page',
            'tab_title' => 'Home Page'
        ];
        return view('Templates/global_header', $data) . view('Home_Page/home_page') . view('Templates/global_footer');
    }
}
