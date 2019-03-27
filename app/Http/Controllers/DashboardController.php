<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class DashboardController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index() {

    if(Auth::user()->is_admin == 0) {
        $userplan        = DB::table('user_registration')->where('user_id', Auth::user()->user_id)->first(['user_plan']);
        $recent5_history = DB::table('credit_debit')->where('user_id', Auth::user()->user_id)->orderBy('id','desc')->take(5)->get();

        return view('dashboard.index',compact('userplan','recent5_history'));
    }

    else {

      return redirect('admin/dashboard');
    }

  }

  public function getWalletBalances() {


    $rwallet    = DB::table('final_r_wallet')->where('user_id', Auth::user()->user_id)->first(['amount']);
    $vwallet    = DB::table('final_apin_wallet')->where('user_id', Auth::user()->user_id)->first(['amount']);
    $ewallet    = DB::table('final_e_wallet')->where('user_id', Auth::user()->user_id)->first(['amount']);
    $comwallet  = DB::table('final_compounding_wallet')->where('user_id', Auth::user()->user_id)->first(['amount']);
    $fwallet    = DB::table('final_forex_wallet')->where('user_id', Auth::user()->user_id)->first(['amount']);
    $lwallet    = DB::table('final_lotto_wallet')->where('user_id', Auth::user()->user_id)->first(['amount']);

      $wallets       = [
                        'rwallet' => number_format($rwallet->amount,2),
                        'virtualwallet' => number_format($vwallet->amount,2),
                        'ewallet' => number_format($ewallet->amount,2),
                        'compounding' => number_format($comwallet->amount,2),
                        'forexwallet' => number_format($fwallet->amount,2),
                        'lottowallet' => number_format($lwallet->amount,2),
                ];

                return response()->json($wallets);

  }

  public function getIncomes() {

      $total_income  = DB::table('credit_debit')
                                  ->where('user_id', Auth::user()->user_id)
                                  ->whereIn('ttype',['Binary Income' ,'Referral Income','Profit Share Income'])
                                  ->sum('credit_amt');

      $direct_income  = DB::table('credit_debit')
                            ->where('user_id', Auth::user()->user_id)
                            ->where('ttype','Referral Income')
                            ->sum('credit_amt');
      $matching_income  = DB::table('credit_debit')
                            ->where('user_id', Auth::user()->user_id)
                            ->where('ttype','Binary Income')
                            ->sum('credit_amt');
     $profit_share_income  = DB::table('credit_debit')
                            ->where('user_id', Auth::user()->user_id)
                            ->where('ttype','Profit Share Income')
                            ->sum('credit_amt');
     $leadership_income = DB::table('credit_debit')
                            ->where('user_id', Auth::user()->user_id)
                            ->where('ttype','Leadership Income')
                            ->sum('credit_amt');

    $incomes = [
                    'total_income'        => number_format($total_income,2),
                    'direct_income'       => number_format($direct_income,2),
                    'matching_income'     => number_format($matching_income,2),
                    'profit_share_income' => number_format($profit_share_income,2),
                    'leadership_income'   => number_format($leadership_income,2)
              ] ;

              return response()->json($incomes);
  }

  public function getDownlines() {

        $direct_donwlines =  DB::table('user_registration')
                              ->where('ref_id', Auth::user()->user_id)
                              ->count('user_id');

        $left_downlines   = DB::table('level_income_binary')
                              ->where('income_id', Auth::user()->user_id)
                              ->where('leg','left')
                              ->count('down_id');

        $right_downlines   = DB::table('level_income_binary')
                                ->where('income_id', Auth::user()->user_id)
                                ->where('leg','right')
                                ->count('down_id');
          $downlines  = [
                          'direct_donwlines'  => number_format($direct_donwlines) ,
                          'left_downlines'    => number_format($left_downlines),
                          'right_downlines'   => number_format($right_downlines)
                      ];
          return response()->json($downlines);
  }
  public function getMatchingPoints ()  {

            $left_points  =  DB::table('manage_bv_history')
                                  ->where('income_id', Auth::user()->user_id)
                                  ->where('position','left')
                                  ->where('status','0')
                                  ->sum('pair');

            $right_points  =  DB::table('manage_bv_history')
                                  ->where('income_id', Auth::user()->user_id)
                                  ->where('position','right')
                                  ->where('status','0')
                                  ->sum('pair');

            $matching_points = [

                            'left_points'  => $left_points,
                            'right_points' => $right_points
                      ];

            return response()->json($matching_points);

  }

}
