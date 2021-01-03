<div class="editModel" id="editReceiptModal" style="position: absolute;
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
    right: 0%;" id="editReceiptModalCloseBtn">x</div>
    <h3 align="center">Edit Receipt</h3>
    <hr>

    <div class="model-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="edit_receipt_new_date">Date</label>
                    <input type="date" class="form-control" id="edit_receipt_new_date"
                        autofocus>
                    <input type="hidden" id="edit_receipt_new_id">
                </div>
                <div class="form-group edit_receipt_new_hide">
                    <label for="edit_receipt_new_registration_no">Registration No</label>
                    <input type="text" class="form-control" id="edit_receipt_new_registration_no">
                </div>
                <div class="form-group edit_receipt_new_hide">
                    <label for="edit_receipt_new_block">Block</label>
                    <input type="text" class="form-control" id="edit_receipt_new_block">
                </div>
                <div class="form-group edit_receipt_new_hide">
                    <label for="edit_receipt_new_marla">Marla</label>
                    <input type="text" class="form-control" id="edit_receipt_new_marla">
                </div>
                <div class="form-group edit_receipt_new_hide">
                    <label for="edit_receipt_new_sector">Sector</label>
                    <input type="text" class="form-control" id="edit_receipt_new_sector">
                </div>
                <div class="form-group edit_receipt_new_hide">
                    <label for="edit_receipt_new_plot_no">Plot No</label>
                    <input type="text" class="form-control" id="edit_receipt_new_plot_no">
                </div>
                <div class="form-group edit_receipt_new_hide">
                    <label for="edit_receipt_new_inv">Invoice No</label>
                    <input type="text" class="form-control" id="edit_receipt_new_inv">
                </div>
                <div class="form-group">
                    <label for="edit_receipt_new_description">Description</label>
                    <input type="text" class="form-control"id="edit_receipt_new_description">
                </div>
                <div class="form-group">
                    <label for="edit_receipt_new_amount">Amount</label>
                    <input type="number" class="form-control"id="edit_receipt_new_amount">
                </div>
            </div>
        </div>

    </div>


    <hr>
    <input type="button" value="Update" class="btn btn-primary float-right" id="receiptUpdateButton">
</div>
<?php /**PATH C:\wamp64\www\accountApp\resources\views/modals/edit_cashin_dasti.blade.php ENDPATH**/ ?>