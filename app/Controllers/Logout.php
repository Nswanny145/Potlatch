<?php
namespace App\Controllers;

class Logout extends BaseController {
    public function index() {
        if(isset($this->session->user)){
            //delete_cookie('user');
            $this->session->remove('user');
        }
        return redirect()->to('/');
    }
}
?>