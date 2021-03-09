<?php

namespace App\Controllers;

use Exception;

class Potlatch extends BaseController
{
	public function index() {
        if(isset($this->session->user)){
            helper(['form', 'url', 'html']);

            $data['title'] = 'Potlatch';
            $data['user'] = $this->session->user;
            echo view('components/header', $data);
            unset($data);

            // Select all potlatchs that user owns.
            $potlatchModel = new \App\Models\Potlatch();
            $managed = $potlatchModel->where('user_id', $this->session->user->id)->findAll();
            $data['managed'] = $managed;

            // Select potlatchs that you are on the roster for.
            $db = db_connect();
            $joined = $db->query('SELECT potlatch.* FROM roster INNER JOIN potlatch ON roster.potlatch_id = potlatch.id  WHERE roster.user_id = ?',
                [$this->session->user->id])->getResultArray();
            $data['joined'] = $joined;
            echo view('potlatch/potlatchs', $data);

            echo view('components/footer');
        }else{
            return redirect()->to('/login');
        }
	}

    // View individual potlatch and all of it's items.
    public function view($id) {
        if(isset($this->session->user)){ // Check if signed in.
            helper(['form', 'url', 'html', 'user']);
            if(hasAccess($this->session->user->id, $id)){ // Check if the user has access to the potlatch.
                $data['title'] = 'Potlatch';
                $data['user'] = $this->session->user;
                echo view('components/header', $data);
                unset($data);

                $potlatchModel = new \App\Models\Potlatch();
                $potlatchItemModel = new \App\Models\PotlatchItem();
                // Select the potlatch.
                $potlatch = $potlatchModel->where('id', $id)->get()->getRowArray();
                // Select all the potlatch items.
                $potlatchItems = $potlatchItemModel->where('potlatch_id', $id)->get()->getResultArray();
                $data['potlatch'] = $potlatch;
                $data['items'] = $potlatchItems;
                // Specify if the user owns th potlatch.
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

    // Create potlatch from form data.
    public function createPotlatch() {
        if(isset($this->session->user)){
            $validation = \Config\Services::validation();
            helper(['form', 'url']);

            // Validate post data.
            if(!$this->validate(
                    $validation->getRuleGroup('create_potlatch'),
                    $validation->getRuleGroup('create_potlatch_errors'))){
                // Create error mechanism.
                return redirect()->to('/potlatch/error');
            }else{
                $potlatchModel = new \App\Models\Potlatch();
                // Validate/Sanitize data
                $data = [
                    'user_id' => $this->session->user->id,
                    'title' => $this->request->getVar('title', FILTER_SANITIZE_STRING),
                    'description' => $this->request->getVar('description', FILTER_SANITIZE_STRING)
                ];
                if($potlatchID = $potlatchModel->insert($data)){
                    // Create directory for images.
                    mkdir("images/".$potlatchID, 0777, true);
                    return redirect()->to('/potlatch');
                }else{
                    // Create error mechanism.
                    return redirect()->to('/potlatch/error');
                }
            }
        }else{
            return redirect()->to('/login');
        }
    }

    // Create an item for an individual potlatch.
    public function createItem() {
        if(isset($this->session->user)){ // Check if signed in.
            // Get potlatch id from hidden form input.
            $potlatch_id = $this->request->getVar('potlatch_id', FILTER_VALIDATE_INT);
            helper(['form', 'url', 'user']);
            // Check if potlatch is valid and if the user is the owner.
            if($potlatch_id && isOwner($this->session->user->id, $potlatch_id)){
                $validation = \Config\Services::validation();

                // Validate form data.
                if(!$this->validate(
                        $validation->getRuleGroup('create_potlatch'),
                        $validation->getRuleGroup('create_potlatch_errors'))){
                    return redirect()->to('/potlatch/error');
                }else{
                    $potlatchItemModel = new \App\Models\PotlatchItem();
                    // Validate/Sanitize data
                    $data = [
                        'potlatch_id' => $potlatch_id,
                        'title' => $this->request->getVar('title', FILTER_SANITIZE_STRING),
                        'description' => $this->request->getVar('description', FILTER_SANITIZE_STRING)
                    ];
                    // Insert item.
                    if($item_id = $potlatchItemModel->insert($data)){
                        // Create directory for images.
                        mkdir('images/'.$potlatch_id.'/'.$item_id, 0777, true);
                        // Check if images were provided.
                        if($imagefile = $this->request->getFiles()){
                            // Upload images appropriately.
                            foreach($imagefile['images'] as $img){
                                if ($img->isValid() && !$img->hasMoved())
                                {
                                    $newName = $img->getRandomName();
                                    try{
                                        $img->move('images/'.$potlatch_id.'/'.$item_id, $newName);
                                    }catch(Exception $e){
                                        echo $e->getMessage();
                                        exit;
                                    }
                                }
                            }
                        }
                        return redirect()->to('/auction/'.$item_id);
                    }else{
                        return redirect()->to('/potlatch/error');
                    }
                }
            }else{ throw new \CodeIgniter\Exceptions\PageNotFoundException(); }
        }else{ return redirect()->to('/login'); }
    }
}

?>