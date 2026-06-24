<?php
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$routes = [
    '/'          => 'index.php',
    '/home'      => 'index.php',
    '/leaderboards' => 'pages/leaderboards.php',
    '/trading'      => 'pages/trading.php',
    '/shop'         => 'pages/shop.php',
    '/sacrifices'   => 'pages/sacrifices.php',
    '/giveaways'    => 'pages/giveaways.php',
];

if (isset($routes[$uri])) {
    require $routes[$uri];
    return true;
}

return false;
