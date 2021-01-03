<div class="editModel" id="editPaymnetModal" style="position: absolute;
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
    right: 0%;" id="editPaymnetModalCloseBtn">x</div>
    <h3 align="center">Edit Payment</h3>
    <hr>

    <div class="model-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="edit_payment_new_date">Date</label>
                    <input type="date" class="form-control" id="edit_payment_new_date"
                        autofocus>
                    <input type="hidden" id="edit_payment_new_id">
                </div>
                <div class="form-group">
                    <label for="edit_payment_new_description">Description</label>
                    <input type="text" class="form-control"id="edit_payment_new_description">
                </div>
                <div class="form-group">
                    <label for="edit_payment_new_amount">Amount</label>
                    <input type="number" class="form-control"id="edit_payment_new_amount">
                </div>
            </div>
        </div>

    </div>


    <hr>
    <input type="button" value="Update" class="btn btn-primary float-right" id="paymentUpdateButton">
</div>
<?php /**PATH C:\xampp2\htdocs\accountApp\resources\views/modals/edit_cashout.blade.php ENDPATH**/ ?>