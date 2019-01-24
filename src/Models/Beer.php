<?php
/**
 * This Class creates the object beer with methods to fetch all the data based on the query rules
 *
 * @author Rimom Costa<rimomcosta@gmail.com>
 * @date 03 of February - 2018
 *
 */

namespace Models;


use Contracts\BeerInterface;

final class Beer extends DataSRC implements BeerInterface
{
    /**
     * get a Random beer based on the API query property "random"
     * @return array
     */
    public function getRandomBeer(): array
    {
        $query = 'beer/random?hasLabels=y&withBreweries=y&';//prepare the query
        $randomBeer = $this->api->fetchData($query);//Query the API based on the provided query
        //get the data only if it has description and label
        while (empty($randomBeer['data']['description']) || empty($randomBeer['data']['labels']['medium'])) {
            $randomBeer = $this->api->fetchData($query);//if it has no label/description, fetch new beer
        }
        //filter the data and add them in a new array
        $args['id'] = $randomBeer['data']['id'];
        $args['name'] = $randomBeer['data']['name'];
        $args['desc'] = $randomBeer['data']['description'];
        $args['image'] = $randomBeer['data']['labels']['medium'];
        $args['breweryId'] = $randomBeer['data']['breweries'][0]['id'];
        $args['breweryName'] = $randomBeer['data']['breweries'][0]['name'];
        return $args;
    }

    /**
     * Show all beers from a specific Brewery
     * @param string $breweryId
     * @return array
     */
    public function getBeersFromSpecificBrewery($breweryId): array
    {
        $query = 'brewery/' . $breweryId . '/beers?';//prepare the query
        $beer = $this->api->fetchData($query);
        $args = array();

        if (isset($beer['data'])) {//verify if any data is fetched
            $j = 0;
            for ($i = 0; $i < count($beer['data']); $i++) {
                if (!empty($beer['data'][$i]['description']) and (!empty($beer['data'][$i]['labels']['icon']))) {//fetch only the beers with label and description adn add them in a new array
                    $args['beers'][$j]['id'] = $beer['data'][$i]['id'];
                    $args['beers'][$j]['name'] = $beer['data'][$i]['name'];
                    $args['beers'][$j]['description'] = $beer['data'][$i]['description'];
                    $args['beers'][$j]['icon'] = $beer['data'][$i]['labels']['icon'];
                    $j++;
                }
            }
        }
        return $args;
    }

    /**
     * Get a specific beer with brewery information
     * @param string $beerId
     * @return array
     */
    public function getBeer($beerId): array
    {
        $query = 'beer/' . $beerId . '?withBreweries=y&';//prepare the query
        $beer = $this->api->fetchData($query);
        $args = array();
        //filer the data and add them in a new array
        if (isset($beer['data'])) {
            $args['id'] = $beer['data']['id'];
            $args['name'] = $beer['data']['name'];
            $args['desc'] = $beer['data']['description'];
            $args['image'] = $beer['data']['labels']['medium'];
            $args['breweryId'] = $beer['data']['breweries'][0]['id'];
            $args['breweryName'] = $beer['data']['breweries'][0]['name'];
        }
        return $args;
    }

    /**
     * Get beers that match with the "search" field
     * @param string $search Insert beers ID to fetch it
     * @return array
     */
    public function getBeers($search): array
    {
        $query = 'search?q=' . $search . '&type=beer&';//prepare the query
        $args = $this->api->fetchData($query);
        $beer = array();
        //filer the data and add them in a new array
        if (isset($args['data'])) {
            $j = 0;
            for ($i = 0; $i < count($args['data']); $i++) {
                if (isset($args['data'][$i]['description']) and isset($args['data'][$i]['labels']['icon'])) {//get only the beers with description and label
                    $beer[$j]['id'] = $args['data'][$i]['id'];
                    $beer[$j]['name'] = $args['data'][$i]['name'];
                    $beer[$j]['description'] = $args['data'][$i]['description'];
                    $beer[$j]['image'] = $args['data'][$i]['labels']['icon'];
                    $j++;
                }
            }
        }
        return $beer;
    }


}