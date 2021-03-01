<h1><?= $potlatch['title'] ?></h1>
<p><?= $potlatch['description'] ?></p>
<h2>Items</h2>
<items>
    <?php foreach($items as $item): ?>
        <card>
            <header><?= $item['title'] ?></header>
        </card>
    <?php endforeach; ?>
</items>