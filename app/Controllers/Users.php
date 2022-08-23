<?php

namespace App\Controllers;

use App\Models\NewsModel;

class Users extends BaseController
{
    public function index()
    {
        $model = model(UserModel::class);

        $data = [
            'User'  => $model->getUser(),
            'title' => "Données d'un utilisateur",
        ];

        return view('templates/header', $data)
            . view('news/overview')
            . view('templates/footer');
    }

    public function view($slug = null)
    {
        $model = model(UserModel::class);

        $data['users'] = $model->getUser($slug);

        if (empty($data['users'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the users item: ' . $slug);
        }

        $data['title'] = $data['users']['title'];

        return view('templates/header', $data)
            . view('users/view')
            . view('templates/footer');
    }

    public function create()
    {
        $model = model(UserModel::class);

        if ($this->request->getMethod() === 'post' && $this->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'age' => 'required',
            'weight' => 'required',
            'height' => 'required',
            'weight_goal' => 'required',
        ])) {
            $model->save([
                'firstname' => $this->request->getPost('firstname'),
                'lastname'  => $this->request->getPost('lastname'),
                'phone'  => $this->request->getPost('phone'),
                'age'  => $this->request->getPost('age'),
                'weight'  => $this->request->getPost('weight'),
                'height'  => $this->request->getPost('height'),
                'weight_goal'  => $this->request->getPost('weight_goal'),
                'bmi'  => $this->request->getPost('bmi'),
                
            ]);
            $data['success'] = "New User created successfully.";
            return view('templates/header', $data)
                . view('users/create')
                . view('templates/footer');
        }

        return view('templates/header', ['title' => 'Create a new user'])
            . view('users/create')
            . view('templates/footer');
    }

    

}