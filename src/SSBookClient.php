<?php

namespace DishCheng\Ssbooking;

use DishCheng\Ssbooking\Core\ContainerBase;
use DishCheng\Ssbooking\Provider\HotelProvider;
use DishCheng\Ssbooking\Services\Hotel\Hotel;
use DishCheng\Ssbooking\Services\Hotel\Order;


/**
 * @property Hotel hotel
 * @property Order order
 * Class SSBookHotelService
 * @package DishCheng\Ssbooking\Services
 */
class SSBookClient extends ContainerBase
{
    public function __construct($params=array())
    {
        parent::__construct($params);
    }

    /**
     * 服务提供者
     * @var array
     */
    protected $provider=[
        HotelProvider::class,
    ];
}
