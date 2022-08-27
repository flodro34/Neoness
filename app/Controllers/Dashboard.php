<?php

namespace App\Controllers;

use App\Models\NewsModel;

class Users extends BaseController
{
    public function index()
    {
        $data = array();


        return view('templates/header', $data)
            . view('dashboard')
            . view('templates/footer');
    }
    
}