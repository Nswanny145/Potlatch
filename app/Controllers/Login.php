<?php
namespace App\Controllers;

class Login extends BaseController {
    public function index() {
        helper(['form', 'url']);
        return view('login');
    }

    public function login() {
        $validation = \Config\Services::validation();
        helper(['form', 'url']);

        if(!$this->validate(
                $validation->getRuleGroup('login'),
                $validation->getRuleGroup('login_errors'))){
            return view('login', [
                'validation' => $this->validator
            ]);
        }else{
            $email = $this->request->getVar('email', FILTER_SANITIZE_STRING);
            $password = $this->request->getVar('password', FILTER_SANITIZE_STRING);

            $userModel = new \App\Models\UserModel();
            $user = $userModel->where('email', $email)->get()->getRow();
            if(password_verify($password, $user->password)){
                unset($user->password);
                $this->session->set('user', $user);
                return redirect()->to('/');
            }else{
                return redirect()->to('/login');
            }
        }
    }
}
?>