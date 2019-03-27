<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Session;
class ContactController extends Controller
{
  public function __construct(){

      $this->middleware('auth');
  }

  public function index(){

    return view('downlines.contacts');
  }

  public function getDownlines(Request $request){

          $downlines = DB::table('matrix_downline')
                              ->join('user_registration','matrix_downline.down_id','=','user_registration.user_id')
                              ->where('matrix_downline.income_id',Auth::user()->user_id)
                              ->select('user_registration.*')
                              ->get();
            return response()->json($downlines);


  }
  public function searchDownline(Request $request) {
    $user_id = $request->input('user_id');
    $downlines = DB::table('matrix_downline')
                        ->join('user_registration','matrix_downline.down_id','=','user_registration.user_id')
                        ->where('matrix_downline.income_id',Auth::user()->user_id)
                        ->where('matrix_downline.down_id',$user_id)
                        ->orWhere('user_registration.username',$user_id)
                        ->select('user_registration.*')
                        ->get();
      return response()->json($downlines);

  }
  public function getInfo(Request $request) {

        $user_id = $request->input('user_id');
        $name   = DB::table('user_registration')->where('user_id',$user_id)->first(['first_name','last_name','address']);
        $package = DB::table('lifejacket_subscription')->where('user_id',$user_id)->sum('amount');
        $rwallet = DB::table('final_r_wallet')->where('user_id',$user_id)->first(['amount'])->amount;
        $ewallet = DB::table('final_e_wallet')->where('user_id',$user_id)->first(['amount'])->amount;
        $virualwallet = DB::table('final_apin_wallet')->where('user_id',$user_id)->first(['amount'])->amount;
        $forexwallet = DB::table('final_forex_wallet')->where('user_id',$user_id)->first(['amount'])->amount;

          $data  =  [

                    'name'           => $name->first_name . ' ' . $name->last_name,
                    'address'        => $name->address,
                    'package'        => number_format($package,2),
                    'ewallet'        => number_format($ewallet,2),
                    'rwallet'        => number_format($rwallet,2),
                    'virtualwallet'  => number_format($virualwallet,2),
                    'forexwallet'    => number_format($forexwallet,2)


          ];

          return response()->json($data);

  }
}
