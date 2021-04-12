<?php

namespace DishCheng\Ssbooking\Provider;

use DishCheng\Ssbooking\Core\Container;
use DishCheng\Ssbooking\interfaces\Provider;
use DishCheng\Ssbooking\Services\Hotel\Hotel;
use DishCheng\Ssbooking\Services\Hotel\Order;


/**
 * Class HotelProvider
 * @package DishCheng\Ssbooking\Provider
 */
class HotelProvider implements Provider
{
    /**
     * @inheritDoc
     */
    public function serviceProvider(Container $container)
    {
        $container['hotel']=function ($container) {
            return new Hotel($container);
        };

        $container['hotelOrder']=function ($container) {
            return new Order($container);
        };
    }
}

