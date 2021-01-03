<div id="general-khata-area" style="display: none;">
    <div class="row-fluid">
        <div class="widget-box">
            <div class="widget-title">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#general-khata-point-area" id="generalKhataPointTab">General Khata Point</a></li>
                    <li class=""><a data-toggle="tab" href="#open_account" id="openNewAccountTab">Open New
                            Account</a></li>
                    <li class=""><a data-toggle="tab" href="#add-customer" id="addCustomerTab">Add Customer</a>
                    </li>
                    <li class=""><a data-toggle="tab" href="#add-source-category" id="addcategoryTab">Add Category</a>
                    </li>
                    <li class=""><a data-toggle="tab" href="#add-source-subcategory" id="addSubCategoryTab">Add
                            Sub-category</a></li>


                    
                    </li>
                </ul>
            </div>
            <div class="widget-content tab-content">
                <div id="general-khata-point-area" class="tab-pane active">
                    <div class="row">
                        <div class="col-3 offset-3">
                            <div class="card bg-success">
                                <a href="#" id="cashInButton" style="color: white;">
                                    <div class="card-header">Cash In</div>
                                </a>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card bg-danger">
                                <a href="#" id="cashOutButton" style="color: white;">
                                    <div class="card-header">Cash Out</div>
                                </a>
                            </div>
                        </div>
                        <div class="col-12" id="cashInContainer">
                            <div class="row">
                                <div class="offset-4 col-2">
                                    <input type="radio" name="receiptType" id="receiptCustomerRadio" receipt-type="customer">
                                    <label for="receiptCustomerRadio">Receiving By Customer</label>
                                </div>
                                <div class="col-2">
                                    <input type="radio" name="receiptType" id="receiptAccountRadio" receipt-type="account">
                                    <label for="receiptAccountRadio">Receiving By Dasti</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12" id="appendedReceiptFields">

                                </div>
                            </div>
                        </div>
                        <div class="col-12" id="cashOutContainer">
                            <div class="row">
                                <div class="offset-4 col-2">
                                    <input type="radio" name="paymentType" id="payInExpRadio" value="expense"
                                           receipt-type="payExpese" checked>
                                    <label for="payInExpRadio">Pay in Expense</label>
                                </div>
                                <div class="col-2">
                                    <input type="radio" name="paymentType" id="payemntDastiRadio" value="dasti"
                                           receipt-type="payDasti">
                                    <label for="payemntDastiRadio">Dasti Pay</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12" style="margin-bottom: 10px;">
                                    <div class="row">
                                        <div class="form-group text-left col-3">
                                            <input class="form-control" type="date" name="payment_date" id="payment_date"
                                                   required>
                                        </div>

                                        <div class="form-group col-3 text-left">
                                            <select name="acc_id" id="acc_id" class="form-control" required>
                                                <option value="">Please Select Account</option>
                                                <?php if(isset($accounts)): ?>
                                                    <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($account->id); ?>"><?php echo e($account->acc_name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>

                                            </select>
                                        </div>

                                        <div class="form-group text-left col-3" id="CatDivPayment">
                                            <select name="paycat_id" id="paycat_id" class="form-control" required>
                                                <option value="">Please Select Category</option>
                                                <?php if(isset($categories)): ?>
                                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($category->id); ?>"><?php echo e($category->cat_name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>

                                            </select>
                                        </div>

                                        <div class="form-group text-left col-3" id="subCatDivPayment">
                                            <select name="subcat_id" id="subcat_id" class="form-control" required>
                                                <option value="">You must need to Select Category</option>

                                            </select>
                                        </div>


                                        <div class="form-group text-left col-3">
                                            <input class="form-control text-right" name="description" id="description" required
                                                   placeholder="تفصیل" />
                                        </div>

                                        <div class="form-group text-left col-2">
                                            <input type="number" class="form-control text-right" name="amount" id="amount" required
                                                   placeholder="رقم">
                                        </div>
                                        <div class="form-group text-right">
                                            <input type="button" value="Add" class="btn btn-primary" id="add-payment-btn">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    
                                    <table class="table table-hover table-bordered" id="payment-table" width="100%">
                                        <thead>
                                        <tr>
                                            <td><b>Account</b></td>
                                            <td><b>Sub Category</b></td>
                                            <td><b>Description</b></td>
                                            <td><b>Date</b></td>
                                            <td><b>Amount</b></td>
                                            <td><b>Payment Type</b></td>
                                            <td><b>Actions</b> </td>
                                        </tr>
                                        </thead>
                                        <tbody id="list-of-payments">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="open_account" class="tab-pane">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="acc_name">Account Name</label>
                                <input type="text" class="form-control" name="acc_name" id="acc_name"
                                    placeholder="Please Enter Account Name!" autofocus>
                            </div>
                            <!-- <div class="form-group text-left">
                                <select name="acc_type" id="acc_type" class="form-control">
                                    <option value="">Please Select Khata Type</option>
                                    <?php if(isset($accountstype)): ?>
                                        <?php $__currentLoopData = $accountstype; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>

                                </select>
                            </div> -->
                            <div class="form-group text-right">
                                <input type="button" value="Register" class="btn btn-primary" id="register-account-btn">
                            </div>
                        </div>
                        <div class="offet-1 col-7">
                            <h5>List Of Accounts</h5>
                            <table class="table table-hover table-bordered text-left" id="accountlist-table" width="100%">
                                <thead>
                                    <tr>
                                        <td><b>Account Name</b> </td>

                                        <td><b>Receiving Balance</b> </td>
                                        <td><b>Payment Balance</b> </td>
                                        <td><b>Actions</b> </td>
                                    </tr>
                                </thead>
                                <tbody id="list-of-registered-accounts">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="add-customer" class="tab-pane">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group text-left">
                                <label for="name">Customer Name</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Please Enter Customer Name!" autofocus>
                            </div>
                            
                            <div class="form-group text-right">
                                <input type="button" value="Register" class="btn btn-primary"
                                    id="register-customers-btn">
                            </div>
                        </div>
                        <div class="offet-1 col-7">
                            <h5>List Of Customers</h5>
                            <table class="table table-hover table-bordered text-left" id="customers-table" width="100%">
                                <thead>
                                    <tr>
                                        <td><b>Customer Name</b> </td>
                                        <td><b>Actions</b> </td>
                                    </tr>
                                </thead>
                                <tbody id="list-of-registered-customers">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="add-source-category" class="tab-pane">
                    <div class="row">
                        <div class="col-4">

                            <div class="form-group">
                                <label for="cat_name">Category Name</label>
                                <input type="text" class="form-control" name="cat_name" id="cat_name"
                                    placeholder="Please Enter Category Name!" autofocus>
                            </div>
                            <div class="form-group text-right">
                                <input type="button" value="Add" class="btn btn-primary" id="add-source-category-btn">
                            </div>
                        </div>
                        <div class="offet-1 col-7">
                            <h5>List Of Categories</h5>
                            <table class="table table-hover table-bordered text-left" id="source-category-table" width="100%">
                                <thead>
                                    <tr>
                                        <td><b>Category Name</b> </td>
                                        <td><b>Actions</b> </td>
                                    </tr>
                                </thead>
                                <tbody id="list-of-source-categories">
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div id="add-source-subcategory" class="tab-pane">
                    <div class="row">
                        <div class="col-4">

                            <div class="form-group">
                                <label for="sub_cat_name">Sub Category Name</label>
                                <input type="text" class="form-control" name="sub_cat_name" id="sub_cat_name"
                                    placeholder="Please Enter Sub Category Name!" autofocus>
                            </div>
                            <div class="form-group text-left">
                                <select name="cat_id_to_sub_cat" id="cat_id_to_sub_cat" class="form-control">
                                    <option value="">Please Select Category</option>
                                    <?php if(isset($categories)): ?>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->id); ?>"><?php echo e($category->cat_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>

                                </select>
                            </div>
                            <div class="form-group text-right">
                                <input type="button" value="Register" class="btn btn-primary"
                                    id="add-sub-source-category-btn">
                            </div>
                        </div>
                        <div class="offet-1 col-7">
                            <h5>List Of Sub Categories</h5>
                            <table class="table table-hover table-bordered" id="source-subcategory-table" width="100%">
                                <thead>
                                    <tr>
                                        <td><b>Sub Category Name</b> </td>
                                        <td><b>Category</b> </td>
                                        <td><b>Actions</b> </td>
                                    </tr>
                                </thead>
                                <tbody id="list-of-source-sub-categories">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Payments Section  -->
                <div id="payments" class="tab-pane">

                </div>
                <!-- Receipts Section  -->
                <div id="receipts" class="tab-pane">
                    <div class="row">
                        <div class="col-2">
                            <input type="radio" name="receiptType" id="receiptCustomerRadio" receipt-type="customer">
                            <label for="receiptCustomerRadio">Receiving By Customer</label>
                        </div>
                        <div class="col-2">
                            <input type="radio" name="receiptType" id="receiptAccountRadio" receipt-type="account">
                            <label for="receiptAccountRadio">Receiving By Dasti</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" id="appendedReceiptFields">

                        </div>
                    </div>

                </div>

                <!-- General Voucher Section  -->
                <div id="general-voucher" class="tab-pane">
                    <div class="row">
                        <div class="col-12" style="margin-bottom: 10px;">
                            <div class="row">
                                <div class="form-group text-left col-2">
                                    <select name="debit_acc" id="debit_acc" class="form-control" required>
                                        <option value="">Please Select Debit Account</option>
                                        <?php if(isset($accounts)): ?>
                                            <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($account->id); ?>"><?php echo e($account->acc_name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>

                                    </select>
                                </div>
                                <div class="form-group text-left col-2">
                                    <select name="credit_acc" id="credit_acc" class="form-control" required>
                                        <option value="">Please Select Credit Account</option>
                                        <?php if(isset($accounts)): ?>
                                            <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($account->id); ?>"><?php echo e($account->acc_name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>

                                    </select>
                                </div>

                                <div class="form-group text-left col-2">
                                    
                                    <input type="number" class="form-control text-right" name="jv_amount" id="jv_amount" required
                                        placeholder="رقم">
                                </div>
                                <div class="form-group text-left col-2">
                                    
                                    <input class="form-control" type="date" name="jv_date" id="jv_date" required>
                                </div>
                                <div class="form-group text-left col-2">
                                    
                                    <input class="form-control text-right" name="jv_description" id="jv_description" required
                                        placeholder="تفصیل" />
                                </div>
                                <div class="form-group text-right">
                                    <input type="button" value="Add" class="btn btn-primary"
                                        id="add-general-voucher-btn">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            
                            <table class="table table-hover table-bordered" id="general-voucher-table">
                                <thead>
                                    <tr>
                                        <td><b>Debit Account</b></td>
                                        <td><b>Credit Account</b></td>
                                        <td><b>Date</b></td>
                                        <td><b>Description</b></td>
                                        <td><b>Amount</b></td>
                                        <td><b>Actions</b> </td>
                                    </tr>
                                </thead>
                                <tbody id="list-of-general-voucher">
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>



                <!-- Account Ledger Section  -->
                <div id="account-ledger" class="tab-pane">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="form-group text-left col-3">
                                    <select name="account_id" id="ledger_account_id" class="form-control" required>
                                        <option value="">Please Select Account</option>
                                        <?php if(isset($accounts)): ?>
                                            <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($account->id); ?>"><?php echo e($account->acc_name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>

                                    </select>
                                </div>

                                
                                <div class="form-group text-right">
                                    <input type="button" value="Search" class="btn btn-primary" id="search-ledger-btn">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <table class="table table-hover table-bordered" id="account-ledger-table">
                                <thead>
                                    <tr>
                                        <td><b>Date</b></td>
                                        
                                        <td><b>Description</b></td>
                                        <td><b>Debit</b></td>
                                        <td><b>Credit</b></td>
                                        <td><b>Type</b></td>
                                    </tr>
                                </thead>
                                <tbody id="list-of-account-ledger">
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\projects\daniyal\accountApp\resources\views/site_layout/general_khata_area.blade.php ENDPATH**/ ?>