<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Account;

class AccountController extends Controller
{
    public function create(Request $request)
    {

        if (!isset($request->acc_name) || $request->acc_name == '' || $request->acc_name == NULL) {
            $accounts = Account::orderBy('created_at', 'Desc')->get();
            $dataElements = "";
            foreach ($accounts as $account) {
                $balaceAmount = 0;
                foreach($account->receipts as $receiptBal){
                    $balaceAmount += $receiptBal->amount;
                }
                $balaceAmountPayment = 0;
                foreach($account->payments as $paymentBal){
                    $balaceAmountPayment += $paymentBal->amount;
                }
                $dataElements .= '
            <tr style="cursor: pointer;">
                <td>' . ($account->acc_name) . '</td>

                <td style="color: green">' . ($balaceAmount) . '</td>
                <td style="color: red">' . ($balaceAmountPayment) . '</td>

                <td>
                    <a href="#" account-id="' . ($account->id) . '" class="account-list-table">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-graph-up" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                    </a>
                    <a href="#" class="accountEditBtn" data-account-id="' . ($account->id) . '" data-account-name="' . ($account->acc_name) . '" data-account-type="' . (isset($account->accountType) ? $account->accountType['name'] : '-') . '">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                    </a>';
                if (count($account->payments) > 0 && count($account->payments) != 0) {
                    $dataElements .= '<a href="#" class="hasChileds">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                    </a>';
                } else {
                    $dataElements .= '<a href="#" class="deleteBtn" delte-type="delete-account" delete-acc-id="' . ($account->id) . '">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                    </a>';
                }
                $dataElements .= '</td>
            </tr>
            ';
            }
            $data = ["data" => $dataElements, "message" => "Make sure Account Name field is not empty!", "code" => 100];
            return $data;
        }
        // if(!isset($request->acc_type_id) || $request->acc_type_id == '' || $request->acc_type_id == NULL){
        //     $accounts = Account::orderBy('created_at', 'Desc')->get();
        //     $dataElements = "";
        //     foreach ($accounts as $account) {
        //         $dataElements .= '
        //     <tr>
        //         <td>' . ($account->acc_name) . '</td>
        //         <td>' . ($account->accountType->name) . '</td>
        //     </tr>
        //     ';
        //     }
        //     $data = ["data" => $dataElements, "message" => "Make sure Account Type field is not empty!", "code" => 100];
        //     return $data;
        // }
        Account::create($request->all());
        $accounts = Account::orderBy('created_at', 'Desc')->get();
        $dataElements = "";
        foreach ($accounts as $account) {
            $balaceAmount = 0;
            foreach($account->receipts as $receiptBal){
                $balaceAmount += $receiptBal->amount;
            }
            $balaceAmountPayment = 0;
            foreach($account->payments as $paymentBal){
                $balaceAmountPayment += $paymentBal->amount;
            }
            $dataElements .= '
            <tr style="cursor: pointer;">
                <td>' . ($account->acc_name) . '</td>

                <td style="color: green">' . ($balaceAmount) . '</td>
                <td style="color: red">' . ($balaceAmountPayment) . '</td>
                <td>
                    <a href="#" account-id="' . ($account->id) . '" class="account-list-table">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-graph-up" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                    </a>
                    <a href="#" class="accountEditBtn" data-account-id="' . ($account->id) . '" data-account-name="' . ($account->acc_name) . '" data-account-type="' . (isset($account->accountType) ? $account->accountType['name'] : '-') . '">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                    </a>';
            if (count($account->payments) > 0 && count($account->payments) != 0) {
                $dataElements .= '<a href="#" class="hasChileds">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                    </a>';
            } else {
                $dataElements .= '<a href="#" class="deleteBtn" delte-type="delete-account" delete-acc-id="' . ($account->id) . '">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                    </a>';
            }
            $dataElements .= '</td>
            </tr>
            ';
        }

        $data = ["data" => $dataElements, "message" => "Balance account created succesfully!", "code" => 200];
        return $data;
    }





    public function delete(Request $request)
    {
        if (isset($request->account_id)) {
            Account::find($request->account_id)->delete();
            return "Account Deleted Successfully!";
        }
    }

    public function edit(Request $request){
        $accoutId = $request->id;
        $accoutNewName = $request->acc_name;

        $updateSuccess = Account::find($accoutId)->update(["acc_name" => $accoutNewName]);
        if($updateSuccess){
            $data = ["message" => "Account Updated Succesfully!", "code" => 200];
            return $data;
        }
        $data = ["message" => "Something is wrong during updateing record!", "code" => 100];
        return $data;
    }


    public function getAllAccountSelectOption(Request $request)
    {
        $accounts = Account::all();
        $data = "";
        if($accounts){
            $data .= '<option selected>Please Select Account<option>';
            foreach($accounts as $account){
                $data .= '<option value="'.($account->id).'">'.($account->acc_name).'<option>';
            }

            return $data;
        }
    }
}
