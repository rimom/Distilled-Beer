<?php
/**
 * @author Rimom Costa<rimomcosta@gmail.com>
 * User: rimomaguiar
 * Date: 05/02/18
 * Time: 00:02
 */

for ($i = 1; $i < $argc; $i++) {
    parse_str($argv[$i]);
}

$username = $argv[1];
$password = $argv[2];

echo "=============================\n";
echo "Script to create the database\n";
echo "=============================\n";

try {
    $dbh = new PDO("mysql:host=localhost", $username, $password);
    $dbh->exec("CREATE DATABASE brewery_database;
                CREATE USER 'breweryuser'@'localhost' IDENTIFIED BY 'brewerypass';
                GRANT ALL ON brewery_database.* TO 'breweryuser'@'localhost';
                FLUSH PRIVILEGES;
                USE brewery_database;
                CREATE TABLE beers (
                    id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    beer_id VARCHAR(15) NOT NULL UNIQUE,
                    beer_name VARCHAR(80) NULL,
                    beer_abv VARCHAR(10) NULL,
                    beer_update_date DATE,
                    brewery_id VARCHAR(15) NULL,
                    brewery_name VARCHAR(15) NULL,
                    brewery_description TEXT(2048) NULL,
                    brewery_website VARCHAR(255) NULL,
                    brewery_icon VARCHAR(255) NULL,
                    brewery_medium VARCHAR(255) NULL                        
                    );
                ")
    or die(print_r($dbh->errorInfo(), true));
} catch (PDOException $e) {
    die("DB ERROR: " . $e->getMessage());
}
echo "PHP script executed successfully\n";
echo "\n";




