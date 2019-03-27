<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\FundTransfer;
use User;
use Auth;
use DB;
class WalletController extends Controller
{
  public function __construct() {
      $this->middleware('auth');
  }


  public function interTransfer() {

      return view('wallet.internal');
  }

  public function externalTransfer() {

      return view('wallet.external');
  }
  public function balances() {

      return view('wallet.balances');
  }

  public function index() {

            return view('wallet.index');

  }

  public function ewallet() {

     return view('wallet.ewallettransfer');
  }

  public function ewalletwithdraw() {

     return view('wallet.ewalletwithdraw');

  }

  public function ewalletTransfer(Request $request) {

      $amount   = $request->input('amount');
      $password = $request->input('transpassword');
      $balance  = DB::table('final_e_wallet')->where('user_id',Auth::user()->user_id)->sum('amount');
      $countUser = DB::table('user_registration')->where('user_id',Auth::user()->user_id)->where('t_code',$password)->count('id');
      if($countUser > 0 ) {


            if($balance >= $amount) {
              $invoice_no = rand(111111111,9999999);
                        DB::table('final_e_wallet')->where('user_id',Auth::user()->user_id)->decrement('amount',$amount);
                      DB::table('credit_debit')
                            ->insert([
                                    'transaction_no' => $invoice_no,
                                    'user_id' => Auth::user()->user_id,
                                    'credit_amt' => 0,
                                    'debit_amt' => $amount,
                                    'admin_charge' => 0,
                                    'receiver_id' => Auth::user()->user_id,
                                    'sender_id' => Auth::user()->user_id,
                                    'receive_date' => date('Y-m-d'),
                                    'ttype' => 'Fund Transfer',
                                    'TranDescription' => 'Fund transfer E to R Wallet',
                                    'Cause' => 'Fund transfer E to R Wallet',
                                    'Remark'    => 'Fund Transfer',
                                    'invoice_no' => $invoice_no,
                                    'product_name' => 'Fund Transfer',
                                    'status'  => 0,
                                    'ewallet_used_by' => 'E Wallet',
                                    'current_url'  => 'https://'
                            ]);
                            DB::table('final_r_wallet')->where('user_id',Auth::user()->user_id)->increment('amount',$amount);
                            DB::table('credit_debit')
                                  ->insert([
                                          'transaction_no' => $invoice_no,
                                          'user_id' => Auth::user()->user_id,
                                          'credit_amt' => $amount,
                                          'debit_amt' => 0,
                                          'admin_charge' => 0,
                                          'receiver_id' => Auth::user()->user_id,
                                          'sender_id' => Auth::user()->user_id,
                                          'receive_date' => date('Y-m-d'),
                                          'ttype' => 'Fund Transfer',
                                          'TranDescription' => 'Fund transfer E to R Wallet',
                                          'Cause' => 'Fund transfer E to R Wallet',
                                          'Remark'    => 'Fund Transfer',
                                          'invoice_no' => $invoice_no,
                                          'product_name' => 'Fund Transfer',
                                          'status'  => 0,
                                          'ewallet_used_by' => 'R Wallet',
                                          'current_url'  => 'https://'
                                  ]);

                  return back()->with(['message' => 'Fund has been tranferred','type' => 'success']);
            }

            else {
                  return back()->with(['message' => 'Insufficient Fund','type' => 'error']);
            }
        }
        else {

            return back()->with(['message' => 'Incorrect Transaction Password','type' => 'error']);
        }

  }

