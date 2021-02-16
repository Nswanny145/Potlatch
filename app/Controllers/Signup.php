<?php
namespace App\Controllers;

class Signup extends BaseController {
    public function index() {
        helper(['form', 'url']);
        return view('create_account');
    }

    public function create() {
        $validation = \Config\Services::validation();
        helper(['form', 'url']);

        if(!$this->validate(
                $validation->getRuleGroup('signup'),
                $validation->getRuleGroup('signup_errors'))){
            return view('create_account', [
                'validation' => $this->validator
            ]);
        }else{
            $userModel = new \App\Models\UserModel();
            // Validate data
            $data = [
                'first_name' => $this->request->getVar('first_name', FILTER_SANITIZE_STRING),
                'last_name' => $this->request->getVar('last_name', FILTER_SANITIZE_STRING),
                'email' => $this->request->getVar('email', FILTER_SANITIZE_STRING),
                'password' => password_hash($this->request->getVar('password', FILTER_SANITIZE_STRING), PASSWORD_DEFAULT)
            ];
            $userModel->insert($data);
            return redirect('/');
        }
    }
}
?>