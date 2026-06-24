<?php
$current = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$links = [
    '/'          => 'Home',
    '/leaderboards' => 'Leaderboards',
    '/trading'      => 'Trading',
    '/shop'         => 'Shop',
    '/sacrifices'   => 'Sacrifices',
    '/giveaways'    => 'Giveaways',
];
?>
<aside class="sidebar">
    <div class="brand">Uh Corp. 2</div>
    <nav>
        <?php foreach ($links as $path => $label): ?>
            <a href="<?= $path ?>"<?= $current === $path ? ' class="active"' : '' ?>><?= $label ?></a>
        <?php endforeach; ?>
    </nav>
    <div class="footer">&copy; Uh Corp</div>
</aside>
