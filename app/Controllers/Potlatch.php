<?php

namespace App\Controllers;

class Potlatch extends BaseController
{
	public function index() {
        if(isset($this->session->user)){
            helper(['form', 'url', 'html']);

            $data['title'] = 'Potlatch';
            $data['user'] = $this->session->user;
            echo view('components/header', $data);

            $data['managed'] = [];
            $data['joined'] = [];
            echo view('potlatch/potlatchs', $data);
            echo view('components/footer');
        }else{
            return redirect()->to('/login');
        }
	}
}
