<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AdminController extends BaseController
{
    public function index_admin()
    {
        $userModel = new UserModel();

        $getActiveUser = $userModel->where('is_active', 1)->findAll();
        $getInactiveUser = $userModel->where('is_active', 0)->findAll();

        $data = [
            'getActiveUser' => $getActiveUser,
            'getInactiveUser' => $getInactiveUser,
        ];
        return view('/admin/dashboard-user', $data);
    }

    public function user_admin_toggle($user_id) {
        $userModel = new UserModel();
        $getUser = $userModel->where('id', $user_id)->first();
        if (!empty($getUser)) {
            $updateData = [];
            if ($getUser['is_active'] == 0)
                $updateData['is_active'] = 1;
            if ($getUser['is_active'] == 1)
                $updateData['is_active'] = 0;
            $userModel->where('id', $getUser['id'])->set($updateData)->update();
            return redirect()->to('/admin/dashboard/user')->with('success', 'Success toggling User');
        } else {
            return redirect()->to('/admin/dashboard/user')->with('error', 'Error when toggling user');
        }
    }

    public function user_admin_create(){
        $email = $this->request->getVar('email');
        $role = $this->request->getVar('role');
        $umkm = $this->request->getVar('umkm');
        $password = $this->request->getVar('password');
        $confirmpassword = $this->request->getVar('confirmpassword');
        helper(['form']);
        $rules = [
            'email'                  => ['rules' => 'required|max_length[100]|valid_email|is_unique[users.email]',],
            'role'                   => ['rules' => 'required',],
            'password'               => ['rules' => 'required|max_length[100]'],
            'confirmpassword'        => ['rules' => 'matches[password]'],
        ];

        if($this->validate($rules)){
            $userModel = new UserModel();
            $data = [
                'email' => $email,
                'role' => $role,
                'umkm' => $umkm,
                'password' => password_hash($password, PASSWORD_BCRYPT)
            ];
            $userModel->save($data);
            return redirect()->to('/admin/dashboard/user')->with('success', 'Succesfully add new user');
        } else {
            return redirect()->to('/admin/dashboard/user')->with('errors', 'Error when adding new user');
        }
    }
    

    public function user_admin_delete($user_id) {
        $userModel = new UserModel();
        $getUser = $userModel->where('id', $user_id)->first();
        if (!empty($getUser)) {
            $userModel->where('id', $user_id)->delete();
            return redirect()->to('/admin/dashboard/user')->with('success', 'Success deleting user');
        }
        else return redirect()->to('/admin/dashboard/user')->with('error', 'Error when deleting user');
    }
}
