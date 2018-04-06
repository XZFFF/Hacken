<?php
namespace app\index\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
        return $this->fetch('index/index');
    }

    public function hacker()
    {
        return $this->fetch('hacker/hacker_list');
    }

    public function idea()
    {
        return $this->fetch('idea/idea_new');
    }

    public function mine()
    {
        return $this->fetch('mine/mine_change');
    }
}
