<?php

namespace App\Controllers;

use App\Models\NewsModel;

class Users extends BaseController
{
    public function index()
    {
        $model = model(UserModel::class);

        $data = [
            'users'  => $model->getUser(),
            'title' => "Liste des utilisateurs",
        ];

        return view('templates/header', $data)
            . view('users/overview')
            . view('templates/footer');
    }

    public function view()
    {
        $model = model(UserModel::class);

        $data['users'] = $model->getUser();
        
        if (empty($data['users'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the users item: ');
        }

        $data['title'] = $data['users']['firstname'];

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
            'email' => 'required',
            'password' => 'required',
            'phone' => 'required',
            'age' => 'required',
            'weight' => 'required',
            'height' => 'required',
            'weight_goal' => 'required',
            'bmi' => 'required',

        ])) {
            $model->save([
                'firstname' => $this->request->getPost('firstname'),
                'lastname' => $this->request->getPost('lastname'),
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
                'phone' => $this->request->getPost('phone'),
                'age' => $this->request->getPost('age'),
                'weight' => $this->request->getPost('weight'),
                'height' => $this->request->getPost('height'),
                'weight_goal' => $this->request->getPost('weight_goal'),
                'bmi'  => $this->request->getPost('bmi'),
                // 'slug'  => url_title($this->request->getPost('firstname', 'lastname'),'-', true),
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

    public function update()
    {
        $model = model(UserModel::class);
        $id = 15;
        // var_dump($_POST);
        // exit;
        if ($this->request->getMethod() === 'post' && $this->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'age' => 'required',
            'weight' => 'required',
            'height' => 'required',
            'weight_goal' => 'required',
            
        ])) {

            
            $data['users']  =  [ 
                'id'=> $id,
                'firstname' => $this->request->getPost('firstname'),
                'lastname'  => $this->request->getPost('lastname'),
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
                'phone'  => $this->request->getPost('phone'),
                'age'  => $this->request->getPost('age'),
                'weight'  => $this->request->getPost('weight'),
                'height'  => $this->request->getPost('height'),
                'weight_goal'  => $this->request->getPost('weight_goal'),
                'bmi'  => $this->request->getPost('bmi'),
                
            ];
            $model->update($id, $data['users']);
            $data['success'] = "User modified successfully.";

            return view('templates/header', $data)
                . view('users/update')
                . view('templates/footer');
        }else {
            $data['users'] = $model->where('id', $id )->first();
        }

        return view('templates/header', $data)
            . view('users/update')
            . view('templates/footer');
    }

    public function login()
    {
        //var_dump($_POST);
        //exit;
        
        $data = array();
        $model = model(UserModel::class);
        $rules =[
            'email' => 'required|valid_email', 
            'password' => 'required|validateUser[email,password]',                     
            ];
        $error = [
            'password' => [
                'validateUser'=> "Password or email invalid !"
            ]
            ];
        
        if($this->request->getMethod() == 'post') {
            var_dump($_POST);
            exit;             
            if(!$this->validate($rules, $error)){
            $data ['error'] = $this->validator;
            } 
            else{
                $email = $this->request->getPost('email');
                $user = $model->where('email', $email)->first();
                $this->setUserSession($user);
                return redirect()->to ('users/overview');
            }
        }
        return view('templates/header', $data)
        . view('users/login')
        . view('templates/footer');
    }

    //fct pour init la session
    private function setUserSession($user)
    {
        $data =[
            'id'=> $user['id'],
            'firstname' => $user['firstname'],
            'lastname'  =>$user ['lastname'],
            'email' => $user ['email'],
            'password' => $user ['password'],
            'phone'  => $user ['phone'],
            'age'  =>$user ['age'],
            'weight'  => $user ['weight'],
            'height'  => $user ['height'],
            'weight_goal'  => $user ['weight_goal'],
            'bmi'  => $user ['bmi'],
        ];
        session()->set($data);
        return true;
    }

    
    public function delete()
    {
        $model = model(UserModel::class);

        if ($this->request->getMethod() === 'post' && $this->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'password' => 'required',
            'phone' => 'required',
            'age' => 'required',
            'weight' => 'required',
            'height' => 'required',
            'weight_goal' => 'required',
            'bmi' => 'required',

        ])) {
            $model->delete([
                'firstname' => $this->request->getPost('firstname'),
                'lastname' => $this->request->getPost('lastname'),
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
                'phone' => $this->request->getPost('phone'),
                'age' => $this->request->getPost('age'),
                'weight' => $this->request->getPost('weight'),
                'height' => $this->request->getPost('height'),
                'weight_goal' => $this->request->getPost('weight_goal'),
                'bmi'  => $this->request->getPost('bmi'),
                // 'slug'  => url_title($this->request->getPost('firstname', 'lastname'),'-', true),
            ]);
            $data['success'] = "New User deleted successfully.";
            return view('templates/header', $data)
                . view('users/delete')
                . view('templates/footer');
        }


    }

}