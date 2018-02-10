<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
 
    <link href="../F/F.css" rel="stylesheet" />
    <link href="../res/css/common.css" rel="stylesheet" />
 
    <style>
        .mysimpleform .f-field {
            margin-bottom: 0 !important;
        }
    </style>
 
</head>
<body>
    <div id="wrap1"></div>
    <br />
 
 
    <script src="../F/F.js"></script>
    <script src="../res/js/common.js"></script>
    <script>
        F.ready(function () {
 
            F.ui({
                type: 'panel', renderTo: '#wrap1',  height: 500, bodyPadding: 5, collapsible: false, title: '商品资料管理',
                layout: {
                    childMargin: '0 0 5 0', type: 'vbox'
                },
                items: [{
                    type: 'form', id: 'form1', cls: 'mysimpleform', layout: 'hbox', border: false, collapsible: true, header: false,
                    items: [{
                        type: 'label', value: '销毁统计时间段：'
                    }, {
                        type: 'datepicker', id: 'datepicker1', cls: 'marginr', width: 150, hideLabel: true, fieldLabel: '销毁统计开始时间', required: true, emptyText: '请选择开始日期', editable: false
                    }, {
                        type: 'datepicker', cls: 'marginr', width: 150, hideLabel: true, fieldLabel: '销毁统计结束时间', required: true, compareControl: 'datepicker1', compareOperator: '>', compareMessage: '结束日期应该大于开始日期', emptyText: '请选择结束日期', editable: false
                    }, {
                        type: 'button', cls: 'marginr', text: '重置起止时间',
                        handler: function () {
                            F.ui.form1.reset();
                        }
                    }, {
                        type: 'button', text: '查询', validateForm: 'form1',
                        handler: function () {
                            F.alert('表单验证通过！');
                        }
                    }]
                }, {
                    type: 'panel', margin: 0, flex: 1, header: false
                }]
            });
 
 
           
 
 
 
 
        });
    </script>
</body>
</html>