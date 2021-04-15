<?php


namespace DishCheng\Ssbooking\Core;


use DishCheng\Ssbooking\Exceptions\SSBookingException;
use DishCheng\Ssbooking\SSBookClient;
use Illuminate\Support\Facades\Log;


/**
 * Class BaseClient
 * @package DishCheng\Ssbooking\Core
 * @property SSBookClient app
 */
class BaseClient
{
    /**
     * @var Container
     */
    protected $app;

    /**
     * @var string
     */
    public $base_url='http://fxstest.xiangdo.cn';

    /**
     * @var
     */
    public $url_info;

    /**
     * @var
     */
    protected $ReqData;

    /**
     * @var
     */
    public $res_url;

    /**
     * BaseClient constructor.
     * @param Container $app
     */
    public function __construct(Container $app)
    {
        $this->app=$app;
    }


    /**
     * 签名
     * @throws SSBookingException
     */
    public function signParams()
    {
        if (empty($this->url_info)) {
            throw new SSBookingException('url因子为空，如无配置，请配置');
        }
        //参数因子
        $Wid=$this->app->Wid;
        $ApiKey=$this->app->ApiKey;
        $ReqData=$this->app->ReqData;
//        dd($ReqData);
        //配置参数，请用apiInfo对应的api参数进行替换
        $params=[
            'Wid'=>$Wid,
            'ApiKey'=>$ApiKey
        ];
        if (!blank($ReqData)&&is_array($ReqData)) {
            $params=array_merge($params, $ReqData);
        }
        $this->res_url=$this->base_url.$this->url_info;
        return $params;
    }

    /**
     * POST请求方式
     * @return mixed
     * @throws SSBookingException
     */
    public function postAndFormat()
    {
        $params=$this->signParams();
        $result=$this->curlRequest($this->res_url, $params, 'post');
//        Log::info("ssBookPrams", $params);
//        Log::info("ssBookResult".$result);
        $resArr=json_decode($result, true);

        if (is_array($resArr)) {
            if (!isset($resArr['Code'])) {
                if (isset($resArr['Message'])) {
                    throw new SSBookingException($resArr['Message']);
                }
                throw new SSBookingException('请求异常-NoCode');
            }
            if ($resArr["Code"]!==200) {
                throw new SSBookingException($resArr['Message'].'('.$resArr["Code"].')');
            }
            return $resArr;
        } elseif (is_string($result)) {
            throw new SSBookingException('请求错误-'.$result);
        } else {
            throw new SSBookingException('请求错误-未知类型');
        }

    }

    /**
     * 设置API地址
     * @param string $path
     */
    public function setPath($path)
    {
        $this->url_info=$path;
        return $this;
    }

    /**
     * curl 请求
     * @param $base_url
     * @param $query_data
     * @param string $method
     * @param bool $ssl
     * @param int $exe_timeout
     * @param int $conn_timeout
     * @param int $dns_timeout
     * @return bool|string
     */
    public function curlRequest($base_url, $query_data, $method='get', $ssl=true, $exe_timeout=10, $conn_timeout=10, $dns_timeout=3600)
    {
        $method=strtolower($method);
        $ch=curl_init();
        if ($method=='get') {
            //method get
            if ((!empty($query_data))
                &&(is_array($query_data))
            ) {
                $connect_symbol=(strpos($base_url, '?')) ? '&' : '?';
                foreach ($query_data as $key=>$val) {
                    if (is_array($val)) {
                        $val=serialize($val);
                    }
                    $base_url.=$connect_symbol.$key.'='.rawurlencode($val);
                    $connect_symbol='&';
                }
            }
        } else {
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'Content-Type: application/json; charset=utf-8',
                ]
            );
            //method post
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($query_data));
        }
        curl_setopt($ch, CURLOPT_URL, $base_url);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $conn_timeout);
        curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, $dns_timeout);
        curl_setopt($ch, CURLOPT_TIMEOUT, $exe_timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        // 关闭ssl验证
        if ($ssl) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }
        $output=curl_exec($ch);
//        dd($output);
        if ($output===FALSE)
            $output=curl_error($ch);
        curl_close($ch);
        return $output;
    }

    /**
     * @return mixed
     */
    public function getReqData()
    {
        return $this->ReqData;
    }

    /**
     * @param mixed $ReqData
     */
    public function setReqData($ReqData): void
    {
        $this->ReqData=$ReqData;
    }


}
