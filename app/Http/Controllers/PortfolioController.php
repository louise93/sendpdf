<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class PortfolioController extends Controller
{
  public function __construct(){

      $this->middleware('auth');
  }
  public function index() {
      $portfolio = DB::table('lifejacket_subscription')
                    ->where('user_id',Auth::user()->user_id)
                    ->get();
      return view('portfolio.index',compact('portfolio'));
  }
  public function compounding() {

      $compounding = DB::table('compounding_monthly_history')
                    ->where('user_id',Auth::user()->user_id)
                    ->get();
      return view('portfolio.compounding',compact('compounding'));
  }
}
