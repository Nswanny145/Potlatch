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

        if(!$this->validate($validation->getRuleGroup('signup'))){
            return view('create_account', [
                'validation' => $this->validator
            ]);
        }else{
            // Add account to database
        }
    }
}
?>