<card>
    <header><?= $title ?></header>
    <content>
        <?= $description ?>
    </content>
    <footer>
        <?= anchor('potlatch/'.$id, 'Go To ->') ?>
    </footer>
</card>