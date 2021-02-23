<header>
    <h1>Managed Potlatchs</h1><button class="btn-primary">Create Potlatch</button>
</header>
<content>
    <?php if(isset($managed) && !empty($managed)): ?>
        <?php foreach($managed as $potlatch): ?>
            <card>
                <header><?= $potlatch->title ?></header>
                <content><?= $potlatch->description ?></content>
            </card>
        <?php endforeach; ?>
    <?php else: ?>
        <p>You have not created any Potlatchs yet.</p>
    <?php endif; ?>
</content>
<header>
    <h1>Joined Potlatchs</h1><button class="btn-primary">Join Potlatch</button>
</header>
<content>
    <?php if(isset($joined) && !empty($joined)): ?>
        <?php foreach($joined as $potlatch): ?>
            <card>
                <header><?= $potlatch->title ?></header>
                <content><?= $potlatch->description ?></content>
            </card>
        <?php endforeach; ?>
    <?php else: ?>
        <p>You have not joined any Potlatchs yet.</p>
    <?php endif; ?>
</content>