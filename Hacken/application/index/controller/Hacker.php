<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\exception\PDOException;
use think\Request;
use think\Session;

class Hacker extends Base
{
    /**
     * Hacker信息流
     * @return \think\response\Json
     */
    public function gethacker()
    {
        try {
            // 密码不可查
            $rel = Db::name('user')
                ->field('id, realname, gender, role, tel, qq, wechat,
                 status, read, skill1, skill2, skill3, skill4, skill5,
                 skill6, resume, createtime')
                ->where(1)
                ->select();
        } catch (PDOException $e) {
//          return $this->apireturn('-1', '数据库错误', '');
            return $this->apireturn('-1',$e->getMessage(), '');
        }
        return $this->apireturn('0', '操作成功', $rel);
    }

    /**
     * Hacker搜索
     * @param Request $request
     * @return \think\response\Json
     */
    public function selecthacker(Request $request)
    {
        $keyword = $request->post('keyword');
        try {
            // 密码不可查
            $rel = Db::name('user')
                ->field('id, realname, gender, role, tel, qq, wechat,
                 status, read, skill1, skill2, skill3, skill4, skill5,
                 skill6, resume, createtime')
                ->where('skill1|skill2|skill3|skill4|skill5|skill6', 'like', '%'.$keyword.'%')
                ->select();
        } catch (PDOException $e) {
            return $this->apireturn('-2', '数据库错误', '');
        }
        return $this->apireturn('0', '操作成功', $rel);
    }

}
