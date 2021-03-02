<?php

namespace App\Controllers;

class Potlatch extends BaseController
{
    public function view($id) {
        if(isset($this->session->user)){
            helper(['form', 'url', 'html', 'user']);
            $potlatchItemModel = new \App\Models\PotlatchItem();
            $potlatchItem = $potlatchItemModel->where('id', $id)->get()->getRow();
            if($potlatchItem && hasAccess($this->session->user->id, $potlatchItem->potlatch_id)){
                $data['title'] = 'Auction';
                $data['user'] = $this->session->user;
                echo view('components/header', $data);
                unset($data);

                
                $data['isOwner'] = isOwner($this->session->user->id, $potlatchItem->potlatch_id);
                echo view('potlatch/potlatch', $data);

                echo view('components/footer');
            }else{
                throw new \CodeIgniter\Exceptions\PageNotFoundException();
            }
        }else{
            return redirect()->to('/login');
        }
    }
}

?>