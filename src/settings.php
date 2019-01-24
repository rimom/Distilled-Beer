<?php
return [
    'settings' => [
        'displayErrorDetails' => true,
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        //API Settings
        'API_Auth' => [
            'key' => '61ccbb2fe7a8e7fdd92479e9a592a510',
            'format' => 'json',
        ],

        //DB Settings
        'db' => [
            'host' => 'localhost',
            'dbname' => 'brewery_database',
            'user' => 'breweryuser',
            'password' => 'brewerypass'
        ],

        //Token to populate local Database
        'populateDbToken' => '123456'
    ],
];