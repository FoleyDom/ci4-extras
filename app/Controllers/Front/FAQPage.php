<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;
use App\Models\MoodsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class FAQPage extends BaseController
{
    public function index()
    {
        //
    }

    public function faq()
    {
        helper(['form', 'url', 'assets']);

        // CSS assets
        $css = add_assets(['output.css'], 'css');
        // JS assets
        $js = add_assets(['global.js', 'faq.js'], 'js');
        // Get the assets output
        $assets = get_assets_output([$js, $css]);

        $model = new MoodsModel();

        $data = [
            // Add assets to the data array
            // This will be used in the global header and footer
            'scripts' => $assets['js'],
            'styles' => $assets['css'],

            'title' => 'FAQ',
            'tab_title' => 'FAQ Page'
        ];

        echo view('templates/global_header', $data);
        echo view('front/faqpage/faq', $data);
        echo view('templates/global_footer', $data);
    }
}
