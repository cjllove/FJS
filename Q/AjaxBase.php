<?php
header("Content-Type:text/html;charset=utf-8;");
session_start(20);
if (!isset($_SESSION['T'])) {
//header('Location: LogIn.html');
}

//namespace FineUi_Js
class AjaxBase
{
    public function __construct()
    {
        if (!isset($_SESSION['T'])) {
         //header('Location: LogIn.html');
        }
    }

    public static function ProcessRequest()
    {
        if (isset($_GET["sMode"]) && isset($_GET["var1"])) {
            $con = mysqli_connect("localhost", "fjs", "fjs", "fjs");
            mysqli_set_charset($con, 'utf8');

            $mode = $_GET["sMode"];//模式
            $var1 = $_GET["var1"];//用户
            //特定获取一级菜单
            switch ($mode) {
                case "memo":
                    if (strlen($var1) > 0) {
                        $sql = @"select * from (SELECT * FROM sys_funcrole WHERE treeid='00' )t
                            ORDER BY t.funcid ";
                        $result = mysqli_query($con, $sql);
                        $arr = array();
                        while ($row = $result->fetch_assoc()) {
                            $count = count($row);//不能在循环语句中，由于每次删除row数组长度都减小
                            for ($i = 0; $i < $count; $i++) {
                                unset($row[$i]);//删除冗余数据
                            }
                            array_push($arr, $row);

                        }
                        //echo json_encode($arr,JSON_UNESCAPED_UNICODE);
                        AjaxBase::MyJsonPrint($arr, true);
                    }
                    break;
                case "memo2":
                    if (strlen($var1) > 0) {
                        $sqlgetvar = @"SELECT getChildlst('1') str";
                        $res = mysqli_query($con, $sqlgetvar);
                        while ($row = $res->fetch_assoc()) {
                            $str = $row["str"];
                        }
                        $sql = @" SELECT * FROM sys_funcrole
                            WHERE roleid='00' and FIND_IN_SET(funcid,'$str') ORDER BY  FUNCID ASC ";
                        $result = mysqli_query($con, $sql);
                        $arr = array();
                        while ($row = $result->fetch_assoc()) {
                            $count = count($row);//不能在循环语句中，由于每次删除row数组长度都减小
                            for ($i = 0; $i < $count; $i++) {
                                unset($row[$i]);//删除冗余数据
                            }
                            array_push($arr, $row);

                        }

                        //echo json_encode($arr,JSON_UNESCAPED_UNICODE);
                        AjaxBase::MyJsonPrint($arr, true);
                    }
                    break;
                case "memo3":
                    if (strlen($var1) > 0) {
                        $sqlgetvar = @"SELECT getChildlst($var1) str";
                        $res = mysqli_query($con, $sqlgetvar);
                        while ($row = $res->fetch_assoc()) {
                            $str = $row["str"];
                        }
                        $sql = @" SELECT * FROM sys_funcrole
                            WHERE roleid='00' and FIND_IN_SET(funcid,'$str') ORDER BY  FUNCID ASC ";
                        $result = mysqli_query($con, $sql);
                        $arr = array();
                        while ($row = $result->fetch_assoc()) {
                            $count = count($row);//不能在循环语句中，由于每次删除row数组长度都减小
                            for ($i = 0; $i < $count; $i++) {
                                unset($row[$i]);//删除冗余数据
                            }
                            array_push($arr, $row);

                        }

                        //echo json_encode($arr,JSON_UNESCAPED_UNICODE);
                        AjaxBase::MyJsonPrint($arr, true);


                    }
                    break;
            }
        }

    }

    public static function MyJsonPrint($ar, $flag)
    {
        $res = "";
        if ($flag) {
            $res = "{\"result\": \"succeed\",\"reason\": \"\",\"data\": " . json_encode($ar, JSON_UNESCAPED_UNICODE) . "}";
        }
        echo($res);
        return $res;
    }

    public static function CheckIsLog()
    {
        $Larr = array('ISONLINE' => true);
        if (!isset($_SESSION['T'])) {
            $Larr = array('ISONLINE' => false);

        } else {

        }
        echo json_encode($Larr, JSON_UNESCAPED_UNICODE);
    }

    public static function LogOut()
    {
        $_SESSION['T'] = '';
        $_SESSION = array();
        session_destroy();
        $Larr = array('ISLOUT' => true);
        echo json_encode($Larr, JSON_UNESCAPED_UNICODE);

    }

}

$obj = new AjaxBase();
AjaxBase::ProcessRequest();
if (isset($_GET['O']) && $_GET['O'] == 'LogOut') {
    AjaxBase::LogOut();
}
if (isset($_GET['O']) && $_GET['O'] == 'OnLine') {
    AjaxBase::CheckIsLog();
}
?>