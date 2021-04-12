<?php

namespace DishCheng\Ssbooking\Core;

/**
 * Class ContainerBase
 * @package DishCheng\Ssbooking\Core
 */
class ContainerBase extends Container
{
    /**
     * @var array
     */
    protected $provider=[];

    /**
     * @var array
     */
    public $params=array();

    /**
     * @var
     */
    public $base_url;


    public $Wid;
    public $ApiKey;

    public $ReqData;

    /**
     * ContainerBase constructor.
     * @param array $params
     */
    public function __construct($params=array())
    {
        if ($params) {
            foreach ($params as &$item) {
                if (is_array($item)||is_object($item)) {
                    $item=json_encode($item, JSON_UNESCAPED_UNICODE);
                }
            }
        }
        $provider_callback=function ($provider) {
            $obj=new $provider;
            $this->serviceRegister($obj);
        };
        array_walk($this->provider, $provider_callback);//注册
    }

    /**
     * @param $id
     * @return mixed
     */
    public function __get($id)
    {
        return $this->offsetGet($id);
    }

    /**
     * @param mixed $Wid
     */
    public function setWid($Wid): void
    {
        $this->Wid=$Wid;
    }

    /**
     * @param mixed $ApiKey
     */
    public function setApiKey($ApiKey): void
    {
        $this->ApiKey=$ApiKey;
    }

    /**
     * @param mixed $ReqData
     */
    public function setReqData($ReqData): void
    {
        $this->ReqData=$ReqData;
    }


}
