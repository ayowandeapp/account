<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Account;
use \App\AccountType;
use App\Category;
use App\Customer;
use App\User;
use App\Payment;
use App\Receipt;
use App\SubCategory;
use Hash;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $accountstype = AccountType::all();
        $categories = Category::all();
        $accounts = Account::all();
        $subcategories = SubCategory::all();
        $customers = Customer::all();
        return view('welcome', compact('accountstype', 'categories', 'accounts', 'subcategories', 'customers'));
        return view('home', compact('accounts'));
    }
    public function getPaymentReceiptBalace()
    {

        $paymentsTotal = (int) Payment::orderBy('created_at', 'Desc')->pluck('amount')->sum();
        $receiptsTotal = (int) Receipt::orderBy('created_at', 'Desc')->pluck('amount')->sum();
        $balanceTotal = $receiptsTotal - $paymentsTotal;

        //current date calculation
        $payment = Payment::orderBy('created_at', 'Desc')->first();
        $current_payment = (int) Payment::where('created_at', "Like", "%" . date('Y-m-d') . "%")->pluck('amount')->sum();


        $receipt = Receipt::orderBy('created_at', 'Desc')->first();

        $current_receipt = (int) Receipt::where('created_at', "Like", "%" . date('Y-m-d') . "%")->pluck('amount')->sum();

        $current_balace = (int) $current_receipt - $current_payment;

        return response()->json([
            'currentPayment' => $current_payment,
            'currentReceipt' => $current_receipt,
            'currentBalace' => $current_balace,
            'totalPayments' => $paymentsTotal, 'totalReceipts' => $receiptsTotal, 'totalBalace' => $balanceTotal
        ]);
    }

    public function settings(Request $request){
        if(isset($request->name) && isset($request->id)){
            User::find($request->id)->update(['name' => $request->name]);
            return redirect()->route('/');
        }
        if(isset($request->password) && isset($request->id)){
            User::find($request->id)->update(['password' => Hash::make($request->password)]);
            Auth::logout();
            return redirect()->route('login')->with(['error' => 'Your Password Updated Successfully! You need to login again!']);

        }
    }
}