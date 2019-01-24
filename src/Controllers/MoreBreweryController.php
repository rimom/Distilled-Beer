<?php
/**
 * @author Rimom Costa<rimomcosta@gmail.com>
 * User: rimom
 * Date: 04/02/2018
 * Time: 23:04
 */

namespace Controllers;

use Models\Beer;
use Models\Brewery;

class MoreBreweryController extends Controller
{
    private const INVALID_BREWERY_ID = 'Invalid Brewery ID';
    private const NO_INFORMATION_FOUND = 'No information found';

    /**
     * @param $response
     * @param $args
     * @return mixed
     */
    public function index($response, $args)
    {
        $args = Helper::sanitize($args['breweryId']);

        if (!$args) {
            $args['msg'] = self::INVALID_BREWERY_ID;
            return $this->container->renderer->render($response, 'home.phtml', $args);
        }

        $data = new Beer($this->container->API_Key);
        $args = $data->getBeersFromSpecificBrewery($args);

        //reduce the description length.
        if (isset($args['beers']) and count($args['beers']) > 0) {
            for ($i = 0; $i < count($args['beers']); $i++) {
                $args['beers'][$i]['description'] = Helper::textShorten($args['beers'][$i]['description'], 160);
            }
            $args['showBeers'] = true;//inform to the view to show Beers section
        } else {
            $args['msg'] = self::NO_INFORMATION_FOUND;
        }

        return $this->container->renderer->render($response, 'home.phtml', $args);

    }

    /**
     * @param $response
     * @param $args
     * @return mixed
     */
    public function about($response, $args)
    {
        $args = Helper::sanitize($args['breweryId']);

        $data = new brewery($this->container->API_Key);
        $args = $data->getBrewery($args);

        if (!isset($args['data']['name'])) {
            $args['msg'] = self::NO_INFORMATION_FOUND;
        } else {
            //inform to the view to show Breweries section
            $args['showBrewery'] = true;
        }

        return $this->container->renderer->render($response, 'home.phtml', $args);
    }
}