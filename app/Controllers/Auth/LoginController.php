<?php

namespace App\Controllers\Auth;

use CodeIgniter\Controller;

class LoginController extends Controller
{
    
    public function index(){
        return view('login');
    }

    public function dashboard(){
        return view('dashboard');
    }

    // check email and password valid or not
    public function checkLogin(){
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        
        $db = \Config\Database::connect();
        $user = $db->table('users')->where('email', $email)->get()->getRowArray();
        if ($user) {
            if (password_verify($password, $user['password'])) {
                // get all user and permissions data and format and then store into session
                $userData = $db->table('users')
                ->select('users.user_id, users.first_name, users.last_name, users.profile_pic, permissions.permission_name') 
                ->join('user_roles', 'user_roles.user_id = users.user_id') 
                ->join('role_permissions', 'role_permissions.role_id = user_roles.role_id') 
                ->join('permissions', 'permissions.permission_id = role_permissions.permission_id') 
                ->where('users.user_id', $user['user_id'])
                ->get()
                ->getResultArray(); 
            
                $formattedData = [
                    'user_info' => [
                        'user_id' => $userData[0]['user_id'],
                        'first_name' => $userData[0]['first_name'],
                        'last_name' => $userData[0]['last_name'],
                        'profile_pic' => $userData[0]['profile_pic'],
                    ],
                    'permissions' => array_column($userData, 'permission_name'),
                ];
                
                $data['userData'] = $formattedData;
                session()->set('user_data', $formattedData);
                return view('dashboard',$formattedData);
            } else {
                session()->setFlashdata('error', 'Invalid email or password');
                return redirect()->to(base_url('/'));
            }
        } else {
            session()->setFlashdata('error', 'Invalid email or password');
            return redirect()->to(base_url('/'));
        }

    }
    // log out function
    public function logOut(){
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}