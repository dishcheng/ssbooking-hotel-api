<?php

namespace DishCheng\Ssbooking\interfaces;


use DishCheng\Ssbooking\Core\Container;

/**
 * Interface Provider
 * @package JavaReact\AlibabaOpen\interfaces
 */
interface Provider
{
    /**
     * @param Container $container
     * @return mixed
     */
    public function serviceProvider(Container $container);
}
