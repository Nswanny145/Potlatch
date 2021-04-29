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
                //current date var
                $date = date('Y-m-d H:i:s');
                $itemBidModel = new \App\Models\ItemBid();
                $highestBid = $itemBidModel->where('item_id', $id)->selectMax('amount')->get()->getRow();
                $highestBid = $itemBidModel->where(['item_id' => $id, 'amount' => $highestBid->amount])->get()->getRow();
                $data['item'] = (array)$potlatchItem;
                $data['highestBid'] = (array)$highestBid;
                $data['isOwner'] = isOwner($this->session->user->id, $potlatchItem->potlatch_id);
                $data['isHighestBidder'] = $highestBid->user_id == $this->session->user->id;
                $data['canBid'] = (!$data['isOwner'] && !$data['isHighestBidder'] && $highestBid->amount+1 <= getAvailableCoins($this->session->user->id, $potlatchItem->potlatch_id) 
                && $date <= $potlatchItem->expiration);
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

    public function bid(){
        if(isset($this->session->user)){ // If signed in.
            helper(['url', 'user']);
            // Get hidden inputs.
            $item_id = $this->request->getVar('item_id', FILTER_VALIDATE_INT);
            $bidInput = $this->request->getVar('bid', FILTER_VALIDATE_INT);
            $hBidInput = $this->request->getVar('highestBid', FILTER_VALIDATE_INT);
            // Get potlatch item info.
            $potlatchItemModel = new \App\Models\PotlatchItem();
            $potlatchItem = $potlatchItemModel->where('id', $item_id)->get()->getRow();
            //current date
            $date = date('Y-m-d H:i:s');
            // If item exists, and user has access, and is not the owner.
            if($potlatchItem &&
                    hasAccess($this->session->user->id, $potlatchItem->potlatch_id) &&
                    !isOwner($this->session->user->id, $potlatchItem->potlatch_id)){
                $itemBidModel = new \App\Models\ItemBid();
                // Get highest bid for the item.
                $hBid = $itemBidModel->where('item_id', $item_id)->selectMax('amount')->get()->getRow();
                $hBid = $itemBidModel->where(['item_id' => $item_id, 'amount' => $hBid->amount])->get()->getRow();
                // Get the amount of available coins to spend.
                $aCoins = getAvailableCoins($this->session->user->id, $potlatchItem->potlatch_id);
                // If there's not bids or If there's inputted bid is higher the highest bid.
                if(($hBidInput == false && is_null($hBid)) || ($bidInput != false && !is_null($hBid) && $hBid->user_id != $this->session->user->id && $bidInput >= $hBid->amount && $date <= $potlatchItem->expiration)){
                    // If user has enough coins, and isn't last bidder.
                    if(isset($aCoins)){
                        // No one has bid and user has one coin.
                        if(is_null($hBid) && $aCoins >= 1){
                            $amount = 1;
                        // Someone has bid, and user has enough coins to bid inputted amount.
                        }else if(!is_null($hBid) && $bidInput <= $aCoins){
                            $amount = $bidInput;
                        }else{
                            echo 'Not enough coins';
                            exit;
                        }
                        $data = [
                            'item_id' => $item_id,
                            'user_id' => $this->session->user->id,
                            'amount' => $amount
                        ];
                        // Insert bid.
                        if($itemBidModel->insert($data)){
                            return redirect()->to('/auction/'.$item_id);
                        }else{
                            echo 'Failed to insert<hr>';
                            var_dump($data);
                            echo '<hr>';
                            var_dump($hBid);
                        }
                    }else{
                        echo 'Failed to get available coins.';
                        exit;
                    }
                }else{
                    echo 'Someone has already placed a higher bid.';
                    exit;
                }
            }else{
                throw new \CodeIgniter\Exceptions\PageNotFoundException();
            }
        }else{
            return redirect()->to('/login');
        }
    }
}

?>