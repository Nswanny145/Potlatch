<div>
    <carousel>
        <?php if(isset($images)): ?>
            <?php foreach($images as $filename): ?>
                <?= img('image/item/'.$item['potlatch_id'].'/'.$item['id'].'/'.$filename) ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </carousel>
    <p>Current Bid: $<?= $highestBid['amount'] ?></p>
    <?php if($canBid): ?>
        <button>Bid</button>
    <?php else: ?>
        <button disabled>Bid Disabled</button>
    <?php endif; ?>
</div>