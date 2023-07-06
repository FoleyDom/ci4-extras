<?php

// TODO: Calender that shows the mood for each day and allows the user to click on a day to see the journal entry for that day.

// TODO: Mood tracking technology(Color coded somehow, thinking drop down menu with values of moods equaling a color.)

// TODO: Journal to help track mood and feelings.(This will be a seperate page)

namespace App\Controllers\Front;

use App\Controllers\BaseController;
use App\Models\MoodsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class CalendarPage extends BaseController
{
    public function __construct()
    {
        helper(['form', 'url', 'assets']);
        $this->session = session();
    }

    public function index()
    {
        //
    }

    public function moods()
    {
        $model = new MoodsModel();

        // Add assets using the assets helper

        // TODO: Add support for loading assets from a CDN
        // CSS assets
        $css = add_assets(['output.css'], 'css');
        // JS assets
        $js = add_assets(['global.js', 'calendar.js'], 'js');
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
        echo view('front/components/calendar', $data);
        echo view('front/calendarpage/moods', $data);
        echo view('templates/global_footer', $data);
    }

    public function calendarAjax()
    {
        if ($this->request->isAJAX()) 
        {
            $query = $this->request->getPost();
            // var_dump($this->request->getPost('query'));
            $model = new MoodsModel();
            // Perform necessary operations using $model

            return json_encode(['success' => 'success', 'csrf' => csrf_hash(), 'query' => $query]);
        } 
        else 
        {
            return json_encode(['error' => 'error', 'csrf' => csrf_hash()]);
        }
    }
}
