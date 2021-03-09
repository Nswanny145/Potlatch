<?php

namespace App\Controllers;

class UploadImageController extends BaseController
{
	public function index()
	{
		helper('html');

		$data['title'] = 'UploadImage';
		$data['user'] = $this->session->user;
		echo view('components/header', $data);
		// echo page content here
		echo view('uploadimage');
		echo view('components/footer');
	}
    public function store() {
        $config['upload_path'] = './images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2000;
        $config['max_width'] = 1500;
        $config['max_height'] = 1500;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('profile_image')) {
            $error = array('error' => $this->upload->display_errors());

            echo view('uploadimage',$error);
        } else {
            $data = array('image_metadata' => $this->upload->data());

            echo view('uploadresult',$data);
        }
    }
}

?>