  public function ewalletwithdrawrequest(Request $request) {

      $amount   = $request->input('amount');
      $password = $request->input('transpassword');
      $balance  = DB::table('final_e_wallet')->where('user_id',Auth::user()->user_id)->sum('amount');
      $countUser = DB::table('user_registration')->where('user_id',Auth::user()->user_id)->where('t_code',$password)->count('id');
      if($countUser > 0 ) {

            if($balance >= $amount) {
              $invoice_no = rand(111111111,9999999);
                      DB::table('final_e_wallet')->where('user_id',Auth::user()->user_id)->decrement('amount',$amount);
                      DB::table('credit_debit')
                            ->insert([
                                    'transaction_no' => $invoice_no,
                                    'user_id' => Auth::user()->user_id,
                                    'credit_amt' => 0,
                                    'debit_amt' => $amount,
                                    'admin_charge' => 0,
                                    'receiver_id' => Auth::user()->user_id,
                                    'sender_id' => Auth::user()->user_id,
                                    'receive_date' => date('Y-m-d'),
                                    'ttype' => 'Withdrawal Request',
                                    'TranDescription' => 'Withdrawal Request',
                                    'Cause' => 'Withdrawal Request',
                                    'Remark'    => 'Fund Transfer',
                                    'invoice_no' => $invoice_no,
                                    'product_name' => 'Withdrawal Request',
                                    'status'  => 0,
                                    'ewallet_used_by' => 'E Wallet',
                                    'current_url'  => 'https://'
                            ]);
                              DB::table('withdraw_request')
                                  ->insert([
                                          'transaction_number' => $invoice_no,
                                          'user_id'            => Auth::user()->user_id,
                                          'request_amount'     => $amount,
                                          'first_name'         => 'N/A',
                                          'last_name'          => 'N/A',
                                          'acc_name'           => 'N/A',
                                          'acc_number'         => 'N/A',
                                          'bank_nm'            => 'N/A',
                                          'branch_nm'          => 'N/A',
                                          'swift_code'         => 'N/A',
                                          'description'        => 'Withdrawal',
                                          'status'             => '0',
                                          'posted_date'       => date('Y-m-d'),
                                          'admin_remark'      => 'Pending',
                                          'admin_response_date' => 'NULL',
                                          'withdraw_wallet'     => 'E Wallet',
                                          'total_paid_amount'   => $amount,
                                          'transaction_charge'  => 0,
                                          'type'                => $request->input('type')
                                        ]);

                  return back()->with(['message' => 'Withdrawal has been submitted','type' => 'success']);
            }

            else {
                  return back()->with(['message' => 'Insufficient Fund','type' => 'error']);
            }
        }
        else {

            return back()->with(['message' => 'Incorrect Transaction Password','type' => 'error']);
        }

  }
public function rwallet() {

  return view('wallet.rwallet');
}

public function rwalletTransfer(Request $request) {

  $amount   = $request->input('amount');
  $password = $request->input('transpassword');
  $receiver_id = $request->input('receiver_id');
  $balance  = DB::table('final_r_wallet')->where('user_id',Auth::user()->user_id)->sum('amount');
  $countUser = DB::table('user_registration')->where('user_id',Auth::user()->user_id)->where('t_code',$password)->count('id');
  $counReciver = DB::table('user_registration')->where('user_id',$receiver_id)->orWhere('username',$receiver_id)->count('id');
  if( $countUser > 0 ) {

      if($counReciver > 0) {
        $rcvr = DB::table('user_registration')
                    ->where('user_id',$receiver_id)
                    ->orWhere('username',$receiver_id)
                    ->first(['user_id','username']);
        if( $balance >= $amount ) {
          $invoice_no = rand(111111111,9999999);

              //SENDER
                  DB::table('final_r_wallet')->where('user_id',Auth::user()->user_id)->decrement('amount',$amount);
                  DB::table('credit_debit')
                        ->insert([
                                'transaction_no' => $invoice_no,
                                'user_id' => Auth::user()->user_id,
                                'credit_amt' => 0,
                                'debit_amt' => $amount,
                                'admin_charge' => 0,
                                'receiver_id' => $rcvr->user_id,
                                'sender_id' => Auth::user()->user_id,
                                'receive_date' => date('Y-m-d'),
                                'ttype' => 'Fund Transfer',
                                'TranDescription' => 'Fund transfer from' .Auth::user()->username .' to ' . $rcvr->username,
                                'Cause' => 'Fund transfer from' .Auth::user()->username .' to ' . $rcvr->username,
                                'Remark'    => 'Fund Transfer',
                                'invoice_no' => $invoice_no,
                                'product_name' => 'Fund Transfer',
                                'status'  => 0,
                                'ewallet_used_by' => 'R Wallet',
                                'current_url'  => 'https://'
                        ]);
                      //RECEIVER
                        DB::table('final_r_wallet')->where('user_id',$rcvr->user_id)->increment('amount',$amount);
                        DB::table('credit_debit')
                              ->insert([
                                      'transaction_no' => $invoice_no,
                                      'user_id' => $rcvr->user_id,
                                      'credit_amt' => $amount,
                                      'debit_amt' => 0,
                                      'admin_charge' => 0,
                                      'receiver_id' => $rcvr->user_id,
                                      'sender_id' => Auth::user()->user_id,
                                      'receive_date' => date('Y-m-d'),
                                      'ttype' => 'Fund Transfer',
                                      'TranDescription' => 'Fund transfer from' .Auth::user()->username .' to ' . $rcvr->username,
                                      'Cause' => 'Fund transfer from' .Auth::user()->username .' to ' . $rcvr->username,
                                      'Remark'    => 'Fund Transfer',
                                      'invoice_no' => $invoice_no,
                                      'product_name' => 'Fund Transfer',
                                      'status'  => 0,
                                      'ewallet_used_by' => 'R Wallet',
                                      'current_url'  => 'https://'
                              ]);

              return back()->with(['message' => 'Fund has been tranferred','type' => 'success']);
        }

        else {
              return back()->with(['message' => 'Insufficient Fund','type' => 'error']);
        }

      }
      else {
            return back()->with(['message' => 'Receiver Not found','type' => 'error']);
      }
    }
    else {

        return back()->with(['message' => 'Incorrect Transaction Password','type' => 'error']);
    }



}

public function forexwallet() {

  return view('wallet.forexwallet');
}

public function forexwalletTransfer(Request $request) {

  $amount   = $request->input('amount');
  $password = $request->input('transpassword');
  $receiver_id = $request->input('receiver_id');
  $balance  = DB::table('final_forex_wallet')->where('user_id',Auth::user()->user_id)->sum('amount');
  $countUser = DB::table('user_registration')->where('user_id',Auth::user()->user_id)->where('t_code',$password)->count('id');
  $counReciver = DB::table('user_registration')->where('user_id',$receiver_id)->orWhere('username',$receiver_id)->count('id');
  if( $countUser > 0 ) {

      if($counReciver > 0) {
        $rcvr = DB::table('user_registration')
                    ->where('user_id',$receiver_id)
                    ->orWhere('username',$receiver_id)
                    ->first(['user_id','username']);
        if( $balance >= $amount ) {
          $invoice_no = rand(111111111,9999999);
              //SENDER
                  DB::table('final_forex_wallet')->where('user_id',Auth::user()->user_id)->decrement('amount',$amount);
                  DB::table('credit_debit')
                        ->insert([
                                'transaction_no' => $invoice_no,
                                'user_id' => Auth::user()->user_id,
                                'credit_amt' => 0,
                                'debit_amt' => $amount,
                                'admin_charge' => 0,
                                'receiver_id' => $rcvr->user_id,
                                'sender_id' => Auth::user()->user_id,
                                'receive_date' => date('Y-m-d'),
                                'ttype' => 'Fund Transfer',
                                'TranDescription' => 'Fund transfer from' .Auth::user()->username .' to ' . $rcvr->username,
                                'Cause' => 'Fund transfer from' .Auth::user()->username .' to ' . $rcvr->username,
                                'Remark'    => 'Fund Transfer',
                                'invoice_no' => $invoice_no,
                                'product_name' => 'Fund Transfer',
                                'status'  => 0,
                                'ewallet_used_by' => 'Forex Wallet',
                                'current_url'  => 'https://'
                        ]);
                      //RECEIVER
                        DB::table('final_forex_wallet')->where('user_id',$rcvr->user_id)->increment('amount',$amount);
                        DB::table('credit_debit')
                              ->insert([
                                      'transaction_no' => $invoice_no,
                                      'user_id' => $rcvr->user_id,
                                      'credit_amt' => $amount,
                                      'debit_amt' => 0,
                                      'admin_charge' => 0,
                                      'receiver_id' => $rcvr->user_id,
                                      'sender_id' => Auth::user()->user_id,
                                      'receive_date' => date('Y-m-d'),
                                      'ttype' => 'Fund Transfer',
                                      'TranDescription' => 'Fund transfer from' .Auth::user()->username .' to ' . $rcvr->username,
                                      'Cause' => 'Fund transfer from' .Auth::user()->username .' to ' . $rcvr->username,
                                      'Remark'    => 'Fund Transfer',
                                      'invoice_no' => $invoice_no,
                                      'product_name' => 'Fund Transfer',
                                      'status'  => 0,
                                      'ewallet_used_by' => 'Forex Wallet',
                                      'current_url'  => 'https://'
                              ]);

              return back()->with(['message' => 'Fund has been tranferred','type' => 'success']);
        }

        else {
              return back()->with(['message' => 'Insufficient Fund','type' => 'error']);
        }

      }
      else {
            return back()->with(['message' => 'Receiver Not found','type' => 'error']);
      }
    }
    else {

        return back()->with(['message' => 'Incorrect Transaction Password','type' => 'error']);
    }



}
public function virtualwallet() {

  return view('wallet.virtualwallet');
}

public function virtualwalletTransfer(Request $request) {

  $amount   = $request->input('amount');
  $password = $request->input('transpassword');
  $receiver_id = $request->input('receiver_id');
  $balance  = DB::table('final_apin_wallet')->where('user_id',Auth::user()->user_id)->sum('amount');
  $countUser = DB::table('user_registration')->where('user_id',Auth::user()->user_id)->where('t_code',$password)->count('id');
  $counReciver = DB::table('user_registration')->where('user_id',$receiver_id)->orWhere('username',$receiver_id)->count('id');
  if( $countUser > 0 ) {

      if($counReciver > 0) {
        $rcvr = DB::table('user_registration')
                    ->where('user_id',$receiver_id)
                    ->orWhere('username',$receiver_id)
                    ->first(['user_id','username']);
        if( $balance >= $amount ) {
          $invoice_no = rand(111111111,9999999);
              //SENDER
                  DB::table('final_apin_wallet')->where('user_id',Auth::user()->user_id)->decrement('amount',$amount);
                  DB::table('credit_debit')
                        ->insert([
                                'transaction_no' => $invoice_no,
                                'user_id' => Auth::user()->user_id,
                                'credit_amt' => 0,
                                'debit_amt' => $amount,
                                'admin_charge' => 0,
                                'receiver_id' => $rcvr->user_id,
                                'sender_id' => Auth::user()->user_id,
                                'receive_date' => date('Y-m-d'),
                                'ttype' => 'Fund Transfer',
                                'TranDescription' => 'Fund transfer from' .Auth::user()->username .' to ' . $rcvr->username,
                                'Cause' => 'Fund transfer from' .Auth::user()->username .' to ' . $rcvr->username,
                                'Remark'    => 'Fund Transfer',
                                'invoice_no' => $invoice_no,
                                'product_name' => 'Fund Transfer',
                                'status'  => 0,
                                'ewallet_used_by' => 'Virtual Wallet',
                                'current_url'  => 'https://'
                        ]);
                      //RECEIVER
                        DB::table('final_apin_wallet')->where('user_id',$rcvr->user_id)->increment('amount',$amount);
                        DB::table('credit_debit')
                              ->insert([
                                      'transaction_no' => $invoice_no,
                                      'user_id' => $rcvr->user_id,
                                      'credit_amt' => $amount,
                                      'debit_amt' => 0,
                                      'admin_charge' => 0,
                                      'receiver_id' => $rcvr->user_id,
                                      'sender_id' => Auth::user()->user_id,
                                      'receive_date' => date('Y-m-d'),
                                      'ttype' => 'Fund Transfer',
                                      'TranDescription' => 'Fund transfer from' .Auth::user()->username .' to ' . $rcvr->username,
                                      'Cause' => 'Fund transfer from' .Auth::user()->username .' to ' . $rcvr->username,
                                      'Remark'    => 'Fund Transfer',
                                      'invoice_no' => $invoice_no,
                                      'product_name' => 'Fund Transfer',
                                      'status'  => 0,
                                      'ewallet_used_by' => 'Virtual Wallet',
                                      'current_url'  => 'https://'
                              ]);

              return back()->with(['message' => 'Fund has been tranfered','type' => 'success']);
        }

        else {
              return back()->with(['message' => 'Insufficient Fund','type' => 'error']);
        }

      }
      else {
            return back()->with(['message' => 'Receiver Not found','type' => 'error']);
      }
    }
    else {

        return back()->with(['message' => 'Incorrect Transaction Password','type' => 'error']);
    }



}

public function historyView(Request $request){
    $wallet     = $request->input('wallet');
    $date_from  = $request->input('date_from');
    $date_to    = $request->input('date_to');
    if(!empty($wallet) ) {
        if($wallet ='all') {

              if(!empty($date_from) && !empty($date_to) ) {
                    $result = DB::table('credit_debit')
                              ->where('ttype','Fund Transfer')
                              ->where('user_id',Auth::user()->user_id)
                              ->where('receive_date','>=',$date_from)
                              ->where('receive_date','<=',$date_to)
                              ->orderBy('id','desc')
                              ->get();

                    return view('wallet.history',compact('result'));
              }
              else {
                      $result = DB::table('credit_debit')
                          ->where('ttype','Fund Transfer')
                          ->where('user_id',Auth::user()->user_id)
                          ->orderBy('id','desc')
                          ->get();

                        return view('wallet.history',compact('result'));
              }

        }
        else {
                      if(!empty($date_from) && !empty($date_to) ) {
                            $result = DB::table('credit_debit')
                                      ->where('ttype','Fund Transfer')
                                      ->where('user_id',Auth::user()->user_id)
                                      ->where('receive_date','>=',$date_from)
                                      ->where('receive_date','<=',$date_to)
                                      ->where('ewallet_used_by',$wallet)
                                      ->orderBy('id','desc')
                                      ->get();

                            return view('wallet.history',compact('result'));
                      }
                      else {
                              $result = DB::table('credit_debit')
                                  ->where('ttype','Fund Transfer')
                                  ->where('user_id',Auth::user()->user_id)
                                  ->where('ewallet_used_by',$wallet)
                                  ->orderBy('id','desc')
                                  ->get();
                                return view('wallet.history',compact('result'));
                      }

        }

    }
    else {

        $result = DB::table('credit_debit')
                  ->where('ttype','Fund Transfer')
                  ->where('user_id',Auth::user()->user_id)
                  ->get();
                return view('wallet.history',compact('result'));
    }

}
  public function getBalance(Request $request) {
       $from_wallet  = $request->input('from_wallet');

       $balance = DB::table($from_wallet)
                  ->where('user_id',Auth::user()->user_id)
                  ->sum('amount');

          return response()->json(number_format($balance,2));
  }
    public function getReceiver(Request $request) {
       $user_id  = $request->input('user');

       $user = DB::table('user_registration')
                  ->where('user_id',$user_id)
                  ->orWhere('username',$user_id)
                  ->orWhere('email',$user_id)
                  ->first(['username' ]);
        if($user_id !="") {
            if($user) {
                    return response()->json($user->username);
            }

            else {
                  return response()->json('User not found');
            }
        }
        else {
              return response()->json('Select receiver');
        }



  }

