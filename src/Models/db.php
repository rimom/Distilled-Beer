<?php
/**
 * Created by PhpStorm.
 * User: rimomaguiar
 * Date: 05/02/18
 * Time: 03:34
 */

namespace Models;


use Controllers\Helper;

class db
{
    protected $api;
    protected $pdo;

    public function __construct(array $key, $pdo)
    {
        $this->api = new API($key);
        $this->pdo = $pdo;
    }

    public function populateDB()
    {
        $query = '/beers?p=1&availableId=1&';//just to verify the number of pages
        $info = $this->api->fetchData($query);

        for ($j = 1; $j <= $info['numberOfPages']; $j++) {
            $query = '/beers?p=' . $j . '&availableId=1&';
            $info = $this->api->fetchData($query);

            for ($i = 0; $i < count($info['data']); $i++) {
                $beer_id = $info['data'][$i]['id'];
                $beer_name = $info['data'][$i]['name'];
                $beer_abv = $info['data'][$i]['abv'];
                $beer_update_date = $info['data'][$i]['updateDate'];

                $query_extra = '/beer/' . $beer_id . '?withBreweries=y&';
                $data_extended = $this->api->fetchData($query_extra);

                $brewery_id = $data_extended['data']['breweries']['0']['id'];
                $brewery_name = $data_extended['data']['breweries']['0']['name'];
                $brewery_description = $data_extended['data']['breweries']['0']['description'];
                $brewery_website = $data_extended['data']['breweries']['0']['website'];
                $brewery_icon = $data_extended['data']['breweries']['0']['images']['icon'];
                $brewery_medium = $data_extended['data']['breweries']['0']['images']['medium'];

                if (!isset($beer_name)) {
                    $beer_name = 'not informed';
                };
                if (!isset($beer_abv)) {
                    $beer_abv = 'not informed';
                };
                if (!isset($beer_update_date)) {
                    $beer_update_date = 000000;
                };
                if (!isset($brewery_id)) {
                    $brewery_id = 'not informed';
                };
                if (!isset($brewery_name)) {
                    $brewery_name = 'not informed';
                };
                if (!isset($brewery_description)) {
                    $brewery_description = 'not informed';
                };
                if (!isset($brewery_website)) {
                    $brewery_website = 'not informed';
                };
                if (!isset($brewery_icon)) {
                    $brewery_icon = 'not informed';
                };
                if (!isset($brewery_medium)) {
                    $brewery_medium = 'not informed';
                };

                echo "$beer_id";
                echo "<br>";
                echo "$beer_name";
                echo "<br>";
                echo "$beer_abv";
                echo "<br>";
                echo "$beer_update_date";
                echo "<br>";
                echo "$brewery_id";
                echo "<br>";
                echo "$brewery_name";
                echo "<br>";
                echo "$brewery_description";
                echo "<br>";
                echo "$brewery_website";
                echo "<br>";
                echo "$brewery_icon";
                echo "<br>";
                echo "$brewery_medium";
                echo "<br>";

                $sql = "INSERT INTO beers (beer_id, beer_name, beer_abv, beer_update_date, brewery_id, brewery_name, brewery_description, brewery_website, brewery_icon, brewery_medium)
                    VALUES (:beer_id, :beer_name, :beer_abv, :beer_update_date, :brewery_id, :brewery_name, :brewery_description, :brewery_website, :brewery_icon, :brewery_medium)
                    ON DUPLICATE KEY UPDATE beer_name = :beer_name, beer_abv = :beer_abv, beer_update_date = :beer_update_date, brewery_id = :brewery_id, brewery_name = :brewery_name, brewery_description = :brewery_description, brewery_website = :brewery_website, brewery_icon = :brewery_icon, brewery_medium = :brewery_medium";

                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':beer_id', $beer_id);
                $stmt->bindParam(':beer_name', $beer_name);
                $stmt->bindParam(':beer_abv', $beer_abv);
                $stmt->bindParam(':beer_update_date', $beer_update_date);
                $stmt->bindParam(':brewery_id', $brewery_id);
                $stmt->bindParam(':brewery_name', $brewery_name);
                $stmt->bindParam(':brewery_description', $brewery_description);
                $stmt->bindParam(':brewery_website', $brewery_website);
                $stmt->bindParam(':brewery_icon', $brewery_icon);
                $stmt->bindParam(':brewery_medium', $brewery_medium);

                $stmt->execute();

            }//end for $i
        }//end for $J
        return 0;
    }
}