<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?> - Potlatch</title>
    <?= link_tag('css/general.css') ?>
</head>
<body>
    <nav>
        <brand>Potlatch</brand>
        <div class="login">
            <?php if($user): ?>
                Welcome, <?= $user->first_name.' '.$user->last_name ?>!
            <?php else: ?>
                <?= anchor('login', 'Login') ?>&nbsp;/&nbsp;<?= anchor('signup', 'Signup') ?>
            <?php endif; ?>
        </div>
    </nav>
    <container>