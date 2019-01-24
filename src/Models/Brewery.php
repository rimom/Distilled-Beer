<?php
/**
 * This Class creates the object brewery with methods to fetch all the data based on the query rules
 *
 * @author Rimom Costa<rimomcosta@gmail.com>
 * @date 03 of February - 2018
 *
 */

namespace Models;

use Contracts\BreweryInterface;

final class Brewery extends DataSRC implements BreweryInterface
{
    private const NO_DESCRIPTION_FOUND = 'No description found about this brewery';
    private const WEBSITE_NOT_FOUND = 'website not found!';

    /**
     * Get a Brewery based on a given ID
     * @param string $breweryId
     * @return array
     */
    public function getBrewery($breweryId): array
    {
        $query = 'brewery/' . $breweryId . '?';//prepare the query
        $args = $this->api->fetchData($query);
        $brewery = Array();
        if (isset($args['data']['id'])) {//verify if any data is fetched
            if (!isset($args['data']['description'])) {//verify if it has any description
                $args['data']['description'] = self::NO_DESCRIPTION_FOUND;
            }

            if (!isset($args['data']['website'])) {//verify if it has any information about website
                $args['data']['website'] = self::WEBSITE_NOT_FOUND;
            }
            //filter the data
            $brewery['data']['id'] = $args['data']['id'];
            $brewery['data']['name'] = $args['data']['name'];
            $brewery['data']['description'] = $args['data']['description'];
            $brewery['data']['website'] = $args['data']['website'];
        }
        return $brewery;
    }

    /**
     * Get breweries that match with the "search" field
     * @param string $search Insert Brewery ID to fetch it
     * @return array
     */
    public function getBreweries($search): array
    {
        $query = 'search?q=' . $search . '&type=brewery&';//prepare the query
        $args = $this->api->fetchData($query);
        $brewery = array();

        if (isset($args['data'])) {//verify if any data is fetched
            $j = 0;
            for ($i = 0; $i < count($args['data']); $i++) {//filter the data fetched
                if (!isset($args['data'][$i]['description'])) {//verify if it has any description
                    $args['data'][$i]['description'] = self::NO_DESCRIPTION_FOUND;
                }
                if (!isset($args['data'][$i]['website'])) {
                    $args['data'][$i]['website'] = self::WEBSITE_NOT_FOUND;
                }
                //insert the filtered data in a new array with index $j
                $brewery[$j]['id'] = $args['data'][$i]['id'];
                $brewery[$j]['name'] = $args['data'][$i]['name'];
                $brewery[$j]['description'] = $args['data'][$i]['description'];
                $brewery[$j]['website'] = $args['data'][$i]['website'];
                $j++;
            }
        }
        return $brewery;
    }
}