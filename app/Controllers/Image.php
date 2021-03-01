<?php

namespace App\Controllers;

use Exception;

class Image extends BaseController
{
    public function item($potlatch_id, $item_id, $image) {
        helper(['user', 'url']);
        if(isset($this->session->user)){
            if(hasAccess($this->session->user->id, $potlatch_id)){
                $imgPath = 'images/'.$potlatch_id.'/'.$item_id.'/'.$image;
                try{
                    $image = imagecreatefromstring(file_get_contents($imgPath));
                    if($image !== false) {
                        $this->response->setContentType('image/png');
                        imagepng($image, null, -1, -1);
                        imagedestroy($image);
                        return;
                    }
                }catch(Exception $e){}
            }
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }else{
            return redirect()->to('/login');
        }
    }
}
?>