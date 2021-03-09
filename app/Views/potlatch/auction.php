<section>
    <carousel>
        <?php if(isset($images)): ?>
            <?php foreach($images as $filename): ?>
                <?= img('image/item/'.$item['potlatch_id'].'/'.$item['id'].'/'.$filename) ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </carousel>
    <?= form_open('auction/bid') ?>
        <h2><?= $item['title'] ?></h2>
        <div>
            <?php if(isset($highestBid['amount'])): ?>
                <p>Current Bid: $<?= $highestBid['amount'] ?></p>
                <?php if($canBid): ?>
                    <input name="bid" type="number" min="<?= $highestBid['amount']+1 ?>" placeholder="Bid starting at: <?= $highestBid['amount']+1 ?>" required/>
                <?php endif; ?>
            <?php else: ?>
                <p>Starting Bid: $1</p>
            <?php endif; ?>
        </div>
        <?php if($canBid): ?>
            <button type="submit">Place Bid</button>
        <?php else: ?>
            <button disabled>
                <?php if($isHighestBidder): ?>
                    Highest Bidder
                <?php else: ?>
                    Bid Disabled
                <?php endif; ?>
            </button>
        <?php endif; ?>
        <input name="item_id" type="number" value="<?= $item['id'] ?>" hidden/>
        <input name="highestBid" type="number" value="<?= $highestBid['amount']?>" hidden/>
    </form>
</section>