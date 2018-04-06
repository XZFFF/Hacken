<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\exception\PDOException;
use think\Request;
use think\Session;

class News extends Base
{

    /**
     * 用户未读消息开关
     * @param Request $request
     * @return \think\response\Json
     * @throws \think\Exception
     */
    public function changeread(Request $request)
    {
        // 判断登录状态
        if(empty(Session::has('hacker'))) {
            redirect('login/index');
        }
        $uid = Session::get('hacker.id');
        $read = $request->post('read');
        try {
            $rel = Db::name('user')->where(['id' => $uid])->update(['read' => $read]);
        } catch (PDOException $e) {
            return $this->apireturn('-2', $e->getMessage(), '');
        }
        return $this->apireturn('0', '操作成功', $rel);

    }

    /**
     * 用户收到的消息
     * @return \think\response\Json
     */
    public function getnews()
    {
        // 判断登录状态
        if(empty(Session::has('hacker'))) {
            redirect('login/index');
        }
        $uid = Session::get('hacker.id');
        try {
            $rel = Db::name('news')
                ->where(['uid' => $uid])
                ->whereOr(['iuid' => $uid])
                ->select();
            // 查询每一个申请中，申请人、idea名称以及状态字段
            foreach ($rel as $key => $value) {
                $theiid = $rel[$key]['iid'];
                $theidea = Db::name('idea')->where(['id' => $theiid])->find();
                $theideatitle = $theidea['title'];
                $theuid = $rel[$key]['uid'];
                $theuser = Db::name('user')->where(['id' => $theuid])->find();
                $theusername = $theuser['realname'];
                $rel[$key]['ideatitle'] = $theideatitle;
                $rel[$key]['userrealname'] = $theusername;
            }
        } catch (PDOException $e) {
            return $this->apireturn('-2', $e->getMessage(), '');
        }
        return $this->apireturn('0', '操作成功', $rel);
    }

    /**
     * 确认申请消息
     * @param Request $request
     * @return \think\response\Json
     * @throws \think\Exception
     */
    public function confirmnews(Request $request)
    {
        // 判断登录状态
        if(empty(Session::has('hacker'))) {
            redirect('login/index');
        }
        $uid = Session::get('hacker.id');

        $nid = $request->post('nid');
        $applyid = $request->post('uid');
        $iid = $request->post('iid');
        $status = $request->post('status');

        if ($status == 2) {
            $rel = Db::name('news')->where(['id' => $nid])->update(['status' => 2]);
            return $this->apireturn('0', '操作成功', $rel);
        }

        // 用户有了idea组，变成拒绝
        $info = Db::name('user')->where(['id' => $applyid])->find();
        $theusername = $info['realname'];
        if ($info['status'] != 0) {
            Db::name('news')->where(['id' => $nid, 'status' => 0])->update(['status' => 2]);
            return $this->apireturn('-1', '一个人只可以参与一个idea', '');
        }

        try {
            $rel = Db::name('news')
                ->where(['id' => $nid, 'iuid' => $uid])
                ->update(['status' => $status]);

            // 同意后，idea组user+1
            $temp = Db::name('idea')->where(['id' => $iid])->find();
            for($i = 1; $i <= 6; $i++) {
                $userstr = 'user'.$i;
                if (empty($temp[$userstr])) {
                    Db::name('idea')->where(['id' => $iid])->update([$userstr => $theusername]);
                    if ($i == 6) {
                        // 所有申请消息变成拒绝
                        Db::name('news')->where(['iid' => $iid, 'status' => 0])->update(['status' => 2]);
                        // idea组变成满员
                        Db::name('idea')->where(['id' => $iid])->update(['status' => 1]);
                    }
                    break;
                }
            }

            // 用户状态更新
            Db::name('user')->where(['id' => $applyid])->update(['status' => 1]);

        } catch (PDOException $e) {
            return $this->apireturn('-2', $e->getMessage(), '');
        }
        return $this->apireturn('0', '操作成功', $rel);
    }

}
