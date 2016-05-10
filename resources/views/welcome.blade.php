<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
              <div class="title">嘉良特化 - 暫時入口</div>
            </div>
            <p><a href="{{url('user/menu')}}">使用者</a></p>
            <p><a href="{{url('menuManager/menu')}}">菜單管理者</a></p>
            <p><a href="{{url('accountManager/account')}}">帳號管理者</a></p>
            <p><a href="{{url('feeManager/parking')}}">津貼管理者</a></p>
            <p><a href="{{url('master/')}}">最高管理者</a></p>
        </div>
    </body>
</html>
