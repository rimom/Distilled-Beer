<?php
/**
 * @author Rimom Costa<rimomcosta@gmail.com>
 * User: rimom
 * Date: 04/02/2018
 * Time: 23:04
 */

namespace Controllers;

use Models\Beer;

class SpecificBeerController extends Controller
{
    private const INVALID_BEER_ID = 'You typed an invalid beer ID';

    /**
     * @param $response
     * @param $args
     * @return mixed
     */
    public function index($response, $args)
    {
        $args = Helper::sanitize($args['beerID']);//input validation

        if (!$args) {
            $args['msg'] = self::INVALID_BEER_ID;
            return $this->container->renderer->render($response, 'home.phtml', $args);
        }

        $data = new Beer($this->container->API_Key);
        $args = $data->getBeer($args);

        if (!isset($args['name'])) {
            $args['msg'] = self::INVALID_BEER_ID;
        }

        return $this->container->renderer->render($response, 'home.phtml', $args);
    }
}