  public function fundTransfer(Request $request){

        $amount      = $request->input('amount');
        $from_wallet = $request->input('from_wallet') ;
        $to_wallet   = $request->input('to_wallet');
        $wallet = " " ;
        $wallet_from = " " ;

        if($from_wallet =='final_e_wallet') {
          $wallet_from = 'E Wallet' ;
        }
        if($from_wallet =='final_r_wallet') {
          $wallet_from = 'R Wallet' ;
        }
        if($to_wallet =='final_r_wallet') {
          $wallet = 'R Wallet' ;
        }
        if($to_wallet =='final_forex_wallet') {
          $wallet = 'Forex Wallet' ;
        }
        if($to_wallet =='final_lotto_wallet') {
            $wallet = 'Lotto Wallet';
        }
      if(!empty($amount) && !empty($from_wallet) && !empty($to_wallet) ) {
        $balance = DB::table($from_wallet)
                   ->where('user_id',Auth::user()->user_id)
                   ->sum('amount');
                  if($amount <= $balance) {

                        $urls = "httpps://app.xinrox.com/internaltransfer/transfer";
                        $invoice_no  = rand(11111111,9999999);
                          DB::table($from_wallet)
                                     ->where('user_id',Auth::user()->user_id)
                                     ->decrement('amount',$amount);
                          DB::table($to_wallet)
                                        ->where('user_id',Auth::user()->user_id)
                                        ->increment('amount',$amount);

                                    DB::table('credit_debit')
                                              ->insert([
                                                      'transaction_no' => $invoice_no,
                                                      'user_id' => Auth::user()->user_id,
                                                      'credit_amt' => 0,
                                                      'debit_amt' => $amount,
                                                      'admin_charge' => 0,
                                                      'receiver_id' => Auth::user()->user_id,
                                                      'sender_id' => Auth::user()->user_id,
                                                      'receive_date' => date('Y-m-d'),
                                                      'ttype' => 'Fund Tranfer',
                                                      'TranDescription' => 'Interwallet tranfer by : '. Auth::user()->user_id . 'with an amount of ' .$amount  ,
                                                      'Cause' => 'Fund Tranfer by '. Auth::user()->user_id,
                                                      'Remark'    => 'Fund Tranfer',
                                                      'invoice_no' => $invoice_no,
                                                      'product_name' => 'Fund Tranfer',
                                                      'status'  => 0,
                                                      'ewallet_used_by' => $wallet_from,
                                                      'current_url'  => $urls
                                              ]);
                                              DB::table('credit_debit')
                                                        ->insert([
                                                                'transaction_no' => $invoice_no,
                                                                'user_id' => Auth::user()->user_id,
                                                                'credit_amt' => $amount,
                                                                'debit_amt' => 0,
                                                                'admin_charge' => 0,
                                                                'receiver_id' => Auth::user()->user_id,
                                                                'sender_id' => Auth::user()->user_id,
                                                                'receive_date' => date('Y-m-d'),
                                                                'ttype' => 'Fund Tranfer',
                                                                'TranDescription' => 'Interwallet tranfer by : '. Auth::user()->user_id . 'with an amount of ' .$amount  ,
                                                                'Cause' => 'Fund Tranfer by '. Auth::user()->user_id,
                                                                'Remark'    => 'Fund Tranfer',
                                                                'invoice_no' => $invoice_no,
                                                                'product_name' => 'Fund Tranfer',
                                                                'status'  => 0,
                                                                'ewallet_used_by' => $wallet,
                                                                'current_url'  => $urls
                                                        ]);

                           $response_data =  ['type' => 'success' ,'message' => 'Fund has been successfully transfered'] ;


                      }
                  else {

                       $response_data =  ['type' => 'error' ,'message' => 'Balance Not Enough'] ;
                  }
      }

      else {
             $response_data =  ['type' => 'error' ,'message' => 'All field are required'] ;

      }

        return response()->json($response_data);
  }


