<?php
/**
 * This Class is a repository to be used by the classes Beer and Brewery
 *
 * @author Rimom Costa<rimomcosta@gmail.com>
 * @date 04 of February - 2018
 *
 */

namespace Models;

use Psr\Http\Message\ResponseInterface;

abstract class DataSRC
{
    /**
     * @var Object $api
     */
    protected $api;

    /**
     * DataSRC constructor.
     * @param array $key
     */
    public function __construct(Array $key)
    {
        $this->api = new API($key);
    }
}