<!DOCTYPE html>
<html>
<head><meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <?= link_tag('css/general.css') ?>

    <title><?= $title ?> - Potlatch</title>
</head>
<body>
    <nav>
        <brand><?= anchor('', 'Potlatch') ?></brand>
        <content>
            <div><?= anchor('potlatch', 'My Potlatch\'s') ?></div>
            <div class="login">
                <?php if($user): ?>
                    Welcome, <?= $user->first_name.' '.$user->last_name ?>!&nbsp;&#9662;
                    <div class="dropdown">
                        <?= anchor('account', 'My Account') ?>
                        <?= anchor('logout', 'Logout') ?>
                    </div>
                <?php else: ?>
                    <?= anchor('login', 'Login') ?>&nbsp;/&nbsp;<?= anchor('signup', 'Signup') ?>
                <?php endif; ?>
            </div>
        </content>
    </nav>
    <container>