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

class SearchController extends Controller
{
    private const NO_RESULTS_FOUND = 'No results found for your search, please try again';

    /**
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public function index($request, $response, $args)
    {
        //get param from the view
        $search = $request->getQueryParam('search');
        //get param from the view
        $searchRadio = $request->getQueryParam('searchRadio');

        $verifySearch = Helper::sanitize($search);
        $verifySearchRadio = Helper::sanitize($searchRadio);

        $args['search'] = $verifySearch;

        switch ($verifySearchRadio) {
            case 'brewery':
                $data = new brewery($this->container->API_Key);
                $args['data'] = $data->getBreweries($verifySearch);
                $args['showBreweryResults'] = true;
                break;
            case 'beer':
                $data = new Beer($this->container->API_Key);
                $args['data'] = $data->getBeers($verifySearch);
                $args['showBeerResults'] = true;
                break;
        }

        if (!isset($args['data'][0])) {
            $args['msg'] = self::NO_RESULTS_FOUND;
        } else {
            //reduce the description length.
            for ($i = 0; $i < count($args['data']); $i++) {
                $args['data'][$i]['description'] = Helper::textShorten($args['data'][$i]['description'], 200);
            }
        }

        return $this->container->renderer->render($response, 'home.phtml', $args);
    }
}