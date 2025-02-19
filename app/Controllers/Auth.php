<?php

namespace App\Controllers;

// Class controller AUTH
class Auth extends BaseController
{

    public function index()
    {
        $data = [
            'title' => 'Login Page',
        ];

        return view('/login', $data);
    }

    public function login()
    {
        $session = session();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        if ($username == 'admin' && $password == 'admin') {
            $session->set([
                'isLoggedIn' => true
            ]);
        } else {
            $session->setFlashdata('error', 'Username atau Password salah');
            return redirect()->to('/');
        }


        return  redirect()->to('/home');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
