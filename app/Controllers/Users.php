<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    // public function index1()
    // {
        
    //     $model = model(UserModel::class);

    //     $data = [
    //         'users'  => $model->getUser(),
    //         'title' => "Liste des utilisateurs",
    //     ];

    //     return view('templates/header', $data)
    //         // . view('users/overview')
    //         . view('login')
    //         . view('templates/footer');
    // }
    public function home()
    {
        var_dump('boubou');
        helper(['form']);
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

        // $data['title'] = $data['users']['firstname'];

        return view('templates/header', $data)
            . view('users/view')
            . view('templates/footer');
    }

    // public function create()
    // {
    //     $model = model(UserModel::class);
        
    //     if ($this->request->getMethod() === 'post' && $this->validate([
    //         'firstname' => 'required|min_length[3]|max_length[20]',
    //         'lastname' => 'required|min_length[3]|max_length[20]',
    //         'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]',
    //         'password' => 'required|min_length[8]|max_length[255]',
    //         'password_confirm' => 'matches[password]',
    //         'phone' => 'required',
    //         'age' => 'required',
    //         'weight' => 'required',
    //         'height' => 'required',
    //         'weight_goal' => 'required',
    //         'bmi' => 'required',

    //     ])) {
    //         $model->save([
    //             'firstname' => $this->request->getPost('firstname'),
    //             'lastname' => $this->request->getPost('lastname'),
    //             'email' => $this->request->getPost('email'),
    //             'password' => $this->request->getPost('password'),
    //             'phone' => $this->request->getPost('phone'),
    //             'age' => $this->request->getPost('age'),
    //             'weight' => $this->request->getPost('weight'),
    //             'height' => $this->request->getPost('height'),
    //             'weight_goal' => $this->request->getPost('weight_goal'),
    //             'bmi'  => $this->request->getPost('bmi'),
    //             // 'slug'  => url_title($this->request->getPost('firstname', 'lastname'),'-', true),
    //         ]);
    //         
    //     }

    //     return view('templates/header')
    //         . view('users/create')
    //         . view('templates/footer');
    // }

    // public function test()
    // {
    //     $model = model(UserModel::class);
        
    // }
    
    public function index()
    {
        $data= array();
        helper(['form']);
        var_dump($_POST);
        
            if($this->request->getMethod() == 'POST')
            {
        
                //validation
                $rules = [

                    'email' => 'required|min_length[6]|max_length[50]|valid_email',
                    'password' => 'required|min_length[2]|max_length[255]|validateUser[email, password]',
                ];
                var_dump('bb');
                $errors = [
                    'password' => [
                        'validateUser' => 'Email or Password not valid'
                    ]
                ];
                
                if (!$this->validate($rules,  $errors)){
                    $data['validation'] = $this->validator;
                }else{
                    var_dump('tata');
                    $model = model(UserModel::class);

                    $user = $model->where('email', $this->request->getVar('email'))->first();
                   
                    $this->setUserSession($user);
                    
                    //$session->setFlashdata('success', 'Sucessful Registration');
                    //$data['success'] = "New User created successfully.";

                    return redirect()->to('dashboard'); 
    
                    }
            }

        return view('templates/header', $data)
        . view('login')
        . view('templates/footer');
    }

    //fct pour init la session
    private function setUserSession($user)
    {
        $data =[
            'id'=> $user['id'],
            'firstname' => $user['firstname'],
            'lastname'  => $user ['lastname'],
            'email' => $user ['email'],
            'isLoggedIn' => true,
        ];
        session()->set($data);
        return true;
    }
        
    public function registerAndRedirect()
    {        
        $data= array();
        helper(['form']);

            if ($this->request->getMethod() == 'post')
            {
                //validation
                $rules = [
                    'firstname' => 'required|min_length[3]|max_length[20]',
                    'lastname' => 'required|min_length[3]|max_length[20]',
                    'email' => 'required|min_length[6]|max_length[50]|valid_email',
                    'password' => 'required|min_length[2]|max_length[255]',
                    'password_confirm' => 'matches[password]',
                    'phone' => 'required',
                    'age' => 'required',
                    'weight' => 'required',
                    'height' => 'required',
                    'weight_goal' => 'required',
                    'bmi' => 'required',
                ];
                if (!$this->validate($rules)){
                    $data['validation'] = $this->validator;
                }else{
                    $model = model(UserModel::class);
                    $model->save([
                        'firstname' => $this->request->getVar('firstname'),
                        'lastname' => $this->request->getVar('lastname'),
                        'email' => $this->request->getVar('email'),
                        'password' => $this->request->getVar('password'),
                        'phone' => $this->request->getVar('phone'),
                        'age' => $this->request->getVar('age'),
                        'weight' => $this->request->getVar('weight'),
                        'height' => $this->request->getVar('height'),
                        'weight_goal' => $this->request->getVar('weight_goal'),
                        'bmi'  => $this->request->getVar('bmi'),
                        // 'slug'  => url_title($this->request->getVar('firstname', 'lastname'),'-', true),
                        ]);

                        $session = session();
                        $session->setFlashdata('success', 'Sucessful Registration');
                        //$data['success'] = "New User created successfully.";

                        return redirect()->to('/'); //redirection à la racine

                }
            }

        return view('templates/header', $data)
            . view('register')
            . view('templates/footer');
    }

    // public function update()
    // {
    //     $model = model(UserModel::class);
    //     $id = 15;
    //     // var_dump($_POST);
    //     // exit;
    //     if ($this->request->getMethod() === 'post' && $this->validate([
    //         'firstname' => 'required',
    //         'lastname' => 'required',
    //         'phone' => 'required',
    //         'age' => 'required',
    //         'weight' => 'required',
    //         'height' => 'required',
    //         'weight_goal' => 'required',
            
    //     ])) {

            
    //         $data['users']  =  [ 
    //             'id'=> $id,
    //             'firstname' => $this->request->getPost('firstname'),
    //             'lastname'  => $this->request->getPost('lastname'),
    //             'email' => $this->request->getPost('email'),
    //             'password' => $this->request->getPost('password'),
    //             'phone'  => $this->request->getPost('phone'),
    //             'age'  => $this->request->getPost('age'),
    //             'weight'  => $this->request->getPost('weight'),
    //             'height'  => $this->request->getPost('height'),
    //             'weight_goal'  => $this->request->getPost('weight_goal'),
    //             'bmi'  => $this->request->getPost('bmi'),
                
    //         ];
    //         $model->update($id, $data['users']);
    //         $data['success'] = "User modified successfully.";

    //         return view('templates/header', $data)
    //             . view('users/update')
    //             . view('templates/footer');
    //     }else {
    //         $data['users'] = $model->where('id', $id )->first();
    //     }

    //     return view('templates/header', $data)
    //         . view('users/update')
    //         . view('templates/footer');
    // }

    // public function login()
    // {
    //     //var_dump($_POST);
    //     //exit;
    //     helper(['form']);

    //     $data = array();
    //     $model = model(UserModel::class);
    //     $rules = [
    //         'email' => 'required|valid_email|is_unique[users.email]', 
    //         'password' => 'required|validateUser[email,password]',
    //         'password_confirm' => 'matches[password]',                    
    //         ];
    //     $error = [
    //         'password' => [
    //         'validateUser'=> "Password or email invalid !"
    //         ]
    //         ];
        
    //     if($this->request->getMethod() == 'post') {
    //         // var_dump($_POST);
    //         // exit;             
    //         if(!$this->validate($rules, $error)){
    //         $data['error'] = $this->validator;
    //         } 
    //         else{
    //             $email = $this->request->getPost('email');
    //             $user = $model->where('email', $email)->first();
    //             $this->setUserSession($user);
    //             return redirect()->to ('users/overview');
    //         }
    //     }
    //     return view('templates/header', $data)
    //     . view('login')
    //     . view('templates/footer');
    // }
    
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