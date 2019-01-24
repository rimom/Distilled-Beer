<?php
/**
 * @author Rimom Costa<rimomcosta@gmail.com>
 * User: rimom
 * Date: 03/02/2018
 * Time: 18:32
 */

namespace Contracts;

interface APIInterface
{
    public function __construct(array $key);

    public function fetchData(string $endPoint): array;

}