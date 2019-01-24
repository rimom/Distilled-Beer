<?php
/**
 * @author Rimom Costa<rimomcosta@gmail.com>
 * User: rimom
 * Date: 03/02/2018
 * Time: 23:31
 */

namespace Controllers;

abstract class Controller
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }
}