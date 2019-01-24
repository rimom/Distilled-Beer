<?php
/**
 * @author Rimom Costa<rimomcosta@gmail.com>
 * User: rimom
 * Date: 03/02/2018
 * Time: 18:32
 */

namespace Contracts;

interface BeerInterface
{
    public function __construct(Array $key);

    public function getRandomBeer(): array;

    public function getBeersFromSpecificBrewery(string $breweryId): array;

    public function getBeer(string $beerId): array;

    public function getBeers(string $search): array;

}