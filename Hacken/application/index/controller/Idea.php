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
            return $this->apireturn('-1', 'Idea过多', '');
        }
        // 创建idea的用户status更新
        Db::name('user')
            ->where(['id' => $uid])
            ->update(['status'=>1]);
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
            return $this->apireturn('-1', '数据库错误', '');
        }
        return $this->apireturn('0', '操作成功', $rel);
    }

    /**
     * 修改idea信息
     * @param Request $request
     * @return \think\response\Json
     * @throws \think\Exception
     */
    public function editidea(Request $request)
    {
        // 判断登录状态
        if(empty(Session::has('hacker'))) {
            redirect('login/index');
        }
        $uid = Session::get('hacker.id');
        $iid = $request->post('iid');
        $info = Db::name('idea')->where(['id' => $iid])->find();
        if($uid != $info['uid']) {
            return $this->apireturn('-1', '权限不足', '');
        }
        $title = $request->post('title');
        $summary = $request->post('summary');
        $need = $request->post('need');
        try {
            $rel = Db::name('idea')
                ->where(['id' => $iid])
                ->update([
                    'title' => $title,
                    'summary' => $summary,
                    'need' => $need
                ]);
        } catch (PDOException $e) {
            return $this->apireturn('-1', '数据库错误', '');
        }
        return $this->apireturn('0', '操作成功', $rel);
    }

    /**
     * 删除自己的idea
     * @param Request $request
     * @return \think\response\Json
     * @throws \think\Exception
     */
    public function delidea(Request $request)
    {
        // 判断登录状态
        if(empty(Session::has('hacker'))) {
            redirect('login/index');
        }
        $uid = Session::get('hacker.id');
        $iid = $request->post('iid');
        $info = Db::name('idea')->where(['id' => $iid])->find();
        if($uid != $info['uid']) {
            return $this->apireturn('-1', '权限不足', '');
        }
        if (!empty($info)) {
            // TODO 更新所有参与该idea成员的状态
            for($i = 1; $i <= 6; $i++) {
                $userstr = 'user'.$i;
                if (empty($info[$userstr])) {
                    break;
                }
                // 每一个用户的状态进行更改
                Db::name('user')
                    ->where(['id' => $info[$userstr]])
                    ->update(['status'=>0]);
            }
        }
        try {
            $rel = Db::name('idea')
                ->where(['id' => $iid, 'uid' => $uid])
                ->delete();
        } catch (PDOException $e) {
            return $this->apireturn('-2', $e->getMessage(), '');
        }

        return $this->apireturn('0', '操作成功', $rel);
    }

}
