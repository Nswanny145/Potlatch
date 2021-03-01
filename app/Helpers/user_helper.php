<?php

function hasAccess($user_id, $potlatch_id) {
    $potlatchRosterModel = new \App\Models\PotlatchRoster();
    $roster = $potlatchRosterModel->where([
        'potlatch_id' => $potlatch_id,
        'user_id' => $user_id ])->get()->getRow();
    if($roster || isOwner($user_id, $potlatch_id)) { return true; } else { return false; }
}

function isOwner($user_id, $potlatch_id) {
    $potlatchModel = new \App\Models\Potlatch();
    $potlatch = $potlatchModel->where('id', $potlatch_id)->get()->getRow();
    if($potlatch && $potlatch->user_id == $user_id){
        return true;
    }else{
        return false;
    }
}

?>