<?php
namespace app\CCDictionary\controller;
use think\Controller;
use think\Db;
use think\Request;
use cc\Grid;
class Goodsmanage extends controller{
    function index (){
        $result=Db::table('sys_function')->select();//column('funcid','funcname','runwhat','micohelp');
          $obj=new Grid();
        $this->assign('arrfun',$obj->GridGetJson('funcid,funcname,runwhat,micohelp',$result));
           return $this->fetch();
    }
}
?>