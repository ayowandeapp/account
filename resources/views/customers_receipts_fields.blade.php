<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="form-group text-left col-2">
                <select name="customer_id" id="customer_id" class="form-control" required>
                    <option value="">Please Select Customer</option>
                    @if (isset($customers))
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}
                            </option>
                        @endforeach
                    @endif

                </select>
            </div>
            <div class="form-group text-left col-2">
                {{-- <label for="block">Block</label>
                --}}
                <input type="text" class="form-control" name="registration_no" id="registration_no" required
                    placeholder="Enter Registration No">
            </div>
            <div class="form-group text-left col-2">
                {{-- <label for="block">Block</label>
                --}}
                <input type="text" class="form-control" name="block" id="block" required placeholder="Enter Block">
            </div>
            <div class="form-group text-left col-2">
                {{-- <label for="block">Block</label>
                --}}
                <input type="text" class="form-control" name="marla" id="marla" required placeholder="Enter Marla">
            </div>
            <div class="form-group text-left col-2">
                {{-- <label for="sector">Sector</label>
                --}}
                <input type="text" class="form-control" name="sector" id="sector" required placeholder="Enter Sector">
            </div>
            <div class="form-group text-left col-2">
                {{-- <label for="plot_no">Plot No</label>
                --}}
                <input type="text" class="form-control" name="plot_no" id="plot_no" required
                    placeholder="Enter Plot No">
            </div>
            <div class="form-group text-left col-2">
                {{-- <label for="receipt_amount">Amount</label>
                --}}
                <input type="number" class="form-control" name="receipt_amount" id="receipt_amount" required
                    placeholder="Enter Amount">
            </div>
            <div class="form-group text-left col-2">
                {{-- <label for="inv">Invoice No</label>
                --}}
                <input type="text" class="form-control" name="inv" id="inv" required placeholder="Enter Invoice No">
            </div>
            <div class="form-group text-left col-2">
                {{-- <label for="receipt_date">Receipt Date</label>
                --}}
                <input class="form-control" type="date" name="receipt_date" id="receipt_date" required>
            </div>
            <div class="form-group text-left col-2">
                {{-- <label for="receipt_description">Description</label>
                --}}
                <input class="form-control" name="receipt_description" id="receipt_description" required
                    placeholder="Enter Description">
            </div>
            <div class="form-group text-right">
                <input type="button" value="Add" class="btn btn-primary" id="add-receipt-btn">
            </div>
        </div>
    </div>
    <div class="col-12">
        {{-- <h5>List Of Receipts</h5>
        --}}
        <table class="table table-hover table-bordered" id="receipt-table">
            <thead>
                <tr>
                    <td><b>Customer</b></td>
                    <td><b>Registration</b></td>
                    <td><b>Marla</b></td>
                    <td><b>Block</b></td>
                    <td><b>Sector</b></td>
                    <td><b>Plot No</b></td>
                    <td><b>Amount</b></td>
                    <td><b>Inv</b></td>
                    <td><b>Date</b></td>
                    <td><b>Description</b></td>
                    <td><b>Actions</b> </td>
                </tr>
            </thead>
            <tbody id="list-of-receipts">
            </tbody>
        </table>
    </div>
</div>
