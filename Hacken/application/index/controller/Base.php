<?php
namespace app\index\controller;

use think\Controller;
use think\Session;

class Base extends Controller
{
    function __construct() {
        Session::init();
        parent::__construct();
    }

    /**
     * 接口返回格式
     * @param $errcode
     * @param $errmsg
     * @param $data
     * @return \think\response\Json
     */
    protected function apireturn($errcode, $errmsg, $data)
    {
        return json([
            'errcode' => $errcode,
            'errmsg' => $errmsg,
            'data' => $data
        ]);
    }
}
