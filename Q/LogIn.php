<?php
require_once ('../H/application/database.php');
class LogIn
{
    protected $Larr = array();
    protected $Lo;
    protected static $Ltoken = '';

    public function __construct()
    {
        session_start(20);
    }

    public function LogOper()
    {
        if (isset($_GET['O'])) {
            if ($_GET['O'] = 'CheckLogIn') {
                if (json_decode(self::CheckLogIn())->{'L'}) {
                    $_SESSION['T'] = self::CreateToken();

                }
            }
        }
    }

    protected static function CheckLogIn()
    {
        $Larr = array('L' => false);
        if (isset($_GET['O']) && isset($_GET['N']) && isset($_GET['P'])) {
            if ($_GET['O'] == 'CheckLogIn') {
                if ($_GET['N'] == 'cjl' && $_GET['P'] == 'cjl') {
                    $Larr = array('L' => true);

                }
            }
        }
        echo json_encode($Larr, JSON_UNESCAPED_UNICODE);
        return json_encode($Larr, JSON_UNESCAPED_UNICODE);
    }

    protected static function CreateToken()
    {
        $str = md5(uniqid(md5(microtime(true)), true));  //生成一个不会重复的字符串
        $str = sha1($str);  //加密
        return $str;
    }

}

$obj = new LogIn();
$obj->LogOper();
?>