<?php

namespace DishCheng\Ssbooking\Services\Hotel;

use DishCheng\Ssbooking\Core\BaseClient;

/**
 * 服务端请求服务端
 * Class ClientRequestService
 * @package App\Http\Service
 */
class Hotel extends BaseClient
{
    /**
     * 酒店列表
     * @param array $params
     * @return $this
     */
    public function hotelList($params=[])
    {
        $this->url_info='/product/gethotelinfo';
        $this->app->setReqData($params);
        return $this;
    }

    /**
     * 酒店房间列表
     * @param $hotelId
     * @return $this
     */
    public function hotelRoomsList($hotelId)
    {
        $this->url_info='/product/getroominfo';
        $this->app->setReqData(['HotelId'=>$hotelId]);
        return $this;
    }


    /**
     * 获取单个酒店报价
     * @param array $params
     * @return $this
     */
    public function getSingleHotelPrice($params=[])
    {
        $this->app->setReqData($params);
        $this->url_info='/product/getprice';
        return $this;
    }

    /**
     * 酒店信息变更
     * @param string $MaxChangeId
     * @return $this
     */
    public function getHotelChangeInfo($MaxChangeId='')
    {
        if (!blank($MaxChangeId)) {
            $this->app->setReqData(['MaxChangeId'=>$MaxChangeId]);
        }
        $this->url_info='/product/getprice';
        return $this;
    }
}
