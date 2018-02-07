<?php
header("Content-Type:text/html;charset=utf-8;");


//namespace FineUi_Js
     class AjaxBase
    {

        public static function ProcessRequest()
        {
            if ($_GET["sMode"] != null &&  $_GET["var1"]!=null)
            {
                $con=mysqli_connect("localhost","cjl","cjl","cjl");
                mysqli_set_charset($con,'utf8');

                 $mode = $_GET["sMode"];//模式
                 $var1=$_GET["var1"];//用户
                //特定获取一级菜单
                switch ($mode)
                {
                    case "memo":
                        if (strlen($var1) > 0)
                        {
                            $sql = @"select * from (SELECT * FROM sys_funcrole WHERE treeid='00' )t
                            ORDER BY t.funcid ";
                            $result=mysqli_query($con,$sql);
                            $arr=array();
                            while($row = $result->fetch_assoc()) {  
                                $count=count($row);//不能在循环语句中，由于每次删除row数组长度都减小  
                                for($i=0;$i<$count;$i++){  
                                    unset($row[$i]);//删除冗余数据  
                                }  
                                array_push($arr,$row);  
                              
                            }  
                            //echo json_encode($arr,JSON_UNESCAPED_UNICODE);
                            AjaxBase::MyJsonPrint($arr,true);
                        }
                        break;
                    case "memo2":
                        if (strlen($var1) > 0)
                        {
                            $sql = @"select * from (SELECT * FROM sys_funcrole WHERE treeid='00' AND FUNCID=1 )t
     ORDER BY t.funcid ";
                            $result=mysqli_query($con,$sql);
                            $arr=array();
                            while($row = $result->fetch_assoc()) {  
                                $count=count($row);//不能在循环语句中，由于每次删除row数组长度都减小  
                                for($i=0;$i<$count;$i++){  
                                    unset($row[$i]);//删除冗余数据  
                                }  
                                array_push($arr,$row);  
                              
                            }  
                            //echo json_encode($arr,JSON_UNESCAPED_UNICODE);
                            AjaxBase::MyJsonPrint($arr,true);
                        }
                        break;
                    case "memo3":
                        if (strlen($var1) > 0)
                        {
                            $sql = @" SELECT * FROM sys_funcrole
                            WHERE  FIND_IN_SET(funcid, getChildLst($var1))  ";
                       $result=mysqli_query($con,$sql);
                       $arr=array();
                       while($row = $result->fetch_assoc()) {  
                           $count=count($row);//不能在循环语句中，由于每次删除row数组长度都减小  
                        //    for($i=0;$i<$count;$i++){  
                        //        unset($row[$i]);//删除冗余数据  
                        //    }  
                           array_push($arr,$row);  
                         
                       }  
                       //echo json_encode($arr,JSON_UNESCAPED_UNICODE);
                       AjaxBase::MyJsonPrint($arr,true);

                         
                        }
                        break;
                }
            }

        }
      
        public static function MyJsonPrint($ar, $flag )
        {
             $res = "";
            if ($flag)
            {
                $res = "{\"result\": \"succeed\",\"reason\": \"\",\"data\": ".json_encode($ar,JSON_UNESCAPED_UNICODE). "}";
            }
            echo($res);
            return $res;
        }

     
    }
   AjaxBase::ProcessRequest();
?>