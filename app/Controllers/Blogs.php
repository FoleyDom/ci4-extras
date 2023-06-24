<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BlogsModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use SebastianBergmann\Template\Template;

class Blogs extends BaseController
{
    public function index()
    {
        $model = new BlogsModel();

        $data = [
            'news'  => $model->getNews(),
            'title' => 'News archive',
        ];

        echo view('templates/global_header', $data);
        echo view('blogs/index', $data);
        echo view('templates/global_footer');
    }

    public function view($slug = null)
    {
        $model = new BlogsModel();

        $data['news'] = $model->getNews($slug);

        if (empty($data['news']))
        {
            throw new PageNotFoundException('Cannot find the news item: '. $slug);
        }

        $data['title'] = $data['news']['title'];

        return view('templates/global_header', $data)
            . view('blogs/view', $data)
            . view('templates/global_footer');
    }

    public function create()
    {
        helper('form');

        // Checks whether the form is submitted.
        if (!$this->request->is('post')) 
        {
            // The form is not submitted, so returns the form.
            return view('templates/global_header', ['title' => 'Create a news item'])
                . view('blogs/create')
                . view('templates/global_footer');
        }

        $post = $this->request->getPost(['title', 'body']);

         // Checks whether the submitted data passed the validation rules.
         if (! $this->validateData($post, [
            'title' => 'required|max_length[255]|min_length[3]',
            'body'  => 'required|max_length[5000]|min_length[10]',
        ])) 
        {
            // The validation fails, so returns the form.
            return view('templates/global_header', ['title' => 'Create a news item'])
                . view('blogs/create')
                . view('templates/global_footer');
        }

        $model = new BlogsModel();

        // Saves the submitted data to the database.
        $model->save([
            'title' => $post['title'],
            'slug'  => url_title($post['title'], '-', true),
            'body'  => $post['body'],
        ]);

        return view('templates/global_header', ['title' => 'Create a news item'])
            . view('news/success')
            . view('templates/global_footer');

        // return view('Templates/global_header', ['title' => 'Create a news item'])
        //     . view('blogs/success')
        //     . view('Templates/global_footer');

        //! Sets a flash message to be displayed on the next page displayed.
        // session()->setFlashdata('success', 'News item created successfully.');

        // return redirect()->to('/news'); 
        
    }
}
