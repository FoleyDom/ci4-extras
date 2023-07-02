<?php

// TODO: Calender that shows the mood for each day and allows the user to click on a day to see the journal entry for that day.

// TODO: Mood tracking technology(Color coded somehow, thinking drop down menu with values of moods equaling a color.)

// TODO: Journal to help track mood and feelings.(This will be a seperate page)

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MoodsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class MoodsController extends BaseController
{
    public function __construct()
    {
        helper(['form', 'url', 'assets']);
        $this->session = session();
    }

    public function index()
    {
        $model = new MoodsModel();

        // Add assets using the assets helper

        // TODO: Add support for loading assets from a CDN
        // CSS assets
        $css = add_assets(['output.css'], 'css');
        // JS assets
        $js = add_assets(['delete.js', 'global.js'], 'js');
        // Get the assets output
        $assets = get_assets_output([$js, $css]);

        $data = [
            // Add assets to the data array
            // This will be used in the global header and footer
            'scripts' => $assets['js'],
            'styles' => $assets['css'],

            // title and tab_title are used in the global header
            'title' => 'Home Page',
            'tab_title' => 'Home Page'
        ];

        // ?: Figure out how to more efficiently display global header and footer.
        echo view('templates/global_header', $data);
        echo view('moods/index', $data);
        echo view('templates/global_footer', $data);
    }

    public function moods()
    {
        $model = new MoodsModel();

        // TODO: Calender that shows the mood for each day and allows the user to click on a day to see the journal entry for that day.

        // TODO: Mood tracking technology(Color coded somehow, thinking drop down menu with values of moods equaling a color.)

        // TODO: Journal to help track mood and feelings.(This will be a seperate page)

        $data = [
            'title' => 'Moods',
            'tab_title' => 'Moods'
        ];

        echo view('templates/global_header', $data);
        echo view('moods/moods', $data);
        echo view('templates/global_footer');
    }
}
