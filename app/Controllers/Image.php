<?php

namespace App\Controllers;

use Exception;

class Image extends BaseController
{
    public function item($potlatch_id, $item_id, $image) {
        if(isset($this->session->user)){
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
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }else{
            helper(['url']);
            return redirect()->to('/login');
        }
    }
}
?>