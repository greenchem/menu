<?php $__env->startSection('css'); ?>
    <title>帳號系統</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('demonic.manager.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('init', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>