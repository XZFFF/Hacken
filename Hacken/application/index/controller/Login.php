<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\exception\PDOException;
use think\Request;
use think\Session;

class Login extends Base
{
//    public function index()
//    {
//        return $this->fetch('login/index');
//    }


    /**
     * 注册函数
     * @param Request $request
     * @param Request $request
     */
    public function register(Request $request)
    {
        $username = $request->post('username');
        $password = $request->post('password');
        $pwd = md5($password);
        $realname = $request->post('realname');
        $gender = $request->post('gender');
        $createtime = date("Y-m-d H:i:s", time());
        $rel = array();
        $info = Db::name('user')->where(['username' => $username])->find();
        if (!empty($info)) {
            return $this->apireturn('-1', 'Exist username', $rel);
        }
        try {
            $rel = Db::name('user')
                ->strict(false)
                ->insert([
                    'username' => $username,
                    'password' => $pwd,
                    'realname' => $realname,
                    'gender' => $gender,
                    'createtime' => $createtime]);
        } catch (PDOException $e) {
            return $this->apireturn('-2', $e->getMessage(), $rel);
        }
        return $this->apireturn('0', 'Success', $rel);
    }

    /**
     * 登录函数
     * @param Request $request
     * @return \think\response\Json
     */
    public function islogin(Request $request)
    {
        $username = $request->post('username');
        $password = $request->post('password');
        $pwd = md5($password);

        $rel = Db::name('user')
            ->field(['id', 'realname', 'gender', 'status', 'createtime'])
            ->where(['username' => $username, 'password' => $pwd])
            ->find();
        if (empty($rel)) {
            return $this->apireturn('-1', 'Wrong username or password.', $rel);
        } else {
            Session::set('hacker', $rel);
            return $this->apireturn('0', 'Success', $rel);
        }
    }

}
