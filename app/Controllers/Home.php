<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		helper('html');

		$data['title'] = 'Home';
		$data['user'] = $this->session->user;
		echo view('components/header', $data);
		// echo page content here
		echo view('home');
		echo view('components/footer');
	}
}
