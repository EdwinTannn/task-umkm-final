<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\ItemModel;

class AuthController extends BaseController
{
    public function index()
    {
        $itemModel = new ItemModel();
        $category = $this->request->getGet('category'); // Get the category from the query string
        if (!empty($category)) {
            $getItem = $itemModel->where('category', $category)->findAll(); // Filter items by category
        } else {
            $getItem = $itemModel->findAll(); // Get all items
        }
        helper(['form']);
        $data = [
            'getItem' => $getItem,
        ];
        return view('/index', $data);
    }
    

    public function register_post() {
        $email = $this->request->getVar('email');
        $umkm = $this->request->getVar('umkm');
        $password = $this->request->getVar('password');
        helper(['form']);
        $rules = [
            'email'         => ['rules' => 'required|max_length[100]|valid_email|is_unique[users.email]'],
            'umkm'      => ['rules' => 'required|max_length[100]'],
            'password'      => ['rules' => 'required|max_length[100]'],
            'confirmpassword'  => ['rules' => 'matches[password]'],
        ];

        if($this->validate($rules)){
            $userModel = new UserModel();
            $data = [
                'email'    => $email,
                'role'     => 'member',
                'umkm'     => $umkm,
                'password' => password_hash($password, PASSWORD_BCRYPT)
            ];
            $userModel->save($data);
            return redirect()->to('/')->with('success', 'Successfully registered an account, contact the admin to activate your account');
        } else {
            return redirect()->to('/')->with('errors', 'Register Error');
        }
    }

    public function login_post() {
        $userModel = new UserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        
        $getUser = $userModel->where('email', $email)->first();
        if($getUser){
            if ($getUser['is_active'] == 1) {
                $pass = $getUser['password'];
                $password_match = password_verify($password, $pass);
                if($password_match == true){
                    $session_data = [
                        'id' => $getUser['id'],
                        'email' => $getUser['email'],
                        'role' => $getUser['role'],
                        'umkm' => $getUser['umkm'],
                        'is_logged_in' => TRUE,
                    ];
                    $this->session->set($session_data);
                    return redirect()->to('/');
                
                } else {
                    return redirect()->to('/')->with('msg', 'Password is incorrect');
                    // $data['error'] = 'Password is incorrect';
                }
            } else {
                return redirect()->to('/')->with('msg', 'Account is not activated yet');
                // $data['error'] = 'Account is not activated yet';
            }
        } else {
            return redirect()->to('/')->with('msg', 'Email doesnt exist');
            // $data['error'] = 'Email doesnt exist';
        }

        // $data['modal'] = 'login';
        // $data['email'] = $email;
        // $data['password'] = $password;

        // return view('/index', $data);
    }

    public function logout() {
        $this->session->destroy();
        return redirect()->to('/');
    }
}
