<?php

// TODO: Calender that shows the mood for each day and allows the user to click on a day to see the journal entry for that day.

// TODO: Mood tracking technology(Color coded somehow, thinking drop down menu with values of moods equaling a color.)

// TODO: Journal to help track mood and feelings.(This will be a seperate page)

namespace App\Controllers\Front;

use App\Controllers\BaseController;
use App\Models\MoodsModel;
use CodeIgniter\Database\Query;
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
        $js = add_assets(['global.js'], 'js');
        // Get the assets output
        $assets = get_assets_output([$js, $css]);


        $data = [
            // Add assets to the data array
            // This will be used in the global header and footer
            'scripts' => $assets['js'],
            'styles' => $assets['css'],

            // title and tab_title are used in the global header
            'title' => 'Calendar Page',
            'tab_title' => 'Home Page'
        ];

        // ?: Figure out how to more efficiently display global header and footer.
        echo view('front/calendarpage/test', $data);
    }

    public function calendarAjax()
    {
        if ($this->request->isAJAX()) {
            $eventTitle = $this->request->getPost('event_title');
            $eventTheme = $this->request->getPost('event_theme');
            $eventDate = $this->request->getPost('event_date');

            // Validate the data if needed
            // if (!$this->validate([
            //     'event_title' => 'required|max_length[255]|min_length[3]',
            // ])) {
            //     return json_encode(['error' => 'Validation failed']);
            // }

            $model = new MoodsModel();

            // Return a success response
            return json_encode(['success' => 'Event saved successfully', 'data' => ['event_title' => $eventTitle, 'event_theme' => $eventTheme, 'event_date' => $eventDate]]);
        } else {
            // Return an error response if the request is not AJAX
            return json_encode(['error' => 'Invalid request']);
        }
    }
}
