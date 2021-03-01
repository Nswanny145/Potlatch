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
            unset($data);

            $potlatchModel = new \App\Models\Potlatch();
            $managed = $potlatchModel->where('user_id', $this->session->user->id)->findAll();
            $data['managed'] = $managed;
            $data['joined'] = [];
            echo view('potlatch/potlatchs', $data);

            echo view('components/footer');
        }else{
            return redirect()->to('/login');
        }
	}

    public function view($id) {
        if(isset($this->session->user)){
            helper(['form', 'url', 'html', 'user']);
            if(hasAccess($this->session->user->id, $id)){
                $data['title'] = 'Potlatch';
                $data['user'] = $this->session->user;
                echo view('components/header', $data);
                unset($data);

                $potlatchModel = new \App\Models\Potlatch();
                $potlatchItemModel = new \App\Models\PotlatchItem();
                $potlatch = $potlatchModel->where('id', $id)->get()->getRowArray();
                $potlatchItems = $potlatchItemModel->where('potlatch_id', $id)->get()->getResultArray();
                $data['potlatch'] = $potlatch;
                $data['items'] = $potlatchItems;
                $data['isOwner'] = isOwner($this->session->user->id, $id);
                echo view('potlatch/potlatch', $data);

                echo view('components/footer');
            }else{
                throw new \CodeIgniter\Exceptions\PageNotFoundException();
            }
        }else{
            return redirect()->to('/login');
        }
    }

    public function create() {
        if(isset($this->session->user)){
            $validation = \Config\Services::validation();
            helper(['form', 'url']);

            if(!$this->validate(
                    $validation->getRuleGroup('create_potlatch'),
                    $validation->getRuleGroup('create_potlatch_errors'))){
                return redirect()->to('/potlatch/error');
            }else{
                $potlatchModel = new \App\Models\PotlatchModel();
                // Validate data
                $data = [
                    'user_id' => $this->session->user->id,
                    'title' => $this->request->getVar('title', FILTER_SANITIZE_STRING),
                    'description' => $this->request->getVar('description', FILTER_SANITIZE_STRING)
                ];
                if($potlatchModel->insert($data)){
                    return redirect()->to('/potlatch');
                }else{
                    return redirect()->to('/potlatch/error');
                }
            }
        }else{
            return redirect()->to('/login');
        }
    }
}

?>