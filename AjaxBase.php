<?php
//namespace FineUi_Js

     class AjaxBase
    {

        public function ProcessRequest()
        {
            if ($_GET["sMode"] != null && !string.IsNullOrEmpty($_GET["sMode"]) && $_GET["var1"]!=null)
            {
                
                 $mode = $_GET["sMode"];//模式
                 $var1=$_GET["var1"];//用户
                //特定获取一级菜单
                switch (mode)
                {
                    case "memo":
                        if (var1.Length > 0)
                        {
                             $sql = @"SELECT A.*
                                    FROM SYS_FUNCROLE A
                                    WHERE TREEID = '00'
                                    ORDER BY ITEMSORT";

                            DataTable dt = DbHelperOra.QueryForTable(sql);
                            context.Response.ContentType = "text/plain";
                            context.Response.Write(MyJsonPrint(dt));
                        }
                        break;
                    case "memo2":
                        if (v1.Length > 0)
                        {
                            String sql = @"SELECT *
                                      FROM (SELECT *
                                              FROM SYS_FUNCROLE
                                             WHERE ROLEID = '00') T
                                     START WITH T.FUNCID = '1'
                                    CONNECT BY T.TREEID = PRIOR T.FUNCID
                                     ORDER SIBLINGS BY ITEMSORT, FUNCID";

                            DataTable dt = DbHelperOra.QueryForTable(sql);
                            context.Response.ContentType = "text/plain";
                            context.Response.Write(MyJsonPrint(dt));
                        }
                        break;
                    case "memo3":
                        if (var1.Length > 0)
                        {
                            String sql = @"SELECT *
                                      FROM (SELECT *
                                              FROM SYS_FUNCROLE
                                             WHERE ROLEID = '00') T
                                     START WITH T.FUNCID = '{0}'
                                    CONNECT BY T.TREEID = PRIOR T.FUNCID
                                     ORDER SIBLINGS BY ITEMSORT, FUNCID";

                            DataTable dt = DbHelperOra.QueryForTable(string.Format(sql, var1));
                            context.Response.ContentType = "text/plain";
                            context.Response.Write(MyJsonPrint(dt));
                        }
                        break;
                }
            }

        }
        // public static string MyJsonPrint(string str, bool flag = true)
        // {
        //     string res = "";
        //     if (flag)
        //     {
        //         res = "{\"result\": \"succeed\",\"reason\": \"\",\"data\": \"" + str + "\"}";
        //     }
        //     else
        //     {
        //         res = "{\"result\": \"fail\",\"reason\": " + str + ",\"data\":\"\" }";
        //     }
        //     return res;
        // }
        public static string MyJsonPrint(DataTable dt, bool flag = true)
        {
            string res = "";
            if (flag)
            {
                res = "{\"result\": \"succeed\",\"reason\": \"\",\"data\": " + JsonConvert.SerializeObject(dt) + "}";
            }
            return res;
        }

        public bool IsReusable
        {
            get
            {
                return false;
            }
        }
    }
   
?>