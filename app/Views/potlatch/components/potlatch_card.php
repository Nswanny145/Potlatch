<card>
    <header><?= $title ?></header>
    <content>
        <p><?= $description ?></p>
        <?= anchor('potlatch/'.$id, 'Go To ->') ?>
    </content>
</card>