<?php

// Main
$app->get('/', 'MainController:index');

$app->get('/populatedatabase/{token}', 'MainController:populateDatabase');

//More beer from a specific brewery
$app->get('/more/{breweryId}', 'MoreBrewery:index');

//about brewery
$app->get('/about/{breweryId}', 'MoreBrewery:about');

//get specific beer
$app->get('/beerDetail/{beerID}', 'SpecificBeer:index');

//search
$app->get('/search', 'Search:index');