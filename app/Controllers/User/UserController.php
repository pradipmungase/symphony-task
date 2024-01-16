<?php

namespace App\Controllers\User;

use CodeIgniter\Controller;

class UserController extends Controller
{
    public function __construct(){
        helper('url');
    }

    // view all user
    public function index(){
        $db = \Config\Database::connect();
        $data['users'] = $db->table('users')
        ->where('deleted_at', null) 
        ->get()
        ->getResultArray();
        return view('User/viewAllUser',$data);
    }
    // create user html form
    public function createUser(): string{
        $db = \Config\Database::connect(); 
        $data['roles']  = $db->table('roles')->get()->getResultArray();
        return view('User/addNewUser', $data);
    }

    // add user logic
    public function addNewUser(){
        $email = $this->request->getPost('email');
        // check email already register or not if already register then return error mess
        if (!$this->isEmailUnique($email)) {
            session()->setFlashdata('error', 'Email is already registered!');
            return redirect()->to(previous_url());
        }

        // profile pic upload code
        $profilePic = $this->request->getFile('profile_pic');
        if ($profilePic->isValid() && !$profilePic->hasMoved()) {
            $newName = $profilePic->getRandomName();
            $profilePic->move(ROOTPATH . 'public/uploads/profile_pics', $newName);
        } else {
            session()->setFlashdata('error', 'Failed to upload profile picture!');
            // return redirect()->to(base_url('/AddNewUser'));
            return redirect()->to(previous_url());
        }

        $userData = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'email' => $email,
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'dob' => $this->request->getPost('dob'),
            'gender' => $this->request->getPost('gender'),
            'profile_pic' => $newName, 
            'address' => $this->request->getPost('address'),
        ];

        $db = \Config\Database::connect(); 
        $db->table('users')->insert($userData);
        $user_id = $db->insertID();

        $roleData = [
            'user_id' => $user_id,
            'role_id' => $this->request->getPost('role'),
        ];
        $db->table('user_roles')->insert($roleData);
        if ($db->affectedRows()) {
            session()->setFlashdata('success', 'Registraion successfully!');
            return redirect()->to(previous_url());
        } else {
            session()->setFlashdata('error', 'Failed to add data!');
        }
        return redirect()->to(previous_url());
    }

    // check email already register function
    private function isEmailUnique($email){
        $db = \Config\Database::connect();
        $result = $db->table('users')->getWhere(['email' => $email])->getRow();
        return empty($result); 
    }
    
    // view specific user
    public function viewUser($user_id){
        $db = \Config\Database::connect();
        // get all user data with all permissions and roles
        $userData = $db->table('users')
        ->select('users.*, permissions.permission_name') 
        ->join('user_roles', 'user_roles.user_id = users.user_id') 
        ->join('role_permissions', 'role_permissions.role_id = user_roles.role_id') 
        ->join('permissions', 'permissions.permission_id = role_permissions.permission_id') 
        ->where('users.user_id', $user_id)
        ->get()
        ->getResultArray(); 

        $formattedData = [
            'user_info' => [
                'user_id' => $userData[0]['user_id'],
                'first_name' => $userData[0]['first_name'],
                'last_name' => $userData[0]['last_name'],
                'profile_pic' => $userData[0]['profile_pic'],
                'address' => $userData[0]['address'],
                'email' => $userData[0]['email'],
                'dob' => $userData[0]['dob'],
                'gender' => $userData[0]['gender'],
            ],
            'permissions' => array_column($userData, 'permission_name'),
        ];
        $data['userData'] = $formattedData;
        return view('user/viewUser',$data);
    }

    public function deleteUser($user_id){
       $db = \Config\Database::connect();
       // just update deleted at colume
       $result = $db->table('users')->where('user_id', $user_id)->update(['deleted_at' => date('Y-m-d H:i:s')]);
        if ($result) {
            return redirect()->to('/viewAllUser')->with('success', 'User deleted successfully');
        } else {
            return redirect()->to('/viewAllUser')->with('error', 'Failed to delete user');
        }
    }

    public function register(){
        $db = \Config\Database::connect();
        $data['roles']  = $db->table('roles')->get()->getResultArray();
        return view('register', $data);
    }

    
    public function editUser($user_id){
        $db = \Config\Database::connect();
        $data['roles']  = $db->table('roles')->get()->getResultArray();

        $data['userData'] = $db->table('users')
        ->join('user_roles', 'user_roles.user_id = users.user_id') 
        ->where('users.user_id', $user_id)
        ->get()
        ->getResultArray(); 
        return view('User/editUser', $data);
    }

    public function updateUser($user_id){
        $db = \Config\Database::connect();

        // profile pic upload code
        $profilePic = $this->request->getFile('profile_picc');
        if ($profilePic->isValid() && !$profilePic->hasMoved()) {
            $newName = $profilePic->getRandomName();
            $profilePic->move(ROOTPATH . 'public/uploads/profile_pics', $newName);
        } else {
            $newName =  $this->request->getPost('pic');
        }

        $userData = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'dob' => $this->request->getPost('dob'),
            'gender' => $this->request->getPost('gender'),
            'profile_pic' => $newName, 
            'address' => $this->request->getPost('address'),
        ];
        $db->table('user_roles')->where('user_id', $user_id)->update(['role_id' => $this->request->getPost('role')]);
        $result = $db->table('users')->where('user_id', $user_id)->update($userData);

         if ($result) {
             return redirect()->to('/viewAllUser')->with('success', 'User update successfully');
         } else {
             return redirect()->to('/viewAllUser')->with('error', 'Failed to update user');
         }
    }
    

    
}