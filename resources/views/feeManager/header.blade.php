<ul class="nav nav-tabs">
    <li role="presentation" class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">津貼管理<span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li role="presentation"><a href="{{url('feeManager/meal')}}">一般津貼管理</a></li>
            <li role="presentation"><a href="{{url('feeManager/setQuoda')}}">購物津貼管理</a></li>
        </ul>
    </li>

    <li role="presentation" class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">報表匯出<span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a href="{{url('feeManager/menuExport')}}">禮品報表匯出</a></li>
            <li><a href="{{url('feeManager/feeExport')}}">津貼報表匯出</a></li>
        </ul>
    </li>

    <li role="presentation"><a href="{{url('feeManager/period')}}">期號設定</a></li>

    <li role="presentation"><a href="{{url('feeManager/booking')}}">刪除購物紀錄</a></li>

    <li role="presentation"  style="float: right"><a href="{{url('/api/account_sys/auth/logout')}}">登出</a></li>
    <li role="presentation" style="float: right"><a href="{{url('')}}">回首頁</a></li>
</ul>
