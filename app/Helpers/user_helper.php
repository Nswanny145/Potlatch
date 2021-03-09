<?php

// Check if user has access to the potlatch in any way.
function hasAccess($user_id, $potlatch_id) {
    $potlatchRosterModel = new \App\Models\PotlatchRoster();
    $roster = $potlatchRosterModel->where([
        'potlatch_id' => $potlatch_id,
        'user_id' => $user_id ])->get()->getRow();
    if($roster || isOwner($user_id, $potlatch_id)) { return true; } else { return false; }
}

// Check if the user is the owner of the potlatch.
function isOwner($user_id, $potlatch_id) {
    $potlatchModel = new \App\Models\Potlatch();
    $potlatch = $potlatchModel->where('id', $potlatch_id)->get()->getRow();
    if($potlatch && $potlatch->user_id == $user_id){
        return true;
    }else{
        return false;
    }
}

// Get the available coins the user can spend.
function getAvailableCoins($user_id, $potlatch_id) {
    // Check if user is on the roster.
    $potlatchRosterModel = new \App\Models\PotlatchRoster();
    $roster = $potlatchRosterModel->where([
        'potlatch_id' => $potlatch_id,
        'user_id' => $user_id ])->get()->getRow();
    if($roster) {
        // Starting coins.
        $sCoins = $roster->coins;
        $db = db_connect();
        // Get the total amount of coins used.
        $aCoins = $db->query(
            'SELECT SUM(b.amount) amount FROM bid
            INNER JOIN (SELECT item.id, item.potlatch_id, a.amount FROM item
                INNER JOIN  (SELECT MAX(amount) amount, item_id FROM bid GROUP BY item_id) a
                ON a.item_id = item.id WHERE item.potlatch_id = ?) b
            ON bid.item_id = b.id WHERE bid.user_id = ? AND bid.amount = b.amount',
            [$potlatch_id, $user_id])->getRow();
        // Return the amount of coins available to use.
        if($aCoins) return $sCoins - $aCoins->amount;
    }
    return NULL;
}

?>