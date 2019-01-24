<?php
/**
 * @author Rimom Costa<rimomcosta@gmail.com>
 * User: rimomaguiar
 * Date: 05/02/18
 * Time: 16:33
 */

for ($i = 1; $i < $argc; $i++) {
    parse_str($argv[$i]);
}

$host = $argv[1];
$port = $argv[2];
$token = $argv[3];


$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "$host:$port/populatedatabase/$token");
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_exec($ch);
curl_close($ch);