<?php
// DIC configuration
require_once __DIR__ . '/../src/Controllers/MainController.php';

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// API
$container['API_Key'] = function ($c) {
    $settings = $c->get('settings')['API_Auth'];
    return $settings;
};

$container['pdo'] = function ($c) {
    $settings = $c->get('settings')['db'];
    $pdo = new PDO("mysql:host=" . $settings['host'] . ";dbname=" . $settings['dbname'], $settings['user'],
        $settings['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
};

$container['populateDbToken'] = function ($c) {
    $settings = $c->get('settings')['populateDbToken'];
    return $settings;
};

$container['MainController'] = function ($c) {
    return new Controllers\MainController($c);
};

$container['MoreBrewery'] = function ($c) {
    return new Controllers\MoreBreweryController($c);
};

$container['SpecificBeer'] = function ($c) {
    return new Controllers\SpecificBeerController($c);
};

$container['Search'] = function ($c) {
    return new Controllers\SearchController($c);
};