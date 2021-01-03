<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Payment;
use \App\SubCategory;

class PaymentController extends Controller
{
    public function create(Request $request)
    {
        $subCategories = "<option>Please Select Sub Category</option>";
        $allSubCats = SubCategory::all();
        foreach ($allSubCats as $subcategory) {
            $subCategories .= '<option value="' . $subcategory->id . '">' . $subcategory->sub_cat_name . '</option>';
        }

        if (!isset($request->account_id) || $request->account_id == '' || $request->account_id == NULL) {
            $payments = Payment::orderBy('created_at', 'Desc')->get();
            $paymentsTotal = Payment::orderBy('created_at', 'Desc')->pluck('amount')->sum();
            $dataElements = "";
            foreach ($payments as $payment) {
                $dataElements .= '
            <tr>
                <td>' . ($payment->payment_date) . '</td>
                <td>' . (isset($payment->account->acc_name) ? $payment->account->acc_name : '-') . '</td>
                <td>' . (isset($payment->subCategory->sub_cat_name) ? $payment->subCategory->sub_cat_name : '-') . '</td>
                <td>' . ($payment->description) . '</td>
                <td>' . ($payment->amount) . '</td>
                <td>' . ($payment->type) . '</td>
                <td>
                    <a href="#"
                    class="paymentEditBtn" editType="'.($payment->type).'"
                    data-payment-id="'.($payment->id).'"
                    data-payment-date="'.($payment->payment_date).'"
                    data-payment-account-id="'.($payment->account_id).'"
                    data-payment-category-id="'.($payment->paycat_id).'"
                    data-payment-subcategory-id="'.($payment->sub_category_id).'"
                    data-payment-description="'.($payment->description).'"
                    data-payment-amount="'.($payment->amount).'"

                    >
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                    </a>
                    <a href="#" class="deleteBtn" delte-type="delete-payment" delete-acc-id="' . ($payment->id) . '">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                    </a>
                </td>
            </tr>
            ';
            }
            $data = [
                "subCategories" => $subCategories, "data" =>
                $dataElements, "total_payment" => $paymentsTotal,
                "message" => "Make sure Account field is selected!",
                "code" => 100
            ];
            return $data;
        }

        /*if ($request->type == 'expense' || !isset($request->sub_category_id) || $request->sub_category_id == '' || $request->sub_category_id == NULL) {
            $payments = Payment::orderBy('created_at', 'Desc')->get();
            $paymentsTotal = Payment::orderBy('created_at', 'Desc')->pluck('amount')->sum();
            $dataElements = "";
            foreach ($payments as $payment) {
                $dataElements .= '
            <tr>
                <td>' . ($payment->payment_date) . '</td>
                <td>' . (isset($payment->account->acc_name) ? $payment->account->acc_name : '-') . '</td>
                <td>' . (isset($payment->subCategory->sub_cat_name) ? $payment->subCategory->sub_cat_name : '-') . '</td>
                <td>' . ($payment->description) . '</td>
                <td>' . ($payment->amount) . '</td>
                <td>' . ($payment->type) . '</td>
                <td>
                    <a href="#">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                    </a>
                    <a href="#" class="deleteBtn" delte-type="delete-payment" delete-acc-id="' . ($payment->id) . '">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                    </a>
                </td>

            </tr>
            ';
            }
            $data = [
                "subCategories" => $subCategories,
                "data" => $dataElements, "total_payment" => $paymentsTotal,
                "message" => "Make sure SubCategory field is selected!",
                "code" => 100
            ];
            return $data;
        } */
        if (!isset($request->amount) || $request->amount == '' || $request->amount == NULL) {
            $payments = Payment::orderBy('created_at', 'Desc')->get();
            $paymentsTotal = Payment::orderBy('created_at', 'Desc')->pluck('amount')->sum();
            $dataElements = "";
            foreach ($payments as $payment) {
                $dataElements .= '
            <tr>
                <td>' . ($payment->payment_date) . '</td>
                <td>' . (isset($payment->account->acc_name) ? $payment->account->acc_name : '-') . '</td>
                <td>' . (isset($payment->subCategory->sub_cat_name) ? $payment->subCategory->sub_cat_name : '-') . '</td>
                <td>' . ($payment->description) . '</td>
                <td>' . ($payment->amount) . '</td>
                <td>' . ($payment->type) . '</td>
                <td>
                    <a href="#"
                    class="paymentEditBtn" editType="'.($payment->type).'"
                    data-payment-id="'.($payment->id).'"
                    data-payment-date="'.($payment->payment_date).'"
                    data-payment-account-id="'.($payment->account_id).'"
                    data-payment-category-id="'.($payment->paycat_id).'"
                    data-payment-subcategory-id="'.($payment->sub_category_id).'"
                    data-payment-description="'.($payment->description).'"
                    data-payment-amount="'.($payment->amount).'"

                    >
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                    </a>
                    <a href="#" class="deleteBtn" delte-type="delete-payment" delete-acc-id="' . ($payment->id) . '">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                    </a>
                </td>

            </tr>
            ';
            }
            $data = [
                "subCategories" => $subCategories,
                "data" => $dataElements, "total_payment" => $paymentsTotal,
                "message" => "Make sure Amount field is selected!",
                "code" => 100
            ];
            return $data;
        }
        if (!isset($request->payment_date) || $request->payment_date == '' || $request->payment_date == NULL) {
            $payments = Payment::orderBy('created_at', 'Desc')->get();
            $paymentsTotal = Payment::orderBy('created_at', 'Desc')->pluck('amount')->sum();
            $dataElements = "";
            foreach ($payments as $payment) {
                $dataElements .= '
            <tr>
                <td>' . ($payment->payment_date) . '</td>
                <td>' . (isset($payment->account->acc_name) ? $payment->account->acc_name : '-') . '</td>
                <td>' . (isset($payment->subCategory->sub_cat_name) ? $payment->subCategory->sub_cat_name : '-') . '</td>
                <td>' . ($payment->description) . '</td>
                <td>' . ($payment->amount) . '</td>
                <td>' . ($payment->type) . '</td>
                <td>
                    <a href="#"
                    class="paymentEditBtn" editType="'.($payment->type).'"
                    data-payment-id="'.($payment->id).'"
                    data-payment-date="'.($payment->payment_date).'"
                    data-payment-account-id="'.($payment->account_id).'"
                    data-payment-category-id="'.($payment->paycat_id).'"
                    data-payment-subcategory-id="'.($payment->sub_category_id).'"
                    data-payment-description="'.($payment->description).'"
                    data-payment-amount="'.($payment->amount).'"

                    >
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                    </a>
                    <a href="#" class="deleteBtn" delte-type="delete-payment" delete-acc-id="' . ($payment->id) . '">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                    </a>
                </td>

            </tr>
            ';
            }
            $data = [
                "subCategories" => $subCategories,
                "data" => $dataElements, "total_payment" => $paymentsTotal,
                "message" => "Make sure Date field is selected!",
                "code" => 100
            ];
            return $data;
        }
        Payment::create($request->all());
        $payments = Payment::orderBy('created_at', 'Desc')->get();
        $paymentsTotal = Payment::orderBy('created_at', 'Desc')->pluck('amount')->sum();
        $dataElements = "";
        foreach ($payments as $payment) {
            $dataElements .= '
            <tr>
                <td>' . ($payment->payment_date) . '</td>
                <td>' . (isset($payment->account->acc_name) ? $payment->account->acc_name : '-') . '</td>
                <td>' . (isset($payment->subCategory->sub_cat_name) ? $payment->subCategory->sub_cat_name : '-') . '</td>
                <td>' . ($payment->description) . '</td>
                <td>' . ($payment->amount) . '</td>
                <td>' . ($payment->type) . '</td>
                <td>
                    <a href="#"
                    class="paymentEditBtn" editType="'.($payment->type).'"
                    data-payment-id="'.($payment->id).'"
                    data-payment-date="'.($payment->payment_date).'"
                    data-payment-account-id="'.($payment->account_id).'"
                    data-payment-category-id="'.($payment->paycat_id).'"
                    data-payment-subcategory-id="'.($payment->sub_category_id).'"
                    data-payment-description="'.($payment->description).'"
                    data-payment-amount="'.($payment->amount).'"

                    >
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                    </a>
                    <a href="#" class="deleteBtn" delte-type="delete-payment" delete-acc-id="' . ($payment->id) . '">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                    </a>
                </td>
            </tr>
            ';
        }

        $data = [
            "subCategories" => $subCategories,
            "data" => $dataElements, "total_payment" => $paymentsTotal,
            "message" => "Payment received succesfully!",
            "code" => 200
        ];
        return $data;
    }
    public function delete(Request $request)
    {
        if (isset($request->account_id)) {
            Payment::find($request->account_id)->delete();
            return "Account Deleted Successfully!";
        }
    }


    public function edit(Request $request)
    {
        if (isset($request->id)) {
            $success = Payment::find($request->id)->update($request->all());
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
