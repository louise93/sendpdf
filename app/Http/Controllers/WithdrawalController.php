<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;

class WithdrawalController extends Controller
{
  public function __construct() {
      $this->middleware('auth');
  }

  public function openWithdrawals() {

      $result = DB::table('withdraw_request')
              ->where('user_id',Auth::user()->user_id)
              ->where('status',0)
              ->orderBy('id','desc')
              ->get();
      return view('withdrawals.index',compact('result'));
  }
  public function closeWithdrawals() {

      $result = DB::table('withdraw_request')
              ->where('user_id',Auth::user()->user_id)
              ->where('status','>',0)
              ->orderBy('id','desc')
              ->get();
      return view('withdrawals.close',compact('result'));
  }

  public function portfolio() {

    $result = DB::table('lifejacket_subscription')
            ->where('user_id',Auth::user()->user_id)
            ->orderBy('id','desc')
            ->get();
    return view('withdrawals.portfolio',compact('result'));

  }
}
