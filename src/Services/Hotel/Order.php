<?php

namespace DishCheng\Ssbooking\Services\Hotel;


use DishCheng\Ssbooking\Core\BaseClient;

class Order extends BaseClient
{
    /**
     * 试单接口
     * @param $params
     * @return $this
     */
    public function checkprice(array $params)
    {
        $this->app->setReqData($params);
        $this->url_info='/order/checkprice';
        return $this;
    }


    /**
     * 下单
     * @param $params
     * @return $this
     */
    public function bookOrder(array $params)
    {
        $this->app->setReqData($params);
        $this->url_info='/order/booking';
        return $this;
    }


    /**
     * 订单详情
     * @param $orderId
     * @return $this
     */
    public function queryorder($orderId)
    {
        $this->app->setReqData(['OrderId'=>$orderId]);
        $this->url_info='/order/queryorder';
        return $this;
    }


    /**
     * 获取订单状态
     * @param $orderId
     * @return $this
     */
    public function queryorderstatus($orderId)
    {
        $this->app->setReqData(['OrderId'=>$orderId]);
        $this->url_info='/order/queryorderstatus';
        return $this;
    }


    /**
     * 取消订单接口
     * @param $orderId
     * @return $this
     */
    public function cancel($orderId)
    {
        $this->app->setReqData(['OrderId'=>$orderId]);
        $this->url_info='/order/cancel';
        return $this;
    }
}
