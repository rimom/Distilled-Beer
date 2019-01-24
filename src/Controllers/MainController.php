<?php
/**
 * @author Rimom Costa<rimomcosta@gmail.com>
 * User: rimom
 * Date: 04/02/2018
 * Time: 23:04
 */

namespace Controllers;

use Models\Beer;
use Models\db;

class MainController extends Controller
{
    private const INSERT_RIGHT_TOKEN = 'You must insert the right token before populate/update the local database';

    /**
     * @param $response
     * @return mixed
     */
    public function index($response)
    {
        $data = new Beer($this->container->API_Key);
        $args = $data->getRandomBeer();
        return $this->container->renderer->render($response, 'home.phtml', $args);

    }

    /**
     * @param $response
     * @param $args
     * @return mixed
     */
    public function populateDatabase($response, $args)
    {
        $args = Helper::sanitize($args['token']);

        //only go ahead if the token is valid, the right way is to save the token in a database, this is a quick way
        if (!$args or $args != $this->container->populateDbToken) {
            $args = array();
            $args['msg'] = self::INSERT_RIGHT_TOKEN;
            return $this->container->renderer->render($response, 'home.phtml', $args);
        }

        //could return to a page with more details about all the beers, no return for now.
        echo "passou";
        $data = new db($this->container->API_Key, $this->container->pdo);
        $data->populateDB();
    }
}