<ul class="nav nav-tabs">
    <li role="presentation"><a href="<?php echo e(url('demonic/manager/account')); ?>">帳號</a></li>
    <li role="presentation" class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">菜單系統 <span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a href="<?php echo e(url('demonic/manager/menu/element')); ?>">管理元素</a></li>
            <li><a href="<?php echo e(url('demonic/manager/menu/menu')); ?>">管理菜單</a></li>
            <li><a href="<?php echo e(url('demonic/manager/menu/export')); ?>">匯出報表</a></li>
        </ul>
    </li>
    <li role="presentation"><a href="<?php echo e(url('demonic/manager/fee')); ?>">付費</a></li>
</ul>
