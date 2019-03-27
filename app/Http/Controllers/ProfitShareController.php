<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class ProfitShareController extends Controller
{
    public function makeSchedule() {



      $subscriptions = DB::table('lifejacket_subscription')->get();


      foreach ($subscriptions as $key => $value) {

            $countSubs = DB::table('compounding_distribution')
                          ->where('user_id',$value->user_id)
                          ->where('portfolio_id',$value->lifejacket_id)
                          ->count('id');
          if($countSubs < 1) {

            $profit  =  $value->amount * (10/100);

            for($i = 1 ; $i <= 20 ;$i++) {

  						//$st = $st + 30 ;
  						$end = date('Y-m-d', strtotime($value->date.'+'.$i. 'months'));
                      DB::table('compounding_distribution')
                              ->insert([

                                        'user_id'       => $value->user_id ,
                                        'portfolio_id'  => $value->lifejacket_id,
                                        'amoumt'        => $profit,
                                        'date'          => $end,
                                        'status'        => 0
                              ]);
                }
          }
      }
    }

    public function claimProfit() {

            $data = DB::table('compounding_distribution')
                    ->where('date',date('Y-m-d'))
                    ->where('status',0)
                    ->get();

              foreach ($data as $key => $value) {

                    $amount       = $value->amoumt ;
                    $commission   = $amount - ($amount * 10/100);

                    $invoice_no = rand(1111111,99999);

                    DB::table('final_e_wallet')
                          ->where('user_id',$value->user_id)
                          ->increment('amount',$commission);


                          DB::table('credit_debit')
                                ->insert([
                                        'transaction_no' => $invoice_no,
                                        'user_id' => $value->user_id,
                                        'credit_amt' => $commission,
                                        'debit_amt' => 0,
                                        'admin_charge' => 0,
                                        'receiver_id' => $value->user_id,
                                        'sender_id' => '888888',
                                        'receive_date' => date('Y-m-d'),
                                        'ttype' => 'Profit Share Income',
                                        'TranDescription' => 'Profit Sharing Bonus for the month of '. date('F',strtotime($value->date)),
                                        'Cause' => 'Profit Sharing Bonus ',
                                        'Remark'    => 'Profit Sharing Bonus',
                                        'invoice_no' => $invoice_no,
                                        'product_name' => 'Profit Sharing Bonus',
                                        'status'  => 0,
                                        'ewallet_used_by' => 'E Wallet',
                                        'current_url'  => 'https://'
                                ]);

                        DB::table('compounding_distribution')
                              ->where('id',$value->id)
                              ->update(['status' => 1]);

              }

    }

    public function claimTodayProfit() {

            $data = DB::table('compounding_distribution')
                    ->where('date','<',date('Y-m-d'))
                    ->where('status',0)
                    ->get();

              foreach ($data as $key => $value) {

                    $amount       = $value->amoumt ;
                    $commission   = $amount - ($amount * 10/100);

                    $invoice_no = rand(1111111,99999);

                    DB::table('final_e_wallet')
                          ->where('user_id',$value->user_id)
                          ->increment('amount',$commission);


                          DB::table('credit_debit')
                                ->insert([
                                        'transaction_no' => $invoice_no,
                                        'user_id' => $value->user_id,
                                        'credit_amt' => $commission,
                                        'debit_amt' => 0,
                                        'admin_charge' => 0,
                                        'receiver_id' => $value->user_id,
                                        'sender_id' => '888888',
                                        'receive_date' => date('Y-m-d'),
                                        'ttype' => 'Profit Sharing Bonus',
                                        'TranDescription' => 'Profit Sharing Bonus for the month of '. date('F',strtotime($value->date)),
                                        'Cause' => 'Profit Sharing Bonus ',
                                        'Remark'    => 'Profit Sharing Bonus',
                                        'invoice_no' => $invoice_no,
                                        'product_name' => 'Profit Sharing Bonus',
                                        'status'  => 0,
                                        'ewallet_used_by' => 'E Wallet',
                                        'current_url'  => 'https://'
                                ]);

                        DB::table('compounding_distribution')
                              ->where('id',$value->id)
                              ->update(['status' => 1]);

              }

    }

  public function matchingCommission(){
      $urls = "https://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
      $useridss = 888888;
      $date = date('Y-m-d');
      $date1 = date('Y-m-d', strtotime($date . ' + 1 days'));
      $users = DB::table('user_registration')
              ->where('user_status',0)
              ->where('nom_id','!=','')
              ->get();

      foreach ($users as $key => $value) {
            	$uid = $value->user_id;
              $leftamt  = DB::table('manage_bv_history')
                            ->where('status',0)
                            ->where('income_id',$uid)
                            ->where('position','left')
                            ->where('date','<',$date1)
                            ->sum('pair');

              $rightamt  = DB::table('manage_bv_history')
                            ->where('status',0)
                            ->where('income_id',$uid)
                            ->where('position','right')
                            ->where('date','<',$date1)
                            ->sum('pair');


              if ($leftamt <= $rightamt) {
                		$lesser_bv = $leftamt;
                		$carry = $rightamt - $leftamt;
                		$pos = 'right';
                	} else {
                		$lesser_bv = $rightamt;
                		$carry = $leftamt - $rightamt;
                		$pos = 'left';
                }

            $userpack   = DB::table('lifejacket_subscription')->where('user_id',$uid)->sum('amount');
            $capping1   = $userpack * 4;
          	$lesser_bv  = $lesser_bv;
          	$carry      = $carry;

            if ($carry > 0) {
                    DB::table('manage_bv_history')
                          ->insert([
                                'income_id'     => $uid,
                                'downline_id'   => $uid,
                                'level'         => 1,
                                'bv'            => 0,
                                'position'      => $pos,
                                'description'   => 'Carry Forward BV',
                                'date'          => $date1,
                                'status'        => 0,
                                'pair'          => $carry

                          ]);
            	}

              if ($lesser_bv > 0) {

                      $amount = $lesser_bv * (8 / 100);

                      if ($amount > $capping1) {
                            $amount = $capping1;
                      } else {
                            $amount = $amount;
                      }

                      if ($amount > 0) {

                        $invoice_no = $uid . rand(1001, 9999);
                        $withdrawal_commission = $amount;

                        $withdrawal_commission1 = $amount;

                        $withdrawal_commission = $withdrawal_commission1 - ($withdrawal_commission1 * 0.1);

                        $rwallets = $withdrawal_commission * 80 / 100;
                        $rwallets1 = $withdrawal_commission * 20 / 100;

                        $rwalletss = $rwallets * 0 / 100;
                        $rwalletss1 = $rwallets1 * 0 / 100;


                        $rwallet = $rwallets - $rwalletss;
                        $rwallet1 = $rwallets1 - $rwalletss1;


                        if ($withdrawal_commission != '' && $withdrawal_commission != 0) {

                          $urls = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];


                          DB::table('final_e_wallet')->where('user_id',$uid)->increment('amount',$rwallet);
                          DB::table('final_forex_wallet')->where('user_id',$uid)->increment('amount',$rwallet1);

                                                    DB::table('credit_debit')
                                                          ->insert([
                                                                  'transaction_no' => $invoice_no,
                                                                  'user_id' => $uid,
                                                                  'credit_amt' => $rwallet,
                                                                  'debit_amt' => 0,
                                                                  'admin_charge' => 0,
                                                                  'receiver_id' => $uid,
                                                                  'sender_id' => '888888',
                                                                  'receive_date' => $date,
                                                                  'ttype' => 'Binary Income',
                                                                  'TranDescription' => 'Binary Income',
                                                                  'Cause' => 'Binary Income',
                                                                  'Remark'    => 'Binary Income',
                                                                  'invoice_no' => $invoice_no,
                                                                  'product_name' => 'Binary Income',
                                                                  'status'  => 0,
                                                                  'ewallet_used_by' => 'E Wallet',
                                                                  'current_url'  => $urls
                                                          ]);
                                                          DB::table('credit_debit')
                                                                ->insert([
                                                                        'transaction_no' => $invoice_no,
                                                                        'user_id' => $uid,
                                                                        'credit_amt' => $rwallet1,
                                                                        'debit_amt' => 0,
                                                                        'admin_charge' => 0,
                                                                        'receiver_id' => $uid,
                                                                        'sender_id' => '888888',
                                                                        'receive_date' => $date,
                                                                        'ttype' => 'Binary Income',
                                                                        'TranDescription' => 'Binary Income',
                                                                        'Cause' => 'Binary Income',
                                                                        'Remark'    => 'Binary Income',
                                                                        'invoice_no' => $invoice_no,
                                                                        'product_name' => 'Binary Income',
                                                                        'status'  => 0,
                                                                        'ewallet_used_by' => 'Forex Wallet',
                                                                        'current_url'  => $urls
                                                                ]);
                        }
                      } else {
                      }
                    } else {}
      }
        DB::table('manage_bv_history')->where('date','<',$date1)
                                        ->update(['status' => 1]);
    }
}
