<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 6/02/17
 * Time: 14:24
 */

namespace app\controller;


use Interop\Container\ContainerInterface;

class GameController extends AbstractController
{

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
    }
    public function getdestinations($req,$res,$args)
    {
        die('dd');
    }
}