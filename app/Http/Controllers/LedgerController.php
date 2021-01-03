<?php

namespace App\Http\Controllers;

use App\JournalVoucher;
use App\Payment;
use App\Receipt;
use App\VoucherTransaction;
use Illuminate\Http\Request;

class LedgerController extends Controller
{
    public function index(Request $request)
    {
        $TotalPayments = 0;
        $TotalReceipts = 0;
        $totalDastiPayment = 0;
        $totalDastiReceipts = 0;
        $dataElement = "";
        //  && isset($request->from_date) && isset($request->to_date)
        if (isset($request->ledger_account_id)) {
            // $fromDate = \Carbon\Carbon::parse($request->from_date)->format('Y-m-d');
            // $toDate = \Carbon\Carbon::parse($request->to_date)->format('Y-m-d');
            $payments = Payment::where('account_id', $request->ledger_account_id)->get();
            $jvPayments = VoucherTransaction::where(
                'account_id_debit',
                $request->ledger_account_id
            )->get();
            $jvReceipts = VoucherTransaction::where(
                'account_id_credit',
                $request->ledger_account_id
            )->get();
            $receipts = Receipt::where(
                'account_id',
                $request->ledger_account_id
            )->get();
            $receipts2 = Receipt::where(
                'customer_id',
                $request->ledger_account_id
            )->get();

            if (count($payments) > 0 && count($payments) != 0) {
                foreach ($payments as $payment) {
                    if($payment->type == "dasti"){
                        $totalDastiPayment += $payment->amount;
                    }else{
                        $TotalPayments += $payment->amount;
                    }
                    $dataElement .= '
                      <tr>
                            <td>' . (\Carbon\Carbon::parse($payment->payment_date)->format('d/M/Y')) . '</td>

                            <td>' . ($payment->description) . '</td>
                            <td>0</td>
                            <td>' . ($payment->amount) . '</td>
                            <td> ' . ucwords($payment->type) . ' </td>
                      </tr>
                    ';
                }
            }

            if (count($receipts) > 0 && count($receipts) != 0) {
                foreach ($receipts as $payment) {
                    $totalDastiReceipts += $payment->amount;
                    $dataElement .= '
                      <tr>
                            <td>' . (\Carbon\Carbon::parse($payment->receipt_date)->format('d/M/Y')) . '</td>

                            <td>' . ($payment->description) . '</td>
                            <td>' . ($payment->amount) . '</td>
                            <td>0</td>
                            <td> Dasti </td>
                      </tr>
                    ';
                }
            }
            if (count($receipts2) > 0 && count($receipts2) != 0) {
                foreach ($receipts2 as $payment) {
                    $TotalReceipts += $payment->amount;
                    $dataElement .= '
                      <tr>
                            <td>' . (\Carbon\Carbon::parse($payment->receipt_date)->format('d/M/Y')) . '</td>

                            <td>' . ($payment->description) . '</td>
                            <td>' . ($payment->amount) . '</td>
                            <td>0</td>
                            <td> Customer Receive </td>
                      </tr>
                    ';
                }
            }

            $TotalBalce = $TotalReceipts - $TotalPayments;
            $TotalDastiBalce = $totalDastiReceipts - $totalDastiPayment;
            $dataElement .= '
            <tr>
                <th colspan="4"><h5>Balance</h5></th>
                <th colspan="4"><h5>'.($TotalBalce).'</h5></th>
            </tr>
            <tr>
                <th colspan="4"><h5>Dasti Balance</h5></th>
                <th colspan="4"><h5>'.($TotalDastiBalce).'</h5></th>
            </tr>
            ';

            $data = [
                'data' => $dataElement,
                "message" => "all record fetched successfully!",
                "code" => 200
            ];
            return $data;
        }

        $data = [
            "message" => "Make sure you selected all fields!",
            "code" => 100
        ];
        return $data;
    }

    public function categoryLedger(Request $request){
        $TotalPayments = 0;
        $TotalReceipts = 0;
        $totalDastiPayment = 0;
        $totalDastiReceipts = 0;
        $dataElement = "";
        if (isset($request->category_id)) {
            $payments = Payment::where('paycat_id', $request->category_id)->get();


            if (count($payments) > 0 && count($payments) != 0) {
                foreach ($payments as $payment) {
                    if($payment->type == "dasti"){
                        $totalDastiPayment += $payment->amount;
                    }else{
                        $TotalPayments += $payment->amount;
                    }
                    $dataElement .= '
                      <tr>
                            <td>' . (\Carbon\Carbon::parse($payment->payment_date)->format('d/M/Y')) . '</td>

                            <td>' . ($payment->description) . '</td>
                            <td>0</td>
                            <td>' . ($payment->amount) . '</td>
                            <td> ' . ucwords($payment->type) . ' </td>
                      </tr>
                    ';
                }
            }

            $TotalBalce = $TotalReceipts - $TotalPayments;
            $TotalDastiBalce = $totalDastiReceipts - $totalDastiPayment;
            $dataElement .= '
            <tr>
                <th colspan="4"><h5>Balance</h5></th>
                <th colspan="4"><h5>'.($TotalBalce).'</h5></th>
            </tr>
            <tr>
                <th colspan="4"><h5>Dasti Balance</h5></th>
                <th colspan="4"><h5>'.($TotalDastiBalce).'</h5></th>
            </tr>
            ';


            $data = [
                'data' => $dataElement,
                "message" => "all record fetched successfully!",
                "code" => 200
            ];
            return $data;
        }

        $data = [
            "message" => "Make sure you selected all fields!",
            "code" => 100
        ];
        return $data;

    }
    public function subcategoryLedger(Request $request){

        $TotalPayments = 0;
        $TotalReceipts = 0;
        $totalDastiPayment = 0;
        $totalDastiReceipts = 0;

        $dataElement = "";
        if (isset($request->subcategory_id)) {
            $payments = Payment::where('sub_category_id', $request->subcategory_id)->get();


            if (count($payments) > 0 && count($payments) != 0) {
                foreach ($payments as $payment) {
                    if($payment->type == "dasti"){
                        $totalDastiPayment += $payment->amount;
                    }else{
                        $TotalPayments += $payment->amount;
                    }
                    $dataElement .= '
                      <tr>
                            <td>' . (\Carbon\Carbon::parse($payment->payment_date)->format('d/M/Y')) . '</td>

                            <td>' . ($payment->description) . '</td>
                            <td>0</td>
                            <td>' . ($payment->amount) . '</td>
                            <td> ' . ucwords($payment->type) . ' </td>
                      </tr>
                    ';
                }
            }

            $TotalBalce = $TotalReceipts - $TotalPayments;
            $TotalDastiBalce = $totalDastiReceipts - $totalDastiPayment;
            $dataElement .= '
            <tr>
                <th colspan="4"><h5 align="left">Expense Balance</h5></th>
                <th colspan="4"><h5>'.($TotalBalce).'</h5></th>
            </tr>
            <tr>
                <th colspan="4"><h5 align="left">Dasti Balance</h5></th>
                <th colspan="4"><h5>'.($TotalDastiBalce).'</h5></th>
            </tr>
            ';


            $data = [
                'data' => $dataElement,
                "message" => "all record fetched successfully!",
                "code" => 200
            ];
            return $data;
        }

        $data = [
            "message" => "Make sure you selected all fields!",
            "code" => 100
        ];
        return $data;

    }
}
