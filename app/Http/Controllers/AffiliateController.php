<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class AffiliateController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index() {

     $topearnings = DB::table('credit_debit')
                            ->whereMonth('receive_date', '=', date('m'))
                            ->where('id' ,'>', 344)
                            ->where('ttype','Referral Income')
                            ->orWhere('ttype','Binary Income')
                            ->orWhere('ttype','Leadership Income')
                            ->orWhere('ttype','Promotional Income')
                            ->orWhere('ttype','Profit Share Income')
                            ->orWhere('ttype','Turnover Income')
                            ->orWhere('ttype','Compound Wallet Income')
                            ->select('credit_debit.user_id as user_id', DB::raw('sum(credit_amt) as amount'))
                            ->groupBy('credit_debit.user_id')
                            ->orderBy('amount','desc')
                            ->limit(10)
                            ->paginate(5);




     return view('affiliates.index',compact('topearnings'));
  }
}
