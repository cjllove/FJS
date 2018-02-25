<?php
namespace cc;
use think\Db;
class Grid{
    public $key,$value,$resstring;
    public function GridBind()
    {

    }
    public function GridGetJson($colums,$arr)
    {
        $keys=json_encode(explode(',',$colums),JSON_UNESCAPED_UNICODE);
        // while($row=$arr)
        // {
        //     array_push($arrrow,$row);  

        // }
   
     return json_encode($arr,JSON_UNESCAPED_UNICODE);
    }
}
?>