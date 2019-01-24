<?php
/**
 * Connect to the API service
 *
 * This class receives the query and the key, create the final link and fetch the raw data from the BreweryDB API
 * This class is used as dependency from the objects
 *
 * @author Rimom Costa<rimomcosta@gmail.com>
 * @date 03 of February - 2018
 *
 */

namespace Models;

use Contracts\APIInterface;

class API implements APIInterface
{
    /**
     * @var string $link Webservice Link
     * @var array $key API Key.
     */
    private $link = 'http://api.brewerydb.com/v2/';
    private $key;

    /**
     * @param array $key It is required to allow the access to the server API, it is in the format ['key' => 'abcdef', 'format' => 'json']
     */
    public function __construct(array $key)
    {
        $this->key = $key;
    }

    /**
     * @param string $endPoint
     * @return array
     */
    public function fetchData(string $endPoint): array
    {
        $link = $this->link . $endPoint . http_build_query($this->key);
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $link,
            CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
            CURLOPT_RETURNTRANSFER => true,
            //return data as string
            CURLOPT_USERAGENT,
            'Distilled Beer/1.0 (postmaster@distilledbeer.com)'
            //Inform to the server who is accessing their service (good practice)
        ));
        $data = curl_exec($ch);
        curl_close($ch);
        return json_decode($data, true);
    }
}