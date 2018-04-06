<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\exception\PDOException;
use think\Request;
use think\Session;

class User extends Base
{
    /**
     * 修改用户个人信息
     * @param Request $request
     * @return \think\response\Json
     * @throws \think\Exception
     */
    public function edituserinfo(Request $request)
    {
        // 判断登录状态
        if(empty(Session::has('hacker'))) {
            redirect('login/index');
        }
        $role = $request->post('role');
        $tel = $request->post('tel');
        $qq = $request->post('qq');
        $wechat = $request->post('wechat');
        $skill1 = $request->post('skill1');
        $skill2 = $request->post('skill2');
        $skill3 = $request->post('skill3');
        $skill4 = $request->post('skill4');
        $skill5 = $request->post('skill5');
        $skill6 = $request->post('skill6');
        $resume = $request->post('resume');

        // 获取Seesion中的hacker的id
        $uid = Session::get('hacker.id');

        try {
            $rel = Db::name('user')
                ->where(['id' => $uid])
                ->update([
                'role' => $role,
                'tel' => $tel,
                'qq' => $qq,
                'wechat' => $wechat,
                'skill1' => $skill1,
                'skill2' => $skill2,
                'skill3' => $skill3,
                'skill4' => $skill4,
                'skill5' => $skill5,
                'skill6' => $skill6,
                'resume' => $resume
            ]);
        } catch (PDOException $e) {
            return $this->apireturn('-1', '数据库错误', '');
        }
        return $this->apireturn('0', '操作成功', $rel);
    }

    /**
     * 获取用户信息
     * @return \think\response\Json
     */
    public function getuserinfo()
    {
        // 判断登录状态
        if(empty(Session::has('hacker'))) {
            redirect('login/index');
        }
        $uid = Session::get('hacker.id');

        try {
            // 密码不可查
            $rel = Db::name('user')
                ->field('id, realname, gender, role, tel, qq, wechat,
                 status, read, skill1, skill2, skill3, skill4, skill5,
                 skill6, resume, createtime')
                ->where(['id' => $uid])
                ->find();
            // 参与的idea
            $idea = Db::name('idea')
                ->where(['uid' => $uid])
                ->whereOr('user1|user2|user3|user4|user5|user6', '=', $uid)
                ->find();
            $rel['idea'] = $idea;
            $news = Db::name('news')
                ->where(['uid' => $uid, 'status' => 0])
                ->whereOr(['iuid' => $uid])
                ->select();
            $rel['news'] = $news;
        } catch (PDOException $e) {
            return $this->apireturn('-1', '数据库错误', '');
        }
        return $this->apireturn('0', '操作成功', $rel);
    }

}
