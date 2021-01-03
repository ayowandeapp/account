<div class="editModel" id="editCustomerModal" style="position: absolute;
    top: 10%;
    left: 30%;
    width: 35%;
    background-color: white;
    border-radius: 5px;
    padding: 10px;
    display: none;
}">
    <div class="closeEditModelBtn" id="" style="background-color: black;
    color: white;
    position: absolute;
    padding: 0px 7px;
    font-weight: bold;
    top: -1px;
    cursor: pointer;
    border-radius: 0px 5px 0px 0px;
    right: 0%;" id="editCustomerModalCloseBtn">x</div>
    <h3 align="center">Edit Customer</h3>
    <hr>

    <div class="model-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="customer_name">Customer Name</label>
                    <input type="text" class="form-control" name="customer_name" id="edit_customer_name"
                           placeholder="Please Enter Customer Name!" autofocus>
                    <input type="hidden" name="customer_id" id="edit_customer_id">
                </div>
            </div>
        </div>

    </div>


    <hr>
    <input type="button" value="Update" class="btn btn-primary float-right" id="customerUpdateButton">
</div>
<?php /**PATH C:\xampp2\htdocs\accountApp\resources\views/modals/edit_customer.blade.php ENDPATH**/ ?>