<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BlogsModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\Session\Session;

class Blogs extends BaseController
{
    protected $helpers = ['form', 'url'];

    public function __construct()
    {
        $this->session = session();
    }

    public function index()
    {
        $model = new BlogsModel();

        $data = [
            'news'  => $model->getNews(),
            'title' => 'News archive',
            'tab_title' => 'News archive',
        ];

        echo view('templates/global_header', $data);
        echo view('blogs/index', $data);
        echo view('templates/global_footer');
    }

    public function view($slug = null)
    {
        $model = new BlogsModel();

        $data = [
            'news' => $model->getNews($slug),
            'tab_title' => 'News archive',
        ];

        if (empty($data['news']))
        {
            throw new PageNotFoundException('Cannot find the news item: '. $slug);
        }

        $data['title'] = $data['news']['title'];

        return view('templates/global_header', $data)
            . view('blogs/view')
            . view('templates/global_footer');
    }

    public function create()
    {
        helper('form');

        // Checks whether the form is submitted.
        if (!$this->request->is('post')) 
        {
            // The form is not submitted, so returns the form.
            return view('templates/global_header', ['tab_title' => 'test title' ,'title' => 'Create a news item'])
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
            return view('templates/global_header', ['tab_title' => 'test title' ,'title' => 'Create a news item'])
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

        // return view('Templates/global_header', ['title' => 'Create a news item'])
        //     . view('blogs/success')
        //     . view('Templates/global_footer');

        $success = [
            'message' => 'News item created successfully.',
        ];

        //! Sets a flash message to be displayed on the next page displayed.
        $this->session->setFlashdata($success);

        return redirect()->to('/'); 
        
    }

    public function delete()
    {
        $model = new BlogsModel();
        $id = $this->request->getUri()->getSegment(3);

        $model->deleteNews($id);

        $this->session->setFlashdata('success', 'News item deleted successfully.');
        return redirect()->to('/');
    }

    public function edit()
    {
        helper('form');

        $model = new BlogsModel();

        $id = $this->request->getUri()->getSegment(3);

        $data = [
            'news' => $model->getNews($id),
            'title' => 'Edit a news item',
            'tab_title' => 'Edit a news item',
        ];

        if (empty($data['news']))
        {
            throw new PageNotFoundException('Cannot find the news item: '. $id);
        }

        // Checks whether the form is submitted.
        if (!$this->request->is('post')) 
        {
            // The form is not submitted, so returns the form.
            return view('templates/global_header', $data)
                . view('blogs/edit')
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
            return view('templates/global_header', $data)
                . view('blogs/edit')
                . view('templates/global_footer');
        }

        // Saves the submitted data to the database.
        $model->update($id, [
            'title' => $post['title'],
            'slug'  => url_title($post['title'], '-', true),
            'body'  => $post['body'],
        ]);

        $success = [
            'message' => 'News item updated successfully.',
        ];

        //! Sets a flash message to be displayed on the next page displayed.
        $this->session->setFlashdata($success);

        return redirect()->to('/');
    }
}
