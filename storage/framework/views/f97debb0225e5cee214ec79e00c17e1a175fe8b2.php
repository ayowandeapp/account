<div class="editModel" id="editCategoryModal" style="position: absolute;
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
    right: 0%;" id="editCategoryModalCloseBtn">x</div>
    <h3 align="center">Edit Category</h3>
    <hr>

    <div class="model-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="category_name">Category Name</label>
                    <input type="text" class="form-control" name="category_name" id="edit_category_name"
                           placeholder="Please Enter Category Name!" autofocus>
                    <input type="hidden" name="category_id" id="edit_category_id">
                </div>
            </div>
        </div>

    </div>


    <hr>
    <input type="button" value="Update" class="btn btn-primary float-right" id="categoryUpdateButton">
</div>
<?php /**PATH C:\wamp64\www\accountApp\resources\views/modals/edit_category.blade.php ENDPATH**/ ?>