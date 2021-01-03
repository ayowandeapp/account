<?php $__env->startSection('content'); ?>

    <div id="content">
        <div id="content-header">
        </div>

        <div class="container-fluid row-fluid">
            <div class="row">
                <div class="col-4 offset-4" style="margin-top: 50px;">
                    <form action="<?php echo e(route('setting.post')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="name">Change Name</label>
                            <input type="text" name="name" id="name" value="<?php echo e(Auth::user()->name); ?>" class="form-control">
                            <input type="hidden" name="id" value="<?php echo e(Auth::User()->id); ?>">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Update Name" class="btn btn-primary float-right">
                        </div>
                    </form>
                </div>
                <div class="col-4 offset-4">
                    <form action="<?php echo e(route('setting.post')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="password">Change Password</label>
                            <input type="text" name="password" id="password" class="form-control">
                            <input type="hidden" name="id" value="<?php echo e(Auth::User()->id); ?>">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Update Password" class="btn btn-danger float-right">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('site_layout.dashboard_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\accountApp\resources\views/settings.blade.php ENDPATH**/ ?>