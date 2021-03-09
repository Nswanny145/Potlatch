<?php

namespace App\Controllers;

use Exception;

class Auction extends BaseController
{
    // Shows an item's auction based on the id.
    public function view($id) {
        if(isset($this->session->user)){ // If signed in.
            helper(['form', 'url', 'html', 'user']);
            $potlatchItemModel = new \App\Models\PotlatchItem();
            $potlatchItem = $potlatchItemModel->where('id', $id)->get()->getRow();
            // If item exists, and user has access.
            if($potlatchItem && hasAccess($this->session->user->id, $potlatchItem->potlatch_id)){
                $data['title'] = 'Auction';
                $data['user'] = $this->session->user;
                echo view('components/header', $data);
                unset($data);

                $itemBidModel = new \App\Models\ItemBid();
                $highestBid = $itemBidModel->where('item_id', $id)->selectMax('amount')->get()->getRow();
                $highestBid = $itemBidModel->where(['item_id' => $id, 'amount' => $highestBid->amount])->get()->getRow();
                $data['item'] = (array)$potlatchItem;
                $data['highestBid'] = (array)$highestBid;
                $data['isOwner'] = isOwner($this->session->user->id, $potlatchItem->potlatch_id);
                $data['canBid'] = (!$data['isOwner'] && $highestBid->user_id != $this->session->user->id);
                // Get list of all images in item folder.
                try{
                    $files = scandir('images/'.$potlatchItem->potlatch_id.'/'.$potlatchItem->id);
                    foreach($files as $file) {
                        if($file == '.' || $file == '..') continue;
                        $data['images'][] = $file;
                    }
                }catch(Exception $e){}
                echo view('potlatch/auction', $data);

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