  public function externalfundTransfer(Request $request){
        $amount      = $request->input('amount');
        $from_wallet = $request->input('from_wallet') ;
        $to_wallet   = $request->input('to_wallet');
        $user         = $request->input('user');
        $wallet = " " ;
        $wallet_from = " " ;

        if($from_wallet =='final_r_wallet') {
          $wallet_from = 'R Wallet' ;
        }
        if($from_wallet =='final_forex_wallet') {
          $wallet_from = 'Forex Wallet' ;
        }
        if($from_wallet =='final_lotto_wallet') {
            $wallet_from = 'Lotto Wallet';
        }
        if($from_wallet =='final_lapin_wallet') {
            $wallet_from = 'Virtual Wallet';
        }

        if($to_wallet =='final_r_wallet') {
          $wallet = 'R Wallet' ;
        }
        if($to_wallet =='final_forex_wallet') {
          $wallet = 'Forex Wallet' ;
        }
        if($to_wallet =='final_lotto_wallet') {
            $wallet = 'Lotto Wallet';
        }
        if($to_wallet =='final_lapin_wallet') {
            $wallet = 'Virtual Wallet';
        }



      if(!empty($amount) && !empty($from_wallet) && !empty($to_wallet) ) {
          $balance = DB::table($from_wallet)
                   ->where('user_id',Auth::user()->user_id)
                   ->sum('amount');

                   $receiver = DB::table('user_registration')
                              ->where('user_id',$user)
                              ->orWhere('username',$user)
                              ->orWhere('email',$user)
                              ->first(['user_id']);
                  if($amount <= $balance) {
                      if(count($receiver) > 0 ) {
                        $urls = "httpps://app.xinrox.com/internaltransfer/transfer";
                        $invoice_no  = rand(11111111,9999999);
                          DB::table($from_wallet)
                                     ->where('user_id',Auth::user()->user_id)
                                     ->decrement('amount',$amount);
                          DB::table($to_wallet)
                                        ->where('user_id',$receiver->user_id)
                                        ->increment('amount',$amount);

                                    DB::table('credit_debit')
                                              ->insert([
                                                      'transaction_no' => $invoice_no,
                                                      'user_id' => Auth::user()->user_id,
                                                      'credit_amt' => 0,
                                                      'debit_amt' => $amount,
                                                      'admin_charge' => 0,
                                                      'receiver_id' => $receiver->user_id,
                                                      'sender_id' => Auth::user()->user_id,
                                                      'receive_date' => date('Y-m-d'),
                                                      'ttype' => 'Fund Tranfer',
                                                      'TranDescription' => 'Interwallet tranfer by : '. Auth::user()->user_id . 'with an amount of ' .$amount  ,
                                                      'Cause' => 'Fund Tranfer by '. Auth::user()->user_id,
                                                      'Remark'    => 'Fund Tranfer',
                                                      'invoice_no' => $invoice_no,
                                                      'product_name' => 'Fund Tranfer',
                                                      'status'  => 0,
                                                      'ewallet_used_by' => $wallet_from,
                                                      'current_url'  => $urls
                                              ]);
                                              DB::table('credit_debit')
                                                        ->insert([
                                                                'transaction_no' => $invoice_no,
                                                                'user_id' => $receiver->user_id,
                                                                'credit_amt' => $amount,
                                                                'debit_amt' => 0,
                                                                'admin_charge' => 0,
                                                                'receiver_id' => $receiver->user_id,
                                                                'sender_id' => Auth::user()->user_id,
                                                                'receive_date' => date('Y-m-d'),
                                                                'ttype' => 'Fund Tranfer',
                                                                'TranDescription' => 'Interwallet tranfer by : '. Auth::user()->user_id . 'with an amount of ' .$amount  ,
                                                                'Cause' => 'Fund Tranfer by '. Auth::user()->user_id,
                                                                'Remark'    => 'Fund Tranfer',
                                                                'invoice_no' => $invoice_no,
                                                                'product_name' => 'Fund Tranfer',
                                                                'status'  => 0,
                                                                'ewallet_used_by' => $wallet,
                                                                'current_url'  => $urls
                                                        ]);

                           $response_data =  ['type' => 'success' ,'message' => 'Fund has been successfully transfered'] ;

                        }

                        else {
                          $response_data =  ['type' => 'error' ,'message' => 'Receiver not found'] ;

                        }
                      }
                  else {

                       $response_data =  ['type' => 'error' ,'message' => 'Balance Not Enough'] ;
                  }
      }

      else {
             $response_data =  ['type' => 'error' ,'message' => 'All field are required'] ;

      }

        return response()->json($response_data);
  }

