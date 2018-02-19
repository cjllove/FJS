<?php
namespace app\CCDictionary\controller;
use think\Controller;
use think\Db;
use think\Request;
class Goodsmanage extends controller{
    function index (){
        $con=mysqli_connect("localhost","cjl","cjl","cjl");
        $arrfun=array();
        $result=mysqli_query($con,'select funcid,funcname,runwhat,micohelp
        from sys_function');
        while($row = $result->fetch_assoc()) { 
              array_push($arrfun,$row);            
        }  
        $ss="{\"fields\": \"succeed\",\"reason\": \"\",\"data\": ".json_encode($arrfun,JSON_UNESCAPED_UNICODE). "}";
        $this->assign('arrfun',$ss);
           return $this->fetch();
    }
}
?>