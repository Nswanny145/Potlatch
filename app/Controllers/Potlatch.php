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

    public function createPotlatch() {
        if(isset($this->session->user)){
            $validation = \Config\Services::validation();
            helper(['form', 'url']);

            if(!$this->validate(
                    $validation->getRuleGroup('create_potlatch'),
                    $validation->getRuleGroup('create_potlatch_errors'))){
                return redirect()->to('/potlatch/error');
            }else{
                $potlatchModel = new \App\Models\Potlatch();
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

    public function createItem() {
        if(isset($this->session->user)){
            $potlatch_id = $this->request->getVar('potlatch_id', FILTER_VALIDATE_INT);
            helper(['form', 'url', 'user']);
            if($potlatch_id && isOwner($this->session->user->id, $potlatch_id)){
                $validation = \Config\Services::validation();

                if(!$this->validate(
                        $validation->getRuleGroup('create_potlatch'),
                        $validation->getRuleGroup('create_potlatch_errors'))){
                    return redirect()->to('/potlatch/error');
                }else{
                    $potlatchItemModel = new \App\Models\PotlatchItem();
                    // Validate data
                    $data = [
                        'potlatch_id' => $potlatch_id,
                        'title' => $this->request->getVar('title', FILTER_SANITIZE_STRING),
                        'description' => $this->request->getVar('description', FILTER_SANITIZE_STRING)
                    ];
                    if($potlatchItemModel->insert($data)){
                        return redirect()->to('/potlatch/'.$potlatch_id);
                    }else{
                        return redirect()->to('/potlatch/error');
                    }
                }
            }else{ throw new \CodeIgniter\Exceptions\PageNotFoundException(); }
        }else{ return redirect()->to('/login'); }
    }
}

?>