  public function widthdrawals() {
        $withdrawals = DB::table('withdraw_request')
                                ->where('user_id',Auth::user()->user_id)
                                ->paginate(10);

        return view('withdrawals.index',compact('withdrawals'));

  }
  public function withdrawNow(Request $request) {
        $amount = $request->input('amount');
        $trans_code = $request->input('t_code');
        $balance = DB::table('final_e_wallet')
                 ->where('user_id',Auth::user()->user_id)
                 ->sum('amount');
  if($amount >=25) {
          if($amount <= $balance) {

            if($trans_code == Auth::user()->t_code) {
            $urls = "httpps://app.xinrox.com/withdraw";
            $invoice_no  = rand(11111111,9999999);

                        DB::table('final_e_wallet')
                                ->where('user_id', Auth::user()->user_id)
                                ->decrement('amount',$amount);

                        DB::table('credit_debit')
                                  ->insert([
                                          'transaction_no' => $invoice_no,
                                          'user_id' => Auth::user()->user_id,
                                          'credit_amt' => 0,
                                          'debit_amt' => $amount,
                                          'admin_charge' => 0,
                                          'receiver_id' => Auth::user()->user_id,
                                          'sender_id' => Auth::user()->user_id,
                                          'receive_date' => date('Y-m-d'),
                                          'ttype' => 'Withdrawal',
                                          'TranDescription' => 'Withdraw  fund by : '. Auth::user()->user_id . 'with an amount of ' .$amount  ,
                                          'Cause' => 'Fund Tranfer by '. Auth::user()->user_id,
                                          'Remark'    => 'Withdrawal',
                                          'invoice_no' => $invoice_no,
                                          'product_name' => 'Withdrawal',
                                          'status'  => 0,
                                          'ewallet_used_by' => 'E Wallet',
                                          'current_url'  => $urls
                                  ]);

                            DB::table('withdraw_request')
                                  ->insert([
                                              'transaction_number'    => $invoice_no,
                                              'user_id'               => Auth::user()->user_id,
                                              'first_name'            => 'N/A',
                                              'last_name'             => 'N/A',
                                              'acc_name'              => 'N/A',
                                              'acc_number'            => 'N/A',
                                              'bank_nm'               => 'N/A',
                                              'branch_nm'             => 'N/A',
                                              'swift_code'            => 'N/A',
                                              'request_amount'        => $amount,
                                              'status'                => 1,
                                              'admin_remark'          =>  'NO REMARKS YET',
                                              'description'           => 'Withdrawal',
                                              'posted_date'           => date('Y-m-d'),
                                              'withdraw_wallet'       =>  'E Wallet',
                                              'total_paid_amount'     => $amount ,
                                              'transaction_charge'    => 0,
                                              'type'                  => $request->input('type')
                                          ]);

                                  $response_data =  ['type' => 'success' ,'message' => 'Withdrawal successfully Submitted'] ;
                    }
                    else {
                            $response_data =  ['type' => 'error' ,'message' => 'Incorrect Transaction Password'] ;
                    }
          }
          else {

                  $response_data =  ['type' => 'error' ,'message' => 'Not enough balance'] ;

          }
        }
        else {
                $response_data =  ['type' => 'error' ,'message' => 'Minimum amount is 25 USD'] ;
        }

        return response()->json($response_data);
  }

}
