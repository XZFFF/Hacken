<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\exception\PDOException;
use think\Request;
use think\Session;

class Idea extends Base
{

    /**
     * 创建一个新的idea（每人仅可创建一个idea）
     * @param Request $request
     * @return \think\response\Json
     */
    public function createidea(Request $request)
    {
        // 判断登录状态
        if(empty(Session::has('hacker'))) {
            redirect('login/index');
        }
        $uid = Session::get('hacker.id');

        $title = $request->post('title');
        $summary = $request->post('summary');
        $need = $request->post('need');
        $user1 = $uid;
        $createtime = date("Y-m-d H:i:s", time());
        // 判断是否有过idea
        $info = Db::name('idea')->where(['uid' => $uid])->find();
        if (!empty($info)) {
            return $this->apireturn('-1', 'Exist idea', '');
        }
        try {
            $rel = Db::name('idea')
                ->strict(false)
                ->insert([
                    'uid' => $uid,
                    'title' => $title,
                    'summary' => $summary,
                    'need' => $need,
                    'user1' => $user1,
                    'createtime' => $createtime
                ]);
        } catch (PDOException $e) {
            return $this->apireturn('-1', $e->getMessage(), '');
        }
        return $this->apireturn('0', 'Success', $rel);

    }

    public function editidea(Request $request)
    {
        // 判断登录状态
        if(empty(Session::has('hacker'))) {
            redirect('login/index');
        }
        $uid = Session::get('hacker.id');
        $iid = $request->post('iid');
    }

    public function delidea(Request $request)
    {
        // 判断登录状态
        if(empty(Session::has('hacker'))) {
            redirect('login/index');
        }
        $uid = Session::get('hacker.id');
        $iid = $request->post('iid');
    }

    public function changestatus(Request $request)
    {
        // 判断登录状态
        if(empty(Session::has('hacker'))) {
            redirect('login/index');
        }
        $uid = Session::get('hacker.id');
        $iid = $request->post('iid');
    }



}
