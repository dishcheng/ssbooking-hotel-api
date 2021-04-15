<?php

return [
    //测试
    "MODE"=>env("SSB_HOTEL_MODE", "TEST"),//对接环境；TEST-测试服;PROD-正式服
    'IS_DEBUG'=>env('SSB_HOTEL_IS_DEBUG', false),//是否调试模式
    'Wid'=>env('SSB_HOTEL_WID', ''),//分销商ID
    'ApiKey'=>env('SSB_HOTEL_APIKEY', ''),//分销商验证码
];
