<div class="editModel" id="editAccountModal" style="position: absolute;
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
    right: 0%;" id="editAccountModalCloseBtn">x</div>
    <h3 align="center">Edit Account</h3>
    <hr>

    <div class="model-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="acc_name">Account Name</label>
                    <input type="text" class="form-control" name="acc_name" id="edit_acc_name"
                           placeholder="Please Enter Account Name!" autofocus>
                    <input type="hidden" name="acc_id" id="edit_account_id">
                </div>
            </div>
        </div>

    </div>


    <hr>
    <input type="button" value="Update" class="btn btn-primary float-right" id="accountUpdateButton">
</div>
<?php /**PATH C:\wamp64\www\accountApp\resources\views/modals/edit_account.blade.php ENDPATH**/ ?>