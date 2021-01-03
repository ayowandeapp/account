<!DOCTYPE html>
<html lang="en">

<head>
    <title>کیش بک کھاتہ</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    
    <link rel="stylesheet" href="<?php echo e(asset('site_assets/css/bootstrap-4-4-1.min.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('site_assets/css/fullcalendar.css')); ?>" />
    
    <link rel="stylesheet" href="<?php echo e(asset('site_assets/pluginns/jqueryDataTables.min.css')); ?>">
    <link href="<?php echo e(asset('pluginns/fontawesome4-7.min.css')); ?>" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo e(asset('pluginns/select2.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('site_assets/css/maruti-style.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('site_assets/css/maruti-media.css')); ?>" class="skin-color" />
    <style>
        .select2-container .select2-selection--single {
            box-sizing: border-box;
            cursor: pointer;
            display: block;
            height: 37px;
            margin-top: -1px;
            padding: 3px;
            user-select: none;
            -webkit-user-select: none;
        }

        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: 0%;
        }

        .select2-container--open .select2-dropdown--below {
            margin-top: -10px;
        }

        .form-control {
            border-radius: 0%;
        }
        table#account-ledger-singleAccoun thead tr th{
            font-size: 15px;
        }

    </style>
</head>

<body style="background: url(<?php echo e(asset('site_assets/images/backgrounds/bodyBg.png')); ?>) repeat #fff;">

    <?php echo $__env->yieldContent('content'); ?>

    <div style="display: inline-block; position: absolute; top: 0%; right: 6%; padding: 10px;" id="setting-icon">
        <i class="fa fa-gear"></i></i>
        <div style="background-color:  white; padding: 20px; border-radius: 5px; display: none; position: absolute;"
            id="setting-options">
            <div>
                <a href="<?php echo e(route('setting.index')); ?>">Settings</a>
            </div>
            <div>
                <a href="<?php echo e(route('logout')); ?>">Logout</a>
            </div>
        </div>
    </div>
    <div id="popup-ledger" style="position: fixed;
    background-color: white;
    width: 80%;
    height: 90vh;
    border-radius: 5px;
    top: 5%;
    overflow:scroll;
    box-shadow: 1px 5px 10px 4px black;
    margin-left: 10%; padding: 20px; display: none;">
        <div id="popup-ledger-close"
            style="cursor: pointer; background-color: black; color: white; padding: 0px 8px; float: right; position:absolute; right: 0%; display: inline-block; top: 0%;">
            x
        </div>
        <table class="table table-table-hover text-center" id="account-ledger-singleAccoun">
            <thead>
                <tr>
                    <th>
                        Date
                    </th>
                    <th>
                        Description
                    </th>
                    <th>
                        Receiving Amount
                    </th>
                    <th>
                        Payment Amount
                    </th>
                    <th>
                        Remarks
                    </th>
                </tr>
            </thead>
            <tbody id="single-account-ledger">

            </tbody>
        </table>
    </div>
    <?php echo $__env->make('modals.edit_account', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('modals.edit_customer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('modals.edit_category', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('modals.edit_cashin_dasti', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('modals.edit_cashout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('site_layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script src="<?php echo e(asset('site_assets/js/sweet-alert.js')); ?>"></script>
    <script>
        if( $('#editAccountModal').hasClass('in') ) {
            alert("Modal is open");
        }

        $('.modal-backdrop').remove();

        $('#setting-icon').on('click', function() {

            $('#setting-options').toggle();
        });

        function DataTableCall(tableName, SearchName, LimitFilter) {
            $.fn.dataTable.ext.errMode = 'none';


            $('#' + tableName).DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'print'
                ],
            });

            $('#' + SearchName).css('margin-top', '-24px');
            $('#' + LimitFilter).css('margin-top', '-24px');
            $('.dt-buttons').css('margin-left', '85%');



        }


        function selectRefresh() {
            $('#acc_type').select2({
                width: '100%'
            });
            $('#cat_id_to_sub_cat').select2({
                width: '100%'
            });
            $('#acc_id').select2({
                width: '100%'
            });
            $('#subcat_id').select2({
                width: '100%'
            });
            $('#customer_id').select2({
                width: '100%'
            });
            $('#credit_acc').select2({
                width: '100%'
            });
            $('#debit_acc').select2({
                width: '100%'
            });
            $('#ledger_account_id').select2({
                width: '100%'
            });
            $('#account_id').select2({
                width: '100%'
            });
            $('#paycat_id').select2({
                width: '100%'
            });
        }
        //fetch accounts global function
        function fetchAccounts() {
            let accountName = $('#acc_name');
            let accountType = $('#acc_type');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "<?php echo e(route('account.create')); ?>",
                type: "POST",
                data: {
                    acc_name: accountName.val(),
                    acc_type_id: accountType.val(),
                },
                success: function(response) { // What to do if we succeed
                    accountName.val('');
                    accountType.val('');
                    $('#list-of-registered-accounts').empty();
                    $('#list-of-registered-accounts').append(response.data);
                    DataTableCall('accountlist-table', 'accountlist-table_filter',
                        'accountlist-table_length');
                    accountName.focus();
                }
            });
        }
        $('#start-khata').on('click', function() {
            $('#main-contentArea').empty();
            let generalKhataArea = $('#general-khata-area').html();
            $('#main-contentArea').append(generalKhataArea);
            fetchAccounts();
            selectRefresh();
        });
        $(document).delegate('#openNewAccountTab', 'click', function() {
            fetchAccounts();
            selectRefresh();
        });


        // Register Account
        $(document).delegate('#register-account-btn', 'click', function() {
            let accountName = $('#acc_name');
            let accountType = $('#acc_type');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "<?php echo e(route('account.create')); ?>",
                type: "POST",
                data: {
                    acc_name: accountName.val(),
                    acc_type_id: accountType.val(),
                },
                success: function(response) { // What to do if we succeed

                    $('#list-of-registered-accounts').empty();
                    $('#accountlist-table').DataTable().clear();
                    $('#accountlist-table').DataTable().destroy();
                    $('#list-of-registered-accounts').append(response.data);
                    DataTableCall('accountlist-table', 'accountlist-table_filter',
                        'accountlist-table_length');

                    if (response.code == 200) {
                        accountName.val('');
                        accountType.val('');
                        $('#paymentsTotal').html(response.total_payment);
                        swal("Success!", response.message, "success")
                            .then((value) => {
                                accountName.focus();
                            });
                    } else {
                        swal(response.message);
                        swal("Error!", response.message, "error")
                            .then((value) => {
                                accountName.focus();
                            });
                    }

                },
                error: function(response) {
                    alert(response.message);
                }
            });
        }); // End register account





        //fetch customers global function
        function fetchCustomers() {
            let customerName = $('#name');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "<?php echo e(route('customer.create')); ?>",
                type: "POST",
                data: {
                    name: customerName.val(),
                },
                success: function(response) { // What to do if we succeed
                    customerName.val('');
                    $('#list-of-registered-customers').empty();
                    $('#list-of-registered-customers').append(response.data);
                    DataTableCall('customers-table', 'customers-table_filter',
                        'customers-table_length');
                    customerName.focus();
                }
            });
        }

        $(document).delegate('#addCustomerTab', 'click', function() {
            fetchCustomers();
        });
        // Register Customer
        $(document).delegate('#register-customers-btn', 'click', function() {
            let customerName = $('#name');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "<?php echo e(route('customer.create')); ?>",
                type: "POST",
                data: {
                    name: customerName.val(),
                },
                success: function(response) { // What to do if we succeed

                    $('#list-of-registered-customers').empty();
                    $('#customers-table').DataTable().clear();
                    $('#customers-table').DataTable().destroy();
                    $('#list-of-registered-customers').append(response.data);
                    DataTableCall('customers-table', 'customers-table_filter',
                        'customers-table_length');

                    if (response.code == 200) {
                        customerName.val('');
                        $('#paymentsTotal').html(response.total_payment);
                        swal("Success!", response.message, "success")
                            .then((value) => {
                                customerName.focus();
                            });
                    } else {
                        swal(response.message);
                        swal("Error!", response.message, "error")
                            .then((value) => {
                                customerName.focus();
                            });
                    }

                },
                error: function(response) {
                    alert(response.message);
                }
            });
        }); // End register customer


        //get all categories
        function fetchCategories() {
            let categoryName = $('#cat_name');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "<?php echo e(route('category.create')); ?>",
                type: "POST",
                data: {
                    cat_name: categoryName.val(),
                },
                success: function(response) { // What to do if we succeed
                    categoryName.val('');
                    $('#list-of-source-categories').empty();
                    $('#list-of-source-categories').append(response.data);
                    DataTableCall('source-category-table', 'source-category-table_filter',
                        'source-category-table_length');
                    categoryName.focus();
                }
            });
        }
        $(document).delegate('#addcategoryTab', 'click', function() {
            fetchCategories();
        });

        //category
        $(document).delegate('#add-source-category-btn', 'click', function() {
            let categoryName = $('#cat_name');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "<?php echo e(route('category.create')); ?>",
                type: "POST",
                data: {
                    cat_name: categoryName.val(),
                },
                success: function(response) { // What to do if we succeed

                    $('#list-of-source-categories').empty();
                    $('#list-of-source-categories').append(response.data);
                    DataTableCall('source-category-table', 'source-category-table_filter',
                        'source-category-table_length');

                    if (response.code == 200) {
                        categoryName.val('');
                        swal("Success!", response.message, "success")
                            .then((value) => {
                                categoryName.focus();
                            });
                    } else {
                        swal(response.message);
                        swal("Error!", response.message, "error")
                            .then((value) => {
                                categoryName.focus();
                            });
                    }

                },
                error: function(response) {
                    alert(response.message);
                }
            });
        }); // End category





        //Fetch All Sub Categories

        function fetchSubCategories() {
            let subCategoryName = $('#sub_cat_name');
            let categoryId = $('#cat_id_to_sub_cat');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "<?php echo e(route('subcategory.create')); ?>",
                type: "POST",
                data: {
                    sub_cat_name: subCategoryName.val(),
                    category_id: categoryId.val(),
                },
                success: function(response) { // What to do if we succeed
                    subCategoryName.val('');
                    categoryId.val('');
                    $('#list-of-source-sub-categories').empty();
                    $('#cat_id_to_sub_cat').empty();
                    $('#cat_id_to_sub_cat').append(response.categories);
                    $('#list-of-source-sub-categories').append(response.data);
                    DataTableCall('source-subcategory-table', 'source-subcategory-table_filter',
                        'source-subcategory-table_length');
                    subCategoryName.focus();
                }
            });

        }

        $(document).delegate('#addSubCategoryTab', 'click', function() {
            fetchSubCategories();
            selectRefresh();
        });
        // Sub Category
        $(document).delegate('#add-sub-source-category-btn', 'click', function() {
            let subCategoryName = $('#sub_cat_name');
            let categoryId = $('#cat_id_to_sub_cat');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "<?php echo e(route('subcategory.create')); ?>",
                type: "POST",
                data: {
                    sub_cat_name: subCategoryName.val(),
                    category_id: categoryId.val(),
                },
                success: function(response) { // What to do if we succeed

                    $('#list-of-source-sub-categories').empty();
                    $('#list-of-source-sub-categories').append(response.data);
                    DataTableCall('source-subcategory-table', 'source-subcategory-table_filter',
                        'source-subcategory-table_length');

                    if (response.code == 200) {
                        subCategoryName.val('');
                        categoryId.val('');
                        swal("Success!", response.message, "success")
                            .then((value) => {
                                subCategoryName.focus();
                            });
                    } else {
                        swal(response.message);
                        swal("Error!", response.message, "error")
                            .then((value) => {
                                subCategoryName.focus();
                            });
                    }

                },
                error: function(response) {
                    alert(response.message);
                }
            });
        }); // End sub category



        //Fetch All Payments
        function fetchPayments() {
            let accountId = $('#acc_id');
            let subCategoryId = $('#subcat_id');
            let CategoryId = $('#paycat_id');
            let amount = $('#amount');
            let paymentDate = $('#_date');
            let description = $('#description');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "<?php echo e(route('payments.create')); ?>",
                type: "POST",
                data: {
                    account_id: accountId.val(),
                    sub_category_id: subCategoryId.val(),
                    paycat_id: CategoryId.val(),
                    amount: amount.val(),
                    _date: paymentDate.val(),
                    description: description.val(),
                },
                success: function(response) { // What to do if we succeed
                    accountId.val('');
                    subCategoryId.val('');
                    amount.val('');
                    paymentDate.val('');
                    description.val('');
                    $('#list-of-payments').empty();
                    $('#list-of-payments').append(response.data);
                    DataTableCall('payment-table', 'payment-table_filter',
                        'payment-table_length');
                    $('#paymentsTotal').empty();
                    $('#paymentsTotal').html(response.total_payment);
                    //$('#subcat_id').empty();
                    //$('#subcat_id').html(response.subCategories);
                    accountId.focus();
                }
            });

        }



        // payment
        $(document).delegate('#add-payment-btn', 'click', function() {
            var paymentRadioValue = $("input[name='paymentType']:checked").val();
            if (paymentRadioValue) {
                // alert("Your are a - " + paymentRadioValue);
            }
            let accountId = $('#acc_id');
            let CategoryId = $('#paycat_id');
            let subCategoryId = $('#subcat_id');
            // alert(subCategoryId.val());
            let amount = $('#amount');
            let paymentDate = $('#_date');
            let description = $('#description');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "<?php echo e(route('payments.create')); ?>",
                type: "POST",
                data: {
                    account_id: accountId.val(),
                    sub_category_id: subCategoryId.val(),
                    paycat_id: CategoryId.val(),
                    amount: amount.val(),
                    _date: paymentDate.val(),
                    description: description.val(),
                    type: paymentRadioValue,
                },
                success: function(response) { // What to do if we succeed

                    $('#list-of-payments').empty();
                    $('#list-of-payments').append(response.data);
                    DataTableCall('payment-table', 'payment-table_filter',
                        'payment-table_length');
                    $('#paymentsTotal').empty();
                    $('#paymentsTotal').html(response.total_payment);
                    getPaymentReceiptBalance();

                    if (response.code == 200) {
                        accountId.val('');
                        subCategoryId.val('');
                        amount.val('');
                        paymentDate.val('');
                        description.val('');

                        swal("Success!", response.message, "success")
                            .then((value) => {
                                subCategoryName.focus();
                            });
                    } else {
                        swal(response.message);
                        swal("Error!", response.message, "error")
                            .then((value) => {
                                subCategoryName.focus();
                            });
                    }

                }
            });
        }); // End payment


        $(document).delegate("input[name='paymentType']", 'click', function(){
            var paymentType = $(this).val();
            if(paymentType == 'dasti'){
                $('#CatDivPayment').css('display', 'none');
                $('#subCatDivPayment').css('display', 'none');
            }else{
                $('#CatDivPayment').css('display', 'block');
                $('#subCatDivPayment').css('display', 'block');
            }
        });

        //Fetch All Receipts
        function fetchReceipts(receiptType, appendType = 'customer_id') {
            var customerId = '';
            var block = '';
            var sector = '';
            var plotNo = '';
            var inv = '';
            var registrationNo = '';
            var marla = '';
            var dataValues = '';
            var amount = '';
            var description = '';
            var receiptDate = '';
            if (appendType == 'customer_id') {
                customerId = $('#customer_id');
                block = $('#block');
                sector = $('#sector');
                plotNo = $('#plot_no');
                inv = $('#inv');
                registrationNo = $('#registration_no');
                marla = $('#marla');
                amount = $('#receipt_amount');
                description = $('#receipt_description');
                receiptDate = $('#_date');

                dataValues = {
                    customer_id: customerId.val(),
                    block: block.val(),
                    sector: sector.val(),
                    plot_no: plotNo.val(),
                    amount: amount.val(),
                    inv: inv.val(),
                    _date: receiptDate.val(),
                    description: description.val(),
                    registration_no: registrationNo.val(),
                    marla: marla.val(),
                    type: receiptType,
                }

            } else {

                customerId = $('#account_id');
                amount = $('#receipt_amount');
                description = $('#receipt_description');
                receiptDate = $('#_date');

                dataValues = {
                    customer_id: customerId.val(),

                    amount: amount.val(),
                    _date: receiptDate.val(),
                    description: description.val(),
                    type: receiptType,
                }

            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "<?php echo e(route('receipts.create')); ?>",
                type: "POST",
                data: dataValues,
                success: function(response) { // What to do if we succeed
                    $('input[type=text],input[type=number], input[type=date], select').val('');
                    $('#list-of-receipts').empty();
                    $('#list-of-receipts').append(response.data);
                    DataTableCall('receipt-table', 'receipt-table_filter',
                        'receipt-table_length');
                    $('#' + appendType).empty();
                    $('#' + appendType).html(response.customers);

                }
            });

        }
        $(document).delegate('#receiptsTab', 'click', function() {
            /*fetchReceipts();
            selectRefresh(); */
        });

        // Receipt
        $(document).delegate('#add-receipt-btn', 'click', function() {
            let type = $(this).attr('receipt-type');
            var customerId = '';
            var block = '';
            var sector = '';
            var plotNo = '';
            var inv = '';
            var registrationNo = '';
            var marla = '';
            var dataValues = '';
            var amount = '';
            var description = '';
            var receiptDate = '';
            if (type == 'account') {
                customerId = $('#account_id');
                amount = $('#receipt_amount');
                description = $('#receipt_description');
                receiptDate = $('#_date');

                dataValues = {
                    customer_id: customerId.val(),

                    amount: amount.val(),
                    _date: receiptDate.val(),
                    description: description.val(),
                    type: type,
                }
            } else {
                customerId = $('#customer_id');
                block = $('#block');
                sector = $('#sector');
                plotNo = $('#plot_no');
                inv = $('#inv');
                registrationNo = $('#registration_no');
                marla = $('#marla');
                amount = $('#receipt_amount');
                description = $('#receipt_description');
                receiptDate = $('#_date');

                dataValues = {
                    customer_id: customerId.val(),
                    block: block.val(),
                    sector: sector.val(),
                    plot_no: plotNo.val(),
                    amount: amount.val(),
                    inv: inv.val(),
                    _date: receiptDate.val(),
                    description: description.val(),
                    registration_no: registrationNo.val(),
                    marla: marla.val(),
                    type: type,
                }
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "<?php echo e(route('receipts.create')); ?>",
                type: "POST",
                data: dataValues,
                success: function(response) { // What to do if we succeed

                    $('#list-of-receipts').empty();
                    $('#list-of-receipts').append(response.data);
                    DataTableCall('receipt-table', 'receipt-table_filter',
                        'receipt-table_length');
                    getPaymentReceiptBalance();

                    if (response.code == 200) {
                        $('input[type=text],input[type=number], select').val('');
                        swal("Success!", response.message, "success")
                            .then((value) => {
                                customerId.focus();
                            });
                    } else {
                        swal(response.message);
                        swal("Error!", response.message, "error")
                            .then((value) => {
                                customerId.focus();
                            });
                    }

                }
            });
        }); // End Receept



        //Fetch All General Voucher
        function fetchGeneralVoucher() {
            let debitAcc = $('#debit_acc');
            let creditAcc = $('#credit_acc');
            let amount = $('#jv_amount');
            let date = $('#jv_date');
            let description = $('#jv_description');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "<?php echo e(route('jv.create')); ?>",
                type: "POST",
                data: {
                    debit_acc: debitAcc.val(),
                    credit_acc: creditAcc.val(),
                    amount: amount.val(),
                    date: date.val(),
                    description: description.val(),
                },
                success: function(response) { // What to do if we succeed
                    $('#list-of-general-voucher').empty();
                    $('#list-of-general-voucher').append(response.data);
                    DataTableCall('general-voucher-table', 'general-voucher-table_filter',
                        'general-voucher-table_length');
                    $('#debit_acc').empty();
                    $('#debit_acc').html(response.accounts);
                    $('#credit_acc').empty();
                    $('#credit_acc').html(response.accounts);
                    $('#debit_acc').focus();
                }
            });

        }
        $(document).delegate('#generalVoucherTab', 'click', function() {
            fetchGeneralVoucher();
            selectRefresh();
        });


        // General Voucher
        $(document).delegate('#add-general-voucher-btn', 'click', function() {
            let debitAcc = $('#debit_acc');
            let creditAcc = $('#credit_acc');
            let amount = $('#jv_amount');
            let date = $('#jv_date');
            let description = $('#jv_description');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "<?php echo e(route('jv.create')); ?>",
                type: "POST",
                data: {
                    debit_acc: debitAcc.val(),
                    credit_acc: creditAcc.val(),
                    amount: amount.val(),
                    date: date.val(),
                    description: description.val(),
                },
                success: function(response) { // What to do if we succeed

                    $('#list-of-general-voucher').empty();
                    $('#list-of-general-voucher').append(response.data);
                    DataTableCall('general-voucher-table', 'general-voucher-table_filter',
                        'general-voucher-table_length');
                    getPaymentReceiptBalance();

                    if (response.code == 200) {
                        debitAcc.val('');
                        creditAcc.val('');
                        amount.val('');
                        date.val('');
                        description.val('');
                        fetchGeneralVoucher();

                        swal("Success!", response.message, "success")
                            .then((value) => {
                                debitAcc.focus();
                            });
                    } else {
                        swal(response.message);
                        swal("Error!", response.message, "error")
                            .then((value) => {
                                debitAcc.focus();
                            });
                    }

                }
            });
        }); // End Receept



        //getTotalPaymentsReceiptsBalace
        function getPaymentReceiptBalance() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "<?php echo e(route('get.payment.receipt.balance')); ?>",
                type: "POST",
                success: function(response) { // What to do if we succeed
                    $('#paymentsTotal').html(response.totalPayments);
                    $('#receiptsTotal').html(response.totalReceipts);
                    $('#totalBalance').html(response.totalBalace);


                    $('#current_payment').html(response.currentPayment);
                    $('#current_receipt').html(response.currentReceipt);
                    $('#current_balace').html(response.currentBalace);
                }
            });
        }
        getPaymentReceiptBalance();
        $(document).delegate('#addcategoryTab, #addSubCategoryTab, #paymentsTab, #start-khata', 'click',
            function() {
                getPaymentReceiptBalance();
            });



        //Delete Record
        function delteRecord(Deleteid, Deletetype, receiptType = '') {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to retrive this record!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url: Deletetype,
                            type: "POST",
                            data: {
                                account_id: Deleteid,
                            },
                            success: function(response) { // What to do if we succeed
                                swal(response);
                                $('#accountlist-table').DataTable().clear();
                                $('#accountlist-table').DataTable().destroy();
                                $('#customers-table').DataTable().clear();
                                $('#customers-table').DataTable().destroy();
                                $('#source-category-table').DataTable().clear();
                                $('#source-category-table').DataTable().destroy();
                                $('#source-subcategory-table').DataTable().clear();
                                $('#source-subcategory-table').DataTable().destroy();
                                $('#receipt-table').DataTable().clear();
                                $('#receipt-table').DataTable().destroy();
                                $('#payment-table').DataTable().clear();
                                $('#payment-table').DataTable().destroy();
                                fetchAccounts();
                                fetchCategories();
                                fetchSubCategories();
                                fetchPayments();
                                getPaymentReceiptBalance();
                                fetchCustomers();
                                fetchGeneralVoucher();
                                fetchReceipts(receiptType);
                                selectRefresh();

                            }
                        });
                    } else {
                        swal("Your record safe!");
                    }
                });
        }


        $(document).delegate('.deleteBtn', 'click', function() {
            let Deleteid = $(this).attr('delete-acc-id');
            let Deletetype = $(this).attr('delte-type');
            let receiptType = $(this).attr('receipt-type');
            delteRecord(Deleteid, Deletetype, receiptType);
        });
        $(document).delegate('.hasChileds', 'click', function() {
            swal("Error!", "This record have some child items! So that you are not able to delete this!",
                "error");
        });



        //Ledger View
        // $(document).delegate('#search-ledger-btn', 'click', function() {

        //     let ledgerAccountId = $('#ledger_account_id');
        //     let ledgerFromDate = $('#from_date');
        //     let ledgerToDate = $('#to_date');
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });

        //     $.ajax({
        //         url: "<?php echo e(route('get.account.ledger')); ?>",
        //         type: "POST",
        //         data: {
        //             ledger_account_id: ledgerAccountId.val(),
        //             from_date: ledgerFromDate.val(),
        //             to_date: ledgerToDate.val(),
        //         },
        //         success: function(response) { // What to do if we succeed


        //             if (response.code == 200) {
        //                 /* ledgerAccountId.val('');
        //                 ledgerFromDate.val('');
        //                 ledgerToDate.val(''); */
        //                 $('#list-of-account-ledger').empty();
        //                 $('#list-of-account-ledger').append(response.data);
        //                 DataTableCall('account-ledger-table', 'account-ledger-table_filter',
        //                     'account-ledger-table_length');

        //             } else {
        //                 swal(response.message);
        //                 swal("Error!", response.message, "error")
        //                     .then((value) => {
        //                         debitAcc.focus();
        //                     });
        //             }

        //         }
        //     });

        // });

        $(document).delegate('#receiptCustomerRadio', 'click', function() {
            let receiptType = $(this).attr('receipt-type');
            $('#appendedReceiptFields').empty();
            $('#appendedReceiptFields').append('<div class="row">' +
                '<div class="col-12" style="margin-bottom: 20px;">' +
                '<div class="row">' +

                '<div class="form-group text-left col-2">' +
                '<input class="form-control" type="date" name="_date" id="_date" required>' +
                '</div>' +

                '<div class="form-group text-left col-2">' +
                '<select name="customer_id" id="customer_id" class="form-control" required>' +
                '<option value="">Please Select Customer</option>' +
                '</select>' +
                '</div>' +

                '<div class="form-group text-left col-3"> ' +
                '<input type="text" class="form-control" name="receipt_description" id="receipt_description" required ' +
                'placeholder="تفصیل"> ' +
                '</div> ' +

                '<div class="form-group text-left col-2">' +
                '<input type="text" class="form-control" name="registration_no" id="registration_no"' +
                ' required placeholder="Enter Registration No">' +
                '</div> ' +
                '<div class="form-group text-left col-2">' +
                '<input type="text" class="form-control" name="block" id="block" required placeholder="Enter Block">' +
                '</div>' +
                '<div class="form-group text-left col-2">' +
                '<input type="text" class="form-control" name="marla" id="marla" required placeholder="Enter Marla">' +
                '</div>' +
                '<div class="form-group text-left col-2">' +
                '<input type="text" class="form-control" name="sector" id="sector" required placeholder="Enter Sector">' +
                '</div>' +
                '<div class="form-group text-left col-2">' +
                '<input type="text" class="form-control" name="plot_no" id="plot_no" required ' +
                'placeholder="Enter Plot No">' +
                '</div> ' +
                '<div class="form-group text-left col-2"> ' +
                '<input type="number" class="form-control" name="receipt_amount" id="receipt_amount" required ' +
                'placeholder="رقم"> ' +
                '</div>' +
                '<div class="form-group text-left col-2">' +
                '<input type="text" class="form-control" name="inv" id="inv" required placeholder="Enter Invoice No">' +
                '</div> ' +


                '<div class="form-group text-right"> ' +
                '<input type="button" value="Add" class="btn btn-primary" id="add-receipt-btn" receipt-type="customer">' +
                '</div>' +
                '</div>' +
                '</div> ' +
                '<div class="col-12"> ' +
                '<table class="table table-hover table-bordered" id="receipt-table">' +
                '<thead> ' +
                '<tr>' +
                '<td><b>Date</b></td>' +
                '<td><b>Customer</b></td> ' +
                '<td><b>Registration</b></td>' +
                '<td><b>Marla</b></td>' +
                '<td><b>Block</b></td>' +
                '<td><b>Sector</b></td>' +
                '<td><b>Plot No</b></td> ' +

                '<td><b>Amount</b></td> ' +
                '<td><b>Inv</b></td>' +
                '<td><b>Description</b></td> ' +

                '<td><b>Actions</b> </td>' +
                '</tr>' +
                '</thead>' +
                '<tbody id="list-of-receipts"> ' +
                '</tbody>' +
                '</table>' +
                '</div>' +
                '</div>');
            fetchReceipts(receiptType);
            selectRefresh();
        });
        $(document).delegate('#receiptAccountRadio', 'click', function() {
            let receiptType = $(this).attr('receipt-type');
            $('#appendedReceiptFields').empty();
            $('#appendedReceiptFields').append('<div class="row">' +
                '<div class="col-12" style="margin-bottom: 20px;">' +
                '<div class="row">' +
                '<div class="form-group text-left col-2">' +
                '<input class="form-control" type="date" name="_date" id="_date" required>' +
                '</div>' +

                '<div class="form-group text-left col-2">' +
                '<select name="receipt_account_id" id="account_id" class="form-control" required>' +
                '<option value="">Please Select Dasti Khata</option>' +
                '</select>' +
                '</div>' +

                '<div class="form-group text-left col-3"> ' +
                '<input type="text" class="form-control" name="receipt_description" id="receipt_description" required ' +
                'placeholder="تفصیل"> ' +
                '</div> ' +


                '<div class="form-group text-left col-2"> ' +
                '<input type="number" class="form-control" name="receipt_amount" id="receipt_amount" required ' +
                'placeholder="رقم"> ' +
                '</div>' +


                '<div class="form-group text-right"> ' +
                '<input type="button" value="Add" class="btn btn-primary" id="add-receipt-btn" receipt-type="account">' +
                '</div>' +
                '</div>' +
                '</div> ' +
                '<div class="col-12"> ' +
                '<table class="table table-hover table-bordered" id="receipt-table">' +
                '<thead> ' +
                '<tr>' +
                '<td><b>Date</b></td>' +
                '<td><b>Account</b></td> ' +
                '<td><b>Amount</b></td> ' +
                '<td><b>Description</b></td> ' +
                '<td><b>Actions</b> </td>' +
                '</tr>' +
                '</thead>' +
                '<tbody id="list-of-receipts"> ' +
                '</tbody>' +
                '</table>' +
                '</div>' +
                '</div>');
            fetchReceipts(receiptType, 'account_id');
            selectRefresh();
        });




        //Get Ledger By Click on Account

        DataTableCall('account-ledger-table', 'account-ledger-table_filter',
                            'account-ledger-table_length');

        //Ledger View
        $(document).delegate('#search-ledger-btn', 'click', function() {
            let ledgerAccountId = $('#ledger_account_id');
            let ledgerFromDate = $('#from_date');
            let ledgerToDate = $('#to_date');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "<?php echo e(route('get.account.ledger')); ?>",
                type: "POST",
                data: {
                    ledger_account_id: ledgerAccountId.val(),
                    from_date: ledgerFromDate.val(),
                    to_date: ledgerToDate.val(),
                },
                success: function(response) { // What to do if we succeed


                    if (response.code == 200) {
                        /* ledgerAccountId.val('');
                        ledgerFromDate.val('');
                        ledgerToDate.val(''); */
                        $('#list-of-account-ledger').empty();
                        $('#list-of-account-ledger').append(response.data);
                        // DataTableCall('account-ledger-table', 'account-ledger-table_filter',
                        //     'account-ledger-table_length');

                        $('#account-ledger-table').DataTable();



                    } else {
                        swal(response.message);
                        swal("Error!", response.message, "error")
                            .then((value) => {
                                debitAcc.focus();
                            });
                    }

                }
            });

        });
        $(document).delegate('.account-list-table', 'click', function() {

            let ledgerAccountId = $(this).attr('account-id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "<?php echo e(route('get.account.ledger')); ?>",
                type: "POST",
                data: {
                    ledger_account_id: ledgerAccountId,
                },
                success: function(response) { // What to do if we succeed

                    if (response.code == 200) {
                        $('#single-account-ledger').empty();
                        $('#single-account-ledger').append(response.data);
                        $('#popup-ledger').css('display', 'block');

                        DataTableCall('account-ledger-singleAccoun',
                            'account-ledger-singleAccoun_filter',
                            'account-ledger-singleAccoun_length');
                        getPaymentReceiptBalance();

                    } else {
                        swal(response.message);
                        swal("Error!", response.message, "error")
                            .then((value) => {
                                debitAcc.focus();
                            });
                    }

                }
            });
        });
        $(document).delegate('.customer-list-table', 'click', function() {

            let ledgerAccountId = $(this).attr('customer-id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "<?php echo e(route('get.account.ledger')); ?>",
                type: "POST",
                data: {
                    ledger_account_id: ledgerAccountId,
                },
                success: function(response) { // What to do if we succeed

                    if (response.code == 200) {
                        $('#single-account-ledger').empty();
                        $('#single-account-ledger').append(response.data);
                        $('#popup-ledger').css('display', 'block');

                        DataTableCall('account-ledger-singleAccoun',
                            'account-ledger-singleAccoun_filter',
                            'account-ledger-singleAccoun_length');
                        getPaymentReceiptBalance();

                    } else {
                        swal(response.message);
                        swal("Error!", response.message, "error")
                            .then((value) => {
                                debitAcc.focus();
                            });
                    }

                }
            });
        });
        $(document).delegate('#popup-ledger-close', 'click', function() {
            $('#popup-ledger').css('display', 'none');
        });
        $(document).delegate('#paycat_id', 'change', function() {

           let categoryId = $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "<?php echo e(route('get.subcat.by.category')); ?>",
                type: "POST",
                data: {
                    category_id: categoryId,
                },
                success: function(response) { // What to do if we succeed

                    if (response.code == 200) {
                        $('#subcat_id').empty();
                        $('#subcat_id').append(response.subCategories);

                    } else {
                        swal(response.message);
                        swal("Error!", response.message, "error");
                    }

                }
            });
        });



        $(document).delegate('.categories-list-tr', 'click', function() {

            let ledgerCategoryId = $(this).attr('category-id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "<?php echo e(route('get.category.ledger')); ?>",
                type: "POST",
                data: {
                    category_id: ledgerCategoryId,
                },
                success: function(response) { // What to do if we succeed

                    if (response.code == 200) {
                        $('#single-account-ledger').empty();
                        $('#single-account-ledger').append(response.data);
                        $('#popup-ledger').css('display', 'block');

                        DataTableCall('account-ledger-singleAccoun',
                            'account-ledger-singleAccoun_filter',
                            'account-ledger-singleAccoun_length');
                        getPaymentReceiptBalance();

                    } else {
                        swal(response.message);
                        swal("Error!", response.message, "error")
                            .then((value) => {
                                debitAcc.focus();
                            });
                    }

                }
            });
        });


        $(document).delegate('.subcategories-list-tr', 'click', function() {

            let ledgerSubCategoryId = $(this).attr('subcategory-id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "<?php echo e(route('get.subcategory.ledger')); ?>",
                type: "POST",
                data: {
                    subcategory_id: ledgerSubCategoryId,
                },
                success: function(response) { // What to do if we succeed

                    if (response.code == 200) {
                        $('#single-account-ledger').empty();
                        $('#single-account-ledger').append(response.data);
                        $('#popup-ledger').css('display', 'block');

                        DataTableCall('account-ledger-singleAccoun',
                            'account-ledger-singleAccoun_filter',
                            'account-ledger-singleAccoun_length');
                        getPaymentReceiptBalance();

                    } else {
                        swal(response.message);
                        swal("Error!", response.message, "error")
                            .then((value) => {
                                debitAcc.focus();
                            });
                    }

                }
            });
        });

        $('#cashInContainer').hide();
        $('#cashOutContainer').hide();

        $(document).delegate('#cashOutButton', 'click', function(){
            $('#cashInContainer').hide();
            $('#cashOutContainer').show();
        });
        $(document).delegate('#cashInButton', 'click', function(){
            $('#cashOutContainer').hide();
            $('#cashInContainer').show();
        });






        /************************************************************************************************************************************
                                                            Edit Account Section is starting
         ************************************************************************************************************************************/


        $(document).delegate('.accountEditBtn', 'click', function(){
            var accountName = $(this).attr('data-account-name');
            var accountId = $(this).attr('data-account-id');
            $('#edit_acc_name').val(accountName);
            $('#edit_account_id').val(accountId);
            $('#editAccountModal').show();
        });
        $(document).delegate('.closeEditModelBtn', 'click', function(){
            $('.editModel').hide();
        });
        $(document).delegate('#accountUpdateButton', 'click', function(){
            var udatedAccountNmae = $('#edit_acc_name').val();
            var accountToUpdateId = $('#edit_account_id').val();
            if(udatedAccountNmae != '' && udatedAccountNmae != null){

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "<?php echo e(route('edit.account')); ?>",
                    type: "POST",
                    data: {
                        acc_name: udatedAccountNmae,
                        id: accountToUpdateId,
                    },
                    success: function(response) { // What to do if we succeed

                        if (response.code == 200) {
                            swal("Success!", response.message, "success");
                            $('.editModel').hide();
                            $('#list-of-registered-accounts').empty();
                            $('#accountlist-table').DataTable().clear();
                            $('#accountlist-table').DataTable().destroy();
                            fetchAccounts();

                        } else {
                            swal(response.message);
                            swal("Error!", response.message, "error");
                        }

                    }
                });

            }else{
                swal("Error!", "Make sure account name not empty!", "error");
            }


        });



        /************************************************************************************************************************************
                                                        Edit Customer Section is starting
         ************************************************************************************************************************************/



        $(document).delegate('.customerEditBtn', 'click', function(){
            var customerName = $(this).attr('data-customer-name');
            var customerId = $(this).attr('data-customer-id');
            $('#edit_customer_name').val(customerName);
            $('#edit_customer_id').val(customerId);
            $('#editCustomerModal').show();
        });
        $(document).delegate('.closeEditModelBtn', 'click', function(){
            $('.editModel').hide();
        });
        $(document).delegate('#customerUpdateButton', 'click', function(){
            var udatedCustomerNmae = $('#edit_customer_name').val();
            var customerToUpdateId = $('#edit_customer_id').val();
            if(udatedCustomerNmae != '' && udatedCustomerNmae != null){

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "<?php echo e(route('edit.customer')); ?>",
                    type: "POST",
                    data: {
                        customer_name: udatedCustomerNmae,
                        id: customerToUpdateId,
                    },
                    success: function(response) { // What to do if we succeed
                        console.log(response);
                        if (response.code == 200) {
                            swal("Success!", response.message, "success");
                            $('.editModel').hide();
                            $('#list-of-registered-customers').empty();
                            $('#customers-table').DataTable().clear();
                            $('#customers-table').DataTable().destroy();
                            fetchCustomers();

                        } else {
                            swal(response.message);
                            swal("Error!", response.message, "error");
                        }

                    }
                });

            }else{
                swal("Error!", "Make sure account name not empty!", "error");
            }


        });


        /************************************************************************************************************************************
                                                        Edit Category Section is starting
         ************************************************************************************************************************************/


        $(document).delegate('.categoryEditBtn', 'click', function(){
            var categoryName = $(this).attr('data-category-name');
            var categoryId = $(this).attr('data-category-id');
            $('#edit_category_name').val(categoryName);
            $('#edit_category_id').val(categoryId);
            $('#editCategoryModal').show();
        });
        $(document).delegate('.closeEditModelBtn', 'click', function(){
            $('.editModel').hide();
        });
        $(document).delegate('#categoryUpdateButton', 'click', function(){
            var udatedCategoryNmae = $('#edit_category_name').val();
            var categoryToUpdateId = $('#edit_category_id').val();
            if(udatedCategoryNmae != '' && udatedCategoryNmae != null){

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "<?php echo e(route('edit.category')); ?>",
                    type: "POST",
                    data: {
                        category_name: udatedCategoryNmae,
                        id: categoryToUpdateId,
                    },
                    success: function(response) { // What to do if we succeed
                        console.log(response);
                        if (response.code == 200) {
                            swal("Success!", response.message, "success");
                            $('.editModel').hide();
                            $('#list-of-source-categories').empty();
                            $('#source-category-table').DataTable().clear();
                            $('#source-category-table').DataTable().destroy();
                            fetchCategories();

                        } else {
                            swal(response.message);
                            swal("Error!", response.message, "error");
                        }

                    }
                });

            }else{
                swal("Error!", "Make sure account name not empty!", "error");
            }


        });



          $(document).delegate('#paymentsTab, #payInExpRadio, #payemntDastiRadio, #generalKhataPointTab, #cashOutButton', 'click', function() {
            $('#accountlist-table').DataTable().clear();
            $('#accountlist-table').DataTable().destroy();
            $('#customers-table').DataTable().clear();
            $('#customers-table').DataTable().destroy();
            $('#source-category-table').DataTable().clear();
            $('#source-category-table').DataTable().destroy();
            $('#source-subcategory-table').DataTable().clear();
            $('#source-subcategory-table').DataTable().destroy();
            $('#receipt-table').DataTable().clear();
            $('#receipt-table').DataTable().destroy();
            $('#payment-table').DataTable().clear();
            $('#payment-table').DataTable().destroy();
            fetchAccounts();
            fetchCategories();
            fetchSubCategories();
            fetchPayments();
            getPaymentReceiptBalance();
            fetchCustomers();
            fetchGeneralVoucher();
            // fetchReceipts(receiptType);
            selectRefresh();

        });

        $(document).delegate('#payemntDastiRadio, #generalKhataPointTab', 'click', function() {
            $.ajax({
                url: "<?php echo e(route('get.all.account.get.option')); ?>",
                type: "POST",
                success: function(response) { // What to do if we succeed

                    $('#acc_id').empty();
                    $('#acc_id').html(response);
                    selectRefresh();

                }
            });
            selectRefresh();

        });


        $(document).delegate('.receiptEditBtn','click',function(){
            var receiptEditType = $(this).attr('editType');
            if(receiptEditType == "edit_cashin_dasti"){
                $('.edit_receipt_new_hide').hide();
                var receiptId = $(this).attr('data-receipt-id');
                var receiptDateToEdit = $(this).attr('data-receipt-date');
                var receiptAccountIdToEdit = $(this).attr('data-receipt-account-id');
                var receiptAmountToEdit = $(this).attr('data-receipt-amount');
                var receiptDescriptionToEdit = $(this).attr('data-receipt-description');

                $('#editReceiptModal').show();
                $('#edit_receipt_new_date').val(receiptDateToEdit);
                $('#receiptUpdateButton').attr('updateReceiptType', 'dasti');
                $('#edit_receipt_new_description').val(receiptDescriptionToEdit);
                $('#edit_receipt_new_amount').val(receiptAmountToEdit);
                $('#edit_receipt_new_id').val(receiptId);
            }else if(receiptEditType == "edit_cashin_customer"){
                $('.edit_receipt_new_hide').show();
                $('#receiptUpdateButton').attr('updateReceiptType', 'customer');

                var receiptId = $(this).attr('data-receipt-id');
                var receiptDateToEdit = $(this).attr('data-receipt-date');
                var receiptAccountIdToEdit = $(this).attr('data-receipt-account-id');
                var receiptAmountToEdit = $(this).attr('data-receipt-amount');
                var receiptDescriptionToEdit = $(this).attr('data-receipt-description');
                var receiptRegistrationNoToEdit = $(this).attr('data-receipt-registration-no');
                var receiptMarlaToEdit = $(this).attr('data-receipt-marla');
                var receiptBlockToEdit = $(this).attr('data-receipt-block');
                var receiptSectorToEdit = $(this).attr('data-receipt-sector');
                var receiptPlotNoToEdit = $(this).attr('data-receipt-plot_no');
                var receiptInvToEdit = $(this).attr('data-receipt-inv');

                $('#editReceiptModal').show();
                $('#edit_receipt_new_date').val(receiptDateToEdit);
                $('#edit_receipt_new_description').val(receiptDescriptionToEdit);
                $('#edit_receipt_new_amount').val(receiptAmountToEdit);
                $('#edit_receipt_new_id').val(receiptId);


                $('#edit_receipt_new_registration_no').val(receiptRegistrationNoToEdit);
                $('#edit_receipt_new_block').val(receiptBlockToEdit);
                $('#edit_receipt_new_marla').val(receiptMarlaToEdit);
                $('#edit_receipt_new_sector').val(receiptSectorToEdit);
                $('#edit_receipt_new_plot_no').val(receiptPlotNoToEdit);
                $('#edit_receipt_new_inv').val(receiptInvToEdit);
            }

        });

        $(document).delegate('#receiptUpdateButton', 'click', function(){
                var receiptNewDateUpdate = $('#edit_receipt_new_date').val();
                var receiptNewDescription = $('#edit_receipt_new_description').val();
                var receiptNewAmount = $('#edit_receipt_new_amount').val();
                var receiptId = $('#edit_receipt_new_id').val();

                var receiptNewRegistrationNo = $('#edit_receipt_new_registration_no').val();
                var receiptNewBlock = $('#edit_receipt_new_block').val();
                var receiptNewMarla = $('#edit_receipt_new_marla').val();
                var receiptNewSector = $('#edit_receipt_new_sector').val();
                var receiptNewPlotNo = $('#edit_receipt_new_plot_no').val();
                var receiptNewInv = $('#edit_receipt_new_inv').val();



                let DateToRequest = null;
                let fetchReceiptType = null;


            if(receiptNewDescription != '' && receiptNewDescription != null && receiptNewDateUpdate != '' && receiptNewDateUpdate != null && receiptNewAmount != '' && receiptNewAmount != null){

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var type = $(this).attr('updateReceiptType');

                if(type == 'dasti'){
                    fetchReceiptType = 'account';
                    DateToRequest = {
                        description: receiptNewDescription,
                        _date: receiptNewDateUpdate,
                        amount: receiptNewAmount,
                        id: receiptId,
                    };
                }else if(type == 'customer'){
                    fetchReceiptType = 'customer';

                    DateToRequest = {
                        description: receiptNewDescription,
                        _date: receiptNewDateUpdate,
                        amount: receiptNewAmount,
                        id: receiptId,
                        registration_no: receiptNewRegistrationNo,
                        block: receiptNewBlock,
                        marla: receiptNewMarla,
                        sector: receiptNewSector,
                        plot_no: receiptNewPlotNo,
                        inv: receiptNewInv,
                    };
                }

                $.ajax({
                    url: "<?php echo e(route('edit.receipt')); ?>",
                    type: "POST",
                    data: DateToRequest,
                    success: function(response) { // What to do if we succeed
                        console.log(response);
                        if (response.code == 200) {
                            swal("Success!", response.message, "success");
                            $('.editModel').hide();
                            $('#list-of-receipts').empty();
                            $('#receipt-table').DataTable().clear();
                            $('#receipt-table').DataTable().destroy();
                            fetchReceipts(fetchReceiptType);
                            getPaymentReceiptBalance();

                        } else {
                            swal(response.message);
                            swal("Error!", response.message, "error");
                        }

                    }
                });

            }else{

                swal("Error!", "Make sure you filled all field correctly!", "error");
            }
        });


        $(document).delegate('.paymentEditBtn','click',function(){
            var paymentType = $(this).attr('edittype');
            var paymentId = $(this).attr('data-payment-id');
            var paymentDate = $(this).attr('data-payment-date');
            var paymentAccountId = $(this).attr('data-payment-account-id');
            var paymentCatId = $(this).attr('data-payment-category-id');
            var paymentSubCatId = $(this).attr('data-payment-subcategory-id');
            var paymentDescription = $(this).attr('data-payment-description');
            var paymentAmount = $(this).attr('data-payment-amount');


            $('#edit_payment_new_date').val(paymentDate);
            $('#edit_payment_new_id').val(paymentId);
            $('#edit_payment_new_description').val(paymentDescription);
            $('#edit_payment_new_amount').val(paymentAmount);

            $('#editPaymnetModal').show();
        });


        $(document).delegate('#paymentUpdateButton', 'click', function(){
                var paymentNewDateUpdate = $('#edit_payment_new_date').val();
                var paymentNewDescription = $('#edit_payment_new_description').val();
                var paymentNewAmount = $('#edit_payment_new_amount').val();
                var paymentId = $('#edit_payment_new_id').val();


            if(paymentNewDescription != '' && paymentNewDescription != null && paymentNewDateUpdate != '' && paymentNewDateUpdate != null && paymentNewAmount != '' && paymentNewAmount != null){

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });


                $.ajax({
                    url: "<?php echo e(route('edit.payment')); ?>",
                    type: "POST",
                    data: {
                        description: paymentNewDescription,
                        _date: paymentNewDateUpdate,
                        amount: paymentNewAmount,
                        id: paymentId,
                    },
                    success: function(response) { // What to do if we succeed
                        console.log(response);
                        if (response.code == 200) {
                            swal("Success!", response.message, "success");
                            $('.editModel').hide();
                            $('#list-of-payments').empty();
                            $('#payment-table').DataTable().clear();
                            $('#payment-table').DataTable().destroy();
                            fetchPayments();
                            getPaymentReceiptBalance();

                        } else {
                            swal(response.message);
                            swal("Error!", response.message, "error");
                        }

                    }
                });

            }else{

                swal("Error!", "Make sure you filled all field correctly!", "error");
            }
        });
    </script>
</body>

</html>
<?php /**PATH D:\xampp\htdocs\accountApp\resources\views/site_layout/dashboard_layout.blade.php ENDPATH**/ ?>