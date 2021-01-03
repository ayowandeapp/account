<!DOCTYPE html>
<html lang="en">

<head>
    <title>کیش بک میں داخل ہوں</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo e(asset('site_assets/css/bootstrap.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('site_assets/css/bootstrap-responsive.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('site_assets/css/maruti-login.css')); ?>" />
    <style>
        .is-invalid {
            border-color: red;
        }

        .invalid-feedback {
            color: red;
        }

    </style>
</head>

<body>
    <div id="loginbox">
        <form method="POST" action="<?php echo e(route('login')); ?>" id="loginform" class="form-vertical">
            <?php echo csrf_field(); ?>
            <div class="control-group normal_text">
                
                <h3>Login</h3>
            </div>
            <?php if(Session::has('error')): ?>
                <div class="col-12">
                    <div class="alert alert-warning"><?php echo e(Session::get('error')); ?></div>
                </div>
            <?php endif; ?>
            <div class="control-group">
                <div class="controls">
                    <div class="main_input_box">
                        <span class="add-on"><i class="icon-user"></i></span>

                        <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="email" value="<?php echo e(old('email')); ?>" required placeholder="Email" autofocus>

                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <div class="main_input_box">
                        <span class="add-on"><i class="icon-lock"></i></span>
                        <input id="password" type="password"
                            class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required
                            autocomplete="current-password" placeholder="Password">

                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <span class="pull-left"><a href="#" class="flip-link btn btn-inverse" id="to-recover">Lost
                        password?</a></span>
                <span class="pull-right"><input type="submit" class="btn btn-success" value="Login" /></span>
            </div>
        </form>
        <form id="recoverform" action="#" class="form-vertical">
            <p class="normal_text">Enter your e-mail address below and we will send you instructions how to recover a
                password.</p>

            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on"><i class="icon-envelope"></i></span><input type="text"
                        placeholder="E-mail address" />
                </div>
            </div>

            <div class="form-actions">
                <span class="pull-left"><a href="#" class="flip-link btn btn-inverse" id="to-login">&laquo; Back to
                        login</a></span>
                <span class="pull-right"><input type="submit" class="btn btn-info" value="Recover" /></span>
            </div>
        </form>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/maruti.login.js"></script>
</body>

</html>
<?php /**PATH D:\xampp\htdocs\accountApp\resources\views/auth/login.blade.php ENDPATH**/ ?>