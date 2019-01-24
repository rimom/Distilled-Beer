<?php
/**
 * @author Rimom Costa<rimomcosta@gmail.com>
 * User: rimom
 * Date: 03/02/2018
 * Time: 18:32
 */

namespace Contracts;

interface BreweryInterface
{
    public function __construct(Array $key);

    public function getBrewery(string $breweryId): array;

    public function getBreweries(string $search): array;

}