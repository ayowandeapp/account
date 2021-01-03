<?php $__env->startSection('content'); ?>

    <div id="content">
        <div id="content-header">
        </div>
        <div class="container-fluid">
            <?php echo $__env->make('site_layout.top_widget', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        <div class="container-fluid row-fluid text-center">
            <div class="col-12" id="main-contentArea">
                <h2>Hi,</h2>
                <h3>Welcome Dear <?php echo e(Auth::User()->name); ?>!</h3>
                <a href="#" class="btn btn-primary" id="start-khata">Start Now (کھاتہ شروع کریں)</a>
            </div>
        </div>
    </div>

    <?php echo $__env->make('site_layout.general_khata_area', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('site_layout.dashboard_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projects\daniyal\accountApp\resources\views/welcome.blade.php ENDPATH**/ ?>