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
        // 判断是否有参与的idea
        $info = Db::name('user')->where(['id' => $uid])->find();
        if ($info['status'] == 1) {
            return $this->apireturn('-1', '已经有Idea组了', '');
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
            // 创建idea的用户status更新
            Db::name('user')
                ->where(['id' => $uid])
                ->update(['status'=>1]);
            // 创建idea的用户所有的其他申请变成拒绝状态
            Db::name('news')
                ->where(['uid' => $uid])
                ->update(['status' => 2]);
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
     * 更新idea组状态 0-招募 1-满员
     * @param Request $request
     * @return \think\response\Json
     * @throws \think\Exception
     */
    public function changestatus(Request $request)
    {
        // 判断登录状态
        if(empty(Session::has('hacker'))) {
            redirect('login/index');
        }
        $uid = Session::get('hacker.id');
        $iid = $request->post('iid');
        $status = $request->post('status');
        $info = Db::name('idea')->where(['id' => $iid])->find();
        if($uid != $info['uid']) {
            return $this->apireturn('-1', '权限不足', '');
        }
        try {
            $rel = Db::name('idea')
                ->where(['id' => $iid])
                ->update([
                    'status' => $status
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
            // 更新所有参与该idea成员的状态
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
            return $this->apireturn('-2', '数据库错误', '');
        }
        return $this->apireturn('0', '操作成功', $rel);
    }

    /**
     * 获取所有的idea
     * @param Request $request
     * @return \think\response\Json
     */
    public function getidea()
    {
        try {
            $rel = Db::name('idea')
                ->where(1)
                ->select();
            foreach ($rel as $key => $value) {
                for($i = 1; $i <= 6; $i++) {
                    $userstr = 'user' . $i;
                    if (empty($rel[$key][$userstr])||$rel[$key][$userstr]<=0) {
                        $i--;
                        break;
                    }
                    $userid = $rel[$key][$userstr];
                    $rel[$key][$userstr] = Db::name('user')
                        ->field('id, realname, gender, role, tel, qq, wechat')
                        ->where(['id' => $userid])->find();
                }
                $rel[$key]['usernum'] = $i;
            }
        } catch (PDOException $e) {
            return $this->apireturn('-2', '数据库错误', '');
        }
        return $this->apireturn('0', '操作成功', $rel);
    }

    /**
     * 搜索idea
     * @param Request $request
     * @return \think\response\Json
     */
    public function selectidea(Request $request)
    {
        $keyword = $request->post('keyword');
        try {
            $rel = Db::name('idea')
                ->where('title', 'like', '%'.$keyword.'%')
                ->select();
        } catch (PDOException $e) {
            return $this->apireturn('-2', '数据库错误', '');
        }
        return $this->apireturn('0', '操作成功', $rel);
    }


    /**
     * 申请一个idea组
     * @param Request $request
     * @return \think\response\Json
     */
    public function applyidea(Request $request)
    {
        // 判断登录状态
        if(empty(Session::has('hacker'))) {
            redirect('login/index');
        }
        $uid = Session::get('hacker.id');
        $iid = $request->post('iid');
        // 检测用户是否已有idea组
        $info = Db::name('user')->where(['id' => $uid])->find();
        if ($info['status'] != 0) {
            return $this->apireturn('-1', '一个人只可以参与一个idea喔', '');
        }
        // 不可重复发送消息给同一个idea组
        $info = Db::name('news')->where(['uid' => $uid, 'iid' => $iid, 'status' => 0])->find();
        if (!empty($info)) {
            return $this->apireturn('-1', '你已经申请过该idea组了', '');
        }
        // 查询idea的创建人
        $info = Db::name('idea')->where(['id' => $iid])->find();
        $iuid = $info['uid'];
        $createtime = date("Y-m-d H:i:s", time());
        try {
            // 发送申请消息给该idea组创建人
            $rel = Db::name('news')->strict(false)
                    ->insert([
                        'uid' => $uid,
                        'iid' => $iid,
                        'iuid' => $iuid,
                        'createtime' => $createtime
                    ]);
        } catch (PDOException $e) {
            return $this->apireturn('-2', $e->getMessage(), '');
        }
        return $this->apireturn('0', '操作成功', $rel);
    }

}
