<?php

namespace App\Http\Controllers;

use App\Account;
use Illuminate\Http\Request;
use \App\Customer;
use \App\Receipt;

class ReceiptController extends Controller
{
    public function create(Request $request)
    {


        if (isset($request->type) && $request->type == 'customer' && $request->type != 'account') {
            $customers = "<option>Please Select Customer</option>";
            $allCustomers = Customer::all();
            foreach ($allCustomers as $allCustomer) {
                $customers .= '<option value="' . $allCustomer->id . '">' . $allCustomer->name . '</option>';
            }

            if (!isset($request->customer_id) || $request->customer_id == '' || $request->customer_id == NULL) {
                $receipts = Receipt::where('account_id', null)->orderBy('created_at', 'Desc')->get();
                $receiptsTotal = Receipt::orderBy('created_at', 'Desc')->pluck('amount')->sum();
                $dataElements = "";
                foreach ($receipts as $receipt) {
                    $dataElements .= '
            <tr>
                <td>' . ($receipt->receipt_date) . '</td>
                <td>' . (isset($receipt->customer->name) ? $receipt->customer->name : '-') . '</td>
                <td>' . ($receipt->registration_no) . '</td>
                <td>' . ($receipt->marla) . '</td>
                <td>' . ($receipt->block) . '</td>
                <td>' . ($receipt->sector) . '</td>
                <td>' . ($receipt->plot_no) . '</td>
                <td>' . ($receipt->amount) . '</td>
                <td>' . ($receipt->inv) . '</td>
                <td>' . ($receipt->description) . '</td>
                <td>
                    <a href="#" class="receiptEditBtn" editType="edit_cashin_customer"
                        data-receipt-id="' . ($receipt->id) . '"
                        data-receipt-date="' . ($receipt->receipt_date) . '"
                        data-receipt-account-id="' . ($receipt->customer_id) . '"
                        data-receipt-amount="' . ($receipt->amount) . '"
                        data-receipt-description="' . ($receipt->description) . '"
                        data-receipt-registration-no="' . ($receipt->registration_no) . '"
                        data-receipt-marla="' . ($receipt->marla) . '"
                        data-receipt-block="' . ($receipt->block) . '"
                        data-receipt-sector="' . ($receipt->sector) . '"
                        data-receipt-plot_no="' . ($receipt->plot_no) . '"
                        data-receipt-inv="' . ($receipt->inv) . '"

                    >
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                    </a>
                    <a href="#" class="deleteBtn" delte-type="delete-receipt" delete-acc-id="' . ($receipt->id) . '" receipt-type="customer">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg" receipt-type="customer">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                    </a>
                </td>
            </tr>
            ';
                }
                $data = [
                    "customers" => $customers, "data" =>
                    $dataElements, "total_receipt" => $receiptsTotal,
                    "message" => "Make sure Customer field is selected!",
                    "code" => 100
                ];
                return $data;
            }

            if (isset($request->customer_id) && isset($request->block) && isset($request->sector)) {
                Receipt::create($request->all());
            }
            $receipts = Receipt::where('account_id', null)->orderBy('created_at', 'Desc')->get();
            $receiptsTotal = Receipt::orderBy('created_at', 'Desc')->pluck('amount')->sum();
            $dataElements = "";
            foreach ($receipts as $receipt) {
                $dataElements .= '
            <tr>
                <td>' . ($receipt->receipt_date) . '</td>
                <td>' . (isset($receipt->customer->name) ? $receipt->customer->name : '-') . '</td>
                <td>' . ($receipt->registration_no) . '</td>
                <td>' . ($receipt->marla) . '</td>
                <td>' . ($receipt->block) . '</td>
                <td>' . ($receipt->sector) . '</td>
                <td>' . ($receipt->plot_no) . '</td>
                <td>' . ($receipt->amount) . '</td>
                <td>' . ($receipt->inv) . '</td>
                <td>' . ($receipt->description) . '</td>
                <td>
                    <a href="#" class="receiptEditBtn" editType="edit_cashin_customer"
                        data-receipt-id="' . ($receipt->id) . '"
                        data-receipt-date="' . ($receipt->receipt_date) . '"
                        data-receipt-account-id="' . ($receipt->customer_id) . '"
                        data-receipt-amount="' . ($receipt->amount) . '"
                        data-receipt-description="' . ($receipt->description) . '"
                        data-receipt-registration-no="' . ($receipt->registration_no) . '"
                        data-receipt-marla="' . ($receipt->marla) . '"
                        data-receipt-block="' . ($receipt->block) . '"
                        data-receipt-sector="' . ($receipt->sector) . '"
                        data-receipt-plot_no="' . ($receipt->plot_no) . '"
                        data-receipt-inv="' . ($receipt->inv) . '"

                    >
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                    </a>
                    <a href="#" class="deleteBtn" delte-type="delete-receipt" delete-acc-id="' . ($receipt->id) . '" receipt-type="customer">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg" receipt-type="customer">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                    </a>
                </td>
            </tr>
            ';
            }

            $data = [
                "customers" => $customers,
                "data" => $dataElements, "total_receipt" => $receiptsTotal,
                "message" => "Receipt received succesfully!",
                "code" => 200
            ];
            return $data;
        } else {

            $accounts = "<option value=''>Please Select Dasti Khata</option>";
            $allAccounts = Account::all();
            foreach ($allAccounts as $allAccount) {
                $accounts .= '<option value="' . $allAccount->id . '">' . $allAccount->acc_name . '</option>';
            }

            if (!isset($request->customer_id) || $request->customer_id == '' || $request->customer_id == NULL) {
                $receipts = Receipt::where('customer_id', null)->orderBy('created_at', 'Desc')->get();
                $receiptsTotal = Receipt::orderBy('created_at', 'Desc')->pluck('amount')->sum();
                $dataElements = "";
                foreach ($receipts as $receipt) {
                    $dataElements .= '
            <tr>
                <td>' . ($receipt->receipt_date) . '</td>
                <td>' . ($receipt->account->acc_name) . '</td>
                <td>' . ($receipt->amount) . '</td>
                <td>' . ($receipt->description) . '</td>
                <td>
                    <a href="#" class="receiptEditBtn" editType="edit_cashin_dasti"
                        data-receipt-id="' . ($receipt->id) . '"
                        data-receipt-date="' . ($receipt->receipt_date) . '"
                        data-receipt-account-id="' . ($receipt->account_id) . '"
                        data-receipt-amount="' . ($receipt->amount) . '"
                        data-receipt-description="' . ($receipt->description) . '"

                    >
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                    </a>
                    <a href="#" class="deleteBtn" delte-type="delete-receipt" delete-acc-id="' . ($receipt->id) . '" receipt-type="customer">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg" receipt-type="customer">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                    </a>
                </td>
            </tr>
            ';
                }
                $data = [
                    "customers" => $accounts, "data" =>
                    $dataElements, "total_receipt" => $receiptsTotal,
                    "message" => "Make sure Account field is selected!",
                    "code" => 100
                ];
                return $data;
            }

            if (isset($request->customer_id) && isset($request->amount) && isset($request->receipt_date)) {

                $description = null;
                if (isset($request->description)) {
                    $description = $request->description;
                } else {
                    $description = null;
                }
                Receipt::create([
                    'account_id' => $request->customer_id,
                    'amount' => $request->amount,
                    'receipt_date' => $request->receipt_date,
                    'description' => $description,
                ]);
            }
            $receipts = Receipt::where('customer_id', null)->orderBy('created_at', 'Desc')->get();
            $receiptsTotal = Receipt::orderBy('created_at', 'Desc')->pluck('amount')->sum();
            $dataElements = "";
            foreach ($receipts as $receipt) {
                $dataElements .= '
            <tr>
                <td>' . ($receipt->receipt_date) . '</td>
                <td>' . ($receipt->account->acc_name) . '</td>
                <td>' . ($receipt->amount) . '</td>
                <td>' . ($receipt->description) . '</td>
                <td>
                    <a href="#" class="receiptEditBtn" editType="edit_cashin_dasti"
                        data-receipt-id="' . ($receipt->id) . '"
                        data-receipt-date="' . ($receipt->receipt_date) . '"
                        data-receipt-account-id="' . ($receipt->account_id) . '"
                        data-receipt-amount="' . ($receipt->amount) . '"
                        data-receipt-description="' . ($receipt->description) . '"

                    >
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                    </a>
                    <a href="#" class="deleteBtn" delte-type="delete-receipt" delete-acc-id="' . ($receipt->id) . '" receipt-type="customer">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg" receipt-type="customer">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                    </a>
                </td>
            </tr>
            ';
            }

            $data = [
                "customers" => $accounts,
                "data" => $dataElements, "total_receipt" => $receiptsTotal,
                "message" => "Receipt received succesfully!",
                "code" => 200
            ];
            return $data;
        }
    }

    public function delete(Request $request)
    {
        if (isset($request->account_id)) {
            Receipt::find($request->account_id)->delete();
            return "Receipt Deleted Successfully!";
        }
    }


    public function edit(Request $request)
    {
        if (isset($request->id)) {
            $success = Receipt::find($request->id)->update($request->all());
            if($success){
                $data = ["message" => "Record Updated Succesfully!", "code" => 200];
                return $data;
            }
            $data = ["message" => "Something is wrong during updateing record!", "code" => 100];
            return $data;
        }

        $data = ["message" => "Something is wrong during updateing record!", "code" => 100];
        return $data;

    }
}
