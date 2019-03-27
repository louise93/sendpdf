<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;
use Session;
use Validator;
use Hash;
use Mail;
use App\Mailers\AppMailer;
use App\Notifications\Registration;
class RegistrationController extends Controller
{
  // public function __construct()
  // {
  //     $this->middleware('auth');
  // }
  public function register($pl_id , $sponsor_id , $position) {

      return view('genealogy.registration',compact('pl_id','sponsor_id','position'));

  }

  public function postAccount(Request $request) {

    $username   = $request->input('username');
    $first_name = $request->input('first_name');
    $last_name  = $request->input('last_name');
    $pl_id      = $request->input('pl_id');
    $positions  = $request->input('position') ;
    $sponsor_id = $request->input('sponsor_id');
    $email      = $request->input('email');
    $package    = $request->input('package');
    $payment_type = $request->input('payment_type');

    $packages = ['','100','200','1000','3000','5000'];
    $response_data =  ['type' => 'success' ,'message' => ''] ;
    $position = (!empty($positions) ? $positions : $this->member_position($sponsor_id));
    $data       = [
                    'username'    => $username,
                    'first_name'  => $first_name,
                    'last_name'   => $last_name,
                    'email'       => $email,
                    'package'     => $package,
                    'payment_type' => $payment_type
                  ];
    $rules =  [
                'username'  => 'required|max:6|unique:user_registration',
                'first_name'  => 'required',
                'last_name'   => 'required' ,
                'package'     => 'required',
                'payment_type'  => 'required',
                'email'         => 'required|email'
            ];

     $validator = Validator::make($data, $rules);
     if ($validator->fails()) {

            $response_data =  ['type' => 'error' ,'message' => $validator->errors()->first()] ;

    }
    else {
              $user_id          =   $this->generateUserid();
              $plain_password   = str_random(8);
              $transaction_code = str_random(8);
              $password       = Hash::make($plain_password);
              $userwallet = "" ;
              $userwallet_2 = "" ;
              $percent        = 100;
              $package_amount =  $packages[$package]  / 1;
              $package_amount_second =  0 ;
              switch ($payment_type) {
                  case 'Virtual Wallet':
                        $userwallet =  'final_apin_wallet';
                        $package_amount =  $packages[$package]  / 1;
                        $userwallet_2 = "" ;
                        $package_amount_second =  0 ;
                    break;
                    case 'R Wallet' :
                          $userwallet =  'final_r_wallet';
                          $package_amount =  $packages[$package]  / 1;
                          $userwallet_2 = "" ;
                          $package_amount_second =  0 ;
                    break;
                  default:
                        $userwallet =  'final_r_wallet';
                        $package_amount =  $packages[$package]  / 2;
                        $userwallet_2 = 'final_apin_wallet' ;
                        $package_amount_second =  $packages[$package]  / 2 ;
                    break;
                }

                if($userwallet_2 == '') {
                        $wallet_balance = DB::table($userwallet)->where('user_id',Auth::user()->user_id)->sum('amount');
                        if($wallet_balance >= $package_amount ) {
                            DB::table($userwallet)->where('user_id',Auth::user()->user_id)->decrement('amount',$package_amount);

                            $row_ref=DB::table('user_registration')->where('user_id',$sponsor_id)->first(['user_id','binary_pos','username']);
                            $ref_id =$row_ref->user_id;
                            $ref_username=$row_ref->username;
                            $ref_pos=$row_ref->binary_pos;
                            $ref_id123=$ref_id;
                            //position
                            if ($position!='') {
                                 $position=$positions;
                            }else{
                                $position=$this->member_position($ref_id123);
                            }
                            $nom_id123 = $sponsor_id;
                            //spill over
                            if($nom_id123!='')
                            {
                              $nom_id123=$this->spillOverMember($ref_id123,$position);
                            }
                            else
                            {
                              $nom_id123=$this->spillOverMember($ref_id123,$position);
                            }

                            $row_refing=DB::table('user_registration')->where('user_id',$nom_id123)->first(['user_id']);
                            $nom_id1=$row_refing->user_id;
                            $nom_id=$nom_id1;
                                    DB::table('user_registration')
                                              ->insert([
                                                          'user_id'         => $user_id,
                                                          'username'        => $username,
                                                          'ref_id'          => $sponsor_id,
                                                          'nom_id'          => $nom_id,
                                                          'first_name'      => $first_name,
                                                          'email'           => $email,
                                                          'last_name'       => $last_name,
                                                          'binary_pos'      => $position ,
                                                          'user_plan'       => $package,
                                                          'password'        => $password,
                                                          't_code'          => $transaction_code,
                                                          'registration_date'=> date('Y-m-d'),
                                                          'address'         => 'NOT SET',
                                                          'country'         => 'NOT SET',
                                                          'city'            => 'NOT SET',
                                                          'zipcode'         => 'NOT SET',
                                                          'telephone'       => 'NOT SET',
                                                          'admin_status'    => 0,
                                                          'designation'     => 'NOT SET',
                                                          'designation'     => 'NOT SET',
                                                          'aboutus'         => 'NOT SET',
                                                          'dob'             => 'NOT SET',
                                                          'state'          => 'NOT SET',
                                                          'sex'             => 'NOT SET',
                                                          'image'           => 'NOT SET',
                                                          'acc_name'        => 'NOT SET',
                                                          'ac_no'           => 'NOT SET',
                                                          'bank_nm'         => 'NOT SET',
                                                          'branch_nm'       => 'NOT SET',
                                                          'swift_code'      => 'NOT SET',
                                                          'user_rank_name'  => 'Affiliate',
                                                          'merried_status'  => 'NOT SET',
                                                          'last_login_date' => date('Y-m-d'),
                                                          'current_login_date' => date('Y-m-d'),
                                                          'id_card'         => 'NOT SET',
                                                          'id_no'           => 'NOT SET',
                                                          'master_account'  => 'NOT SET',
                                                          'issued'          => 'NOT SET',
                                                          'product_type'    => 'NOT SET',
                                                          'admin_remark1'   => 'NOT SET',
                                                          'nom_name'        => 'NOT SET',
                                                          'nom_relation'    => 'NOT SET',
                                                          'nom_mobile'      => 'NOT SET',
                                                          'bank_state'      => 'NOT SET',
                                                          'ben_fullname'    => 'NOT SET',
                                                          'ben_nric'        => 'NOT SET',
                                                          'gtb_wallet_address' => 'NOT SET',
                                                          'ref_count'       => 0,
                                                          'user_status'     => 0,
                                                          'issue_date'      => date('Y-m-d'),
                                                          'nom_dob'         => 'NOT SET',

                                                        ]);
                                    $l=1;
                                    $pos   = $position;
                                    $nom=$nom_id;
                                    while($nom!='cmp'){
                                      if($nom!='cmp'){

                                              DB::table('level_income_binary')
                                                      ->insert([
                                                                  'down_id'   => $user_id,
                                                                  'income_id' => $nom ,
                                                                  'leg'       => $pos,
                                                                  'l_date'    => date('Y-m-d'),
                                                                  'status'    => 0 ,
                                                                  'level'     => $l
                                                      ]);
                                              $l++;
                                              $fetchnompos=DB::table('user_registration')->where('user_id',$nom)->first(['binary_pos','nom_id']);
                                              $pos=$fetchnompos->binary_pos;
                                              $nom=$fetchnompos->nom_id;
                                        }
                                    }
                                  $urls="http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];


                          				$startdate=date('Y-m-d');
                          		    $enddate = date('Y-m-d', strtotime('+15 months'));

                          			  $comm = DB::table('status_maintenance')->where('id',$package)->first(['sponsor_commission','pb','returns']);
                                  $sponsor_benifit_bonus=$comm->sponsor_commission;
                          				$pb=$comm->pb;
                          				$returns=$comm->returns;
                                  if($payment_type == 'Virtual Wallet') {
                                      $pb = 0 ;
                                  }

                                  $rand = rand(0000001,9999999);
                                  $invoice_no=$user_id.$rand;
                                  $lfid="LJ".$user_id.$rand;

                                 //WALLETS
                                  DB::table('final_e_wallet')
                                              ->insert([
                                                        'user_id' => $user_id,
                                                        'amount'  =>  0,
                                                        'status'  => 0
                                                      ]);
                                DB::table('final_apin_wallet')
                                                  ->insert([
                                                          'user_id' => $user_id,
                                                          'amount'  =>  0,
                                                          'status'  => 0
                                                          ]);
                                DB::table('final_r_wallet')
                                                    ->insert([
                                                              'user_id' => $user_id,
                                                              'amount'  =>  0,
                                                              'status'  => 0
                                                          ]);
                                DB::table('final_compounding_wallet')
                                                      ->insert([
                                                                'user_id' => $user_id,
                                                                'amount'  =>  0,
                                                                'status'  => 0
                                                            ]);
                                DB::table('final_forex_wallet')
                                                        ->insert([
                                                                  'user_id' => $user_id,
                                                                  'amount'  =>  0,
                                                                  'status'  => 0
                                                                ]);
                                DB::table('final_lotto_wallet')
                                                        ->insert([
                                                                  'user_id' => $user_id,
                                                                  'amount'  =>  0,
                                                                  'status'  => 0
                                                                ]);
                            // PORTFOLIO
                            DB::table('lifejacket_subscription')
                                  ->insert([
                                            'user_id'       => $user_id,
                                            'package'       => $package,
                                            'amount'        => $package_amount,
                                            'pay_type'      => $payment_type,
                                            'transaction_no'=> $invoice_no,
                                            'date'          => $startdate,
                                            'expire_date'   => $enddate,
                                            'remark'        => 'Package Purchase',
                                            'status'        => 'Active',
                                            'invoice_no'    => $invoice_no ,
                                            'lifejacket_id' => $lfid,
                                            'username'      => Auth::user()->user_id,
                                            'sponsor'       => Auth::user()->username,
                                            'pb'            => $pb,
                                            'pin_no'        => $user_id
                                  ]);
                              //TRANSACTION HISTORY

                              DB::table('credit_debit')
                                    ->insert([
                                            'transaction_no' => $invoice_no,
                                            'user_id' => $user_id,
                                            'credit_amt' => 0,
                                            'debit_amt' => $package_amount,
                                            'admin_charge' => 0,
                                            'receiver_id' => $user_id,
                                            'sender_id' => $sponsor_id,
                                            'receive_date' => date('Y-m-d'),
                                            'ttype' => 'Package Purchase',
                                            'TranDescription' => 'Package Purchase by '. $user_id,
                                            'Cause' => 'Package Purchase by '. $user_id,
                                            'Remark'    => 'Package Purchase',
                                            'invoice_no' => $invoice_no,
                                            'product_name' => 'Package Purchase',
                                            'status'  => 0,
                                            'ewallet_used_by' => $payment_type,
                                            'current_url'  => $urls
                                    ]);
                                    DB::table('credit_debit')
                                          ->insert([
                                                  'transaction_no' => $invoice_no,
                                                  'user_id' => Auth::user()->user_id,
                                                  'credit_amt' => 0,
                                                  'debit_amt' => $package_amount,
                                                  'admin_charge' => 0,
                                                  'receiver_id' => $user_id,
                                                  'sender_id' => Auth::user()->user_id,
                                                  'receive_date' => date('Y-m-d'),
                                                  'ttype' => 'Package Purchase',
                                                  'TranDescription' => 'Package Purchase by '. Auth::user()->user_id,
                                                  'Cause' => 'Package Purchase by '. Auth::user()->user_id,
                                                  'Remark'    => 'Package Purchase',
                                                  'invoice_no' => $invoice_no,
                                                  'product_name' => 'Package Purchase',
                                                  'status'  => 0,
                                                  'ewallet_used_by' => $payment_type,
                                                  'current_url'  => $urls
                                          ]);
                                    /*Inserting Record of BV in manage bv table for all upliners code starts here*/
                            				    $upliners = DB::table('level_income_binary')->where('down_id',$user_id)->get();
                            				foreach($upliners as $upline){
                              				$income_id=$upline->income_id;
                              				$position=$upline->leg;
                              				$user_level=$upline->level;
                              			  DB::table('manage_bv_history')
                                                ->insert([
                                                      'income_id'     =>  $income_id,
                                                      'downline_id'   => $user_id,
                                                      'level'         => $user_level,
                                                      'bv'            => $pb,
                                                      'position'      => $position,
                                                      'date'          => date('Y-m-d'),
                                                      'description'   => 'Package Purchase Amount',
                                                      'status'        => 0 ,
                                                      'pair'          => $pb
                                                ]);
                                    }
                            			   /*Inserting Record of BV in manage bv table for all upliners code ends here*/

                            			    /*Inserting Record of BV in manage bv table for all upliners code starts here*/
                            				$nom123=$sponsor_id;
                            				$date=date('Y-m-d');
                            				$l1=1;
                            				while($nom123!='cmp'){
                            			    if($nom123!='cmp'){


                                  			    DB::table('matrix_downline')
                                                        ->insert([
                                                                  'down_id'   => $user_id,
                                                                  'income_id' => $nom123,
                                                                  'l_date'    => date('Y-m-d'),
                                                                  'status'    => 0 ,
                                                                  'level'     => $l
                                                        ]);
                                          $l1++;
                                  				$fetchnompos1=DB::table('user_registration')->where('user_id',$nom123)->first(['ref_id']);
                                  				$nom123=$fetchnompos1->ref_id;
                            				}
                            				}
                            			   /*Inserting Record of BV in manage bv table for all upliners code ends here*/

                                     $this->commission_of_referal($sponsor_id,$user_id,$pb,$invoice_no,$pb);
                                     $users = User::where('user_id',$user_id)->first();
                                     //$name  = User::where('email','louisesalas8.26@gmail.com')->first(['username']);
                                     $users->notify(new Registration('Account Registration',
                                                                      "Welcome aboard in your financial success",
                                                                      'Member ID :' . $user_id .' Username : ' .$users->username . 'Password : ' . $plain_password . ' Transaction Password : ' .$transaction_code
                                                          ));

                                    $response_data =  ['type' => 'success' ,'message' => 'New user has been registered'] ;
                        }
                        else {
                              $response_data =  ['type' => 'error' ,'message' => 'Insufficient Wallet Balance'] ;
                        }
                }
                else {
                        $wallet_balance = DB::table($userwallet)->where('user_id',Auth::user()->user_id)->sum('amount');
                        $wallet_balance2 = DB::table($userwallet_2)->where('user_id',Auth::user()->user_id)->sum('amount');

                        if($wallet_balance >= $package_amount && $wallet_balance2 >= $package_amount_second) {

                              DB::table($userwallet)->where('user_id',Auth::user()->user_id)->decrement('amount',$package_amount);
                              DB::table($userwallet_2)->where('user_id',Auth::user()->user_id)->decrement('amount',$package_amount_second);
                        }
                        else {
                              $response_data =  ['type' => 'error' ,'message' => 'Insufficient Wallet Balance'] ;
                        }
                }
            }


    return response()->json($response_data);
  }
public function freeRegView(){
    return view('registration.create');
    //return view('registration.unavailable');
}
  public function freeRegistration(Request $request) {

    $username   = $request->input('username');
    $first_name = $request->input('first_name');
    $last_name  = $request->input('last_name');
    $pl_id      = $request->input('pl_id');
    $positions  = $request->input('position') ;
    $sponsor_id = $request->input('sponsor_id');
    $email      = $request->input('email');
    $package    = $request->input('package');
    $payment_type = $request->input('payment_type');
    $country  = $request->input('country');
    $telephone  = $request->input('telephone');

    $position = (!empty($positions) ? $positions : $this->member_position($sponsor_id));
    $data       = [
                    'username'    => $username,
                    'email'       => $email,
                    'country'     => $country,
                    'telephone'   => $telephone
                  ];
    $rules =  [
                'username'  => 'required|max:6|unique:user_registration',

                'email'         => 'required|email',
                'country'     => 'required',
                'telephone'   => 'required',
            ];

     $validator = Validator::make($data, $rules);
     if ($validator->fails()) {


            return back()->with(['message' => $validator->errors()->first()]);

    }
    else {
              $user_id          =   $this->generateUserid();
              $plain_password   = str_random(8);
              $transaction_code = str_random(8);
              $password       = $plain_password;
              $sponsor = DB::table('user_registration')->where('user_id',$sponsor_id)
                                                      ->orWhere('username',$sponsor_id)
                                                      ->count('id');
                    if($sponsor > 0) {

                        $sponsor_id = DB::table('user_registration')->where('user_id',$sponsor_id)
                                                          ->orWhere('username',$sponsor_id)
                                                              ->first(['user_id'])->user_id;
                            $row_ref=DB::table('user_registration')->where('user_id',$sponsor_id)->first(['user_id','binary_pos','username']);
                            $ref_id =$row_ref->user_id;
                            $ref_username=$row_ref->username;
                            $ref_pos=$row_ref->binary_pos;
                            $ref_id123=$ref_id;
                            //position
                            if ($position!='') {
                                 $position=$positions;
                            }else{
                                $position=$this->member_position($ref_id123);
                            }

                            $nom_id123 = $sponsor_id;
                            //spill over
                            if($nom_id123!='')
                            {
                              $nom_id123=$this->spillOverMember($ref_id123,$position);
                            }
                            else
                            {
                              $nom_id123=$this->spillOverMember($ref_id123,$position);
                            }

                            $row_refing=DB::table('user_registration')->where('user_id',$nom_id123)->first(['user_id']);
                            $nom_id1=$row_refing->user_id;
                            $nom_id=$nom_id1;
                                    DB::table('user_registration')
                                              ->insert([
                                                          'user_id'         => $user_id,
                                                          'username'        => $username,
                                                          'ref_id'          => $sponsor_id,
                                                          'nom_id'          => $nom_id,
                                                          'first_name'      => 'NOT SET',
                                                          'email'           => $email,
                                                          'last_name'       => 'NOT SET',
                                                          'binary_pos'      => $position ,
                                                          'user_plan'       => 0,
                                                          'password'        => $password,
                                                          't_code'          => $transaction_code,
                                                          'registration_date'=> date('Y-m-d'),
                                                          'address'         => 'NOT SET',
                                                          'country'         => $country,
                                                          'city'            => 'NOT SET',
                                                          'zipcode'         => 'NOT SET',
                                                          'telephone'       => $telephone,
                                                          'admin_status'    => 0,
                                                          'designation'     => 'NOT SET',
                                                          'designation'     => 'NOT SET',
                                                          'aboutus'         => 'NOT SET',
                                                          'dob'             => 'NOT SET',
                                                          'state'          => 'NOT SET',
                                                          'sex'             => 'NOT SET',
                                                          'image'           => 'NOT SET',
                                                          'acc_name'        => 'NOT SET',
                                                          'ac_no'           => 'NOT SET',
                                                          'bank_nm'         => 'NOT SET',
                                                          'branch_nm'       => 'NOT SET',
                                                          'swift_code'      => 'NOT SET',
                                                          'user_rank_name'  => 'Affiliate',
                                                          'merried_status'  => 'NOT SET',
                                                          'last_login_date' => date('Y-m-d'),
                                                          'current_login_date' => date('Y-m-d'),
                                                          'id_card'         => 'NOT SET',
                                                          'id_no'           => 'NOT SET',
                                                          'master_account'  => 'NOT SET',
                                                          'issued'          => 'NOT SET',
                                                          'product_type'    => 'NOT SET',
                                                          'admin_remark1'   => 'NOT SET',
                                                          'nom_name'        => 'NOT SET',
                                                          'nom_relation'    => 'NOT SET',
                                                          'nom_mobile'      => 'NOT SET',
                                                          'bank_state'      => 'NOT SET',
                                                          'ben_fullname'    => 'NOT SET',
                                                          'ben_nric'        => 'NOT SET',
                                                          'gtb_wallet_address' => 'NOT SET',
                                                          'ref_count'       => 0,
                                                          'user_status'     => 0,
                                                          'issue_date'      => date('Y-m-d'),
                                                          'nom_dob'         => 'NOT SET',

                                                        ]);
                                    $l=1;
                                    $pos   = $position;
                                    $nom=$nom_id;
                                    while($nom!='cmp'){
                                      if($nom!='cmp'){

                                              DB::table('level_income_binary')
                                                      ->insert([
                                                                  'down_id'   => $user_id,
                                                                  'income_id' => $nom ,
                                                                  'leg'       => $pos,
                                                                  'l_date'    => date('Y-m-d'),
                                                                  'status'    => 0 ,
                                                                  'level'     => $l
                                                      ]);
                                              $l++;
                                              $fetchnompos=DB::table('user_registration')->where('user_id',$nom)->first(['binary_pos','nom_id']);
                                              $pos=$fetchnompos->binary_pos;
                                              $nom=$fetchnompos->nom_id;
                                        }
                                    }
                                  $urls="http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

                                 //WALLETS
                                  DB::table('final_e_wallet')
                                              ->insert([
                                                        'user_id' => $user_id,
                                                        'amount'  =>  0,
                                                        'status'  => 0
                                                      ]);
                                DB::table('final_apin_wallet')
                                                  ->insert([
                                                          'user_id' => $user_id,
                                                          'amount'  =>  0,
                                                          'status'  => 0
                                                          ]);
                                DB::table('final_r_wallet')
                                                    ->insert([
                                                              'user_id' => $user_id,
                                                              'amount'  =>  0,
                                                              'status'  => 0
                                                          ]);
                                DB::table('final_compounding_wallet')
                                                      ->insert([
                                                                'user_id' => $user_id,
                                                                'amount'  =>  0,
                                                                'status'  => 0
                                                            ]);
                                DB::table('final_forex_wallet')
                                                        ->insert([
                                                                  'user_id' => $user_id,
                                                                  'amount'  =>  0,
                                                                  'status'  => 0
                                                                ]);
                                DB::table('final_lotto_wallet')
                                                        ->insert([
                                                                  'user_id' => $user_id,
                                                                  'amount'  =>  0,
                                                                  'status'  => 0
                                                                ]);


                                    // /*Inserting Record of BV in manage bv table for all upliners code starts here*/
                                    //     $upliners = DB::table('level_income_binary')->where('down_id',$user_id)->get();
                                    // foreach($upliners as $upline){
                                    //   $income_id=$upline->income_id;
                                    //   $position=$upline->leg;
                                    //   $user_level=$upline->level;
                                    //   DB::table('manage_bv_history')
                                    //             ->insert([
                                    //                   'income_id'     =>  $income_id,
                                    //                   'downline_id'   => $user_id,
                                    //                   'level'         => $user_level,
                                    //                   'bv'            => $pb,
                                    //                   'position'      => $position,
                                    //                   'date'          => date('Y-m-d'),
                                    //                   'description'   => 'Package Purchase Amount',
                                    //                   'status'        => 0 ,
                                    //                   'pair'          => $pb
                                    //             ]);
                                    //
                                    // }
                                     /*Inserting Record of BV in manage bv table for all upliners code ends here*/

                                      /*Inserting Record of BV in manage bv table for all upliners code starts here*/
                                    $nom123=$sponsor_id;
                                    $date=date('Y-m-d');
                                    $l1=1;
                                    while($nom123!='cmp'){
                                      if($nom123!='cmp'){


                                            DB::table('matrix_downline')
                                                        ->insert([
                                                                  'down_id'   => $user_id,
                                                                  'income_id' => $nom123,
                                                                  'l_date'    => date('Y-m-d'),
                                                                  'status'    => 0 ,
                                                                  'level'     => $l
                                                        ]);
                                          $l1++;
                                          $fetchnompos1=DB::table('user_registration')->where('user_id',$nom123)->first(['ref_id']);
                                          $nom123=$fetchnompos1->ref_id;
                                    }
                                    }
                                     /*Inserting Record of BV in manage bv table for all upliners code ends here*/

                                     $users = User::where('user_id',$user_id)->first();
                                     //$name  = User::where('email','louisesalas8.26@gmail.com')->first(['username']);
                                     $users->notify(new Registration('Account Registration',
                                                                      "Welcome aboard in your financial success",
                                                                      'Member ID :' . $user_id .' Username : ' .$users->username . 'Password : ' . $plain_password . ' Transaction Password : ' .$transaction_code
                                                          ));



                                    return back()->with(['message' => 'New user has been registered']);

            }
            else {


                      return back()->with(['message' => 'Sponsor Not Found']);

            }

        }
  }
  public function activateView() {
      return view('registration.activate');
      //return view('registration.unavailable');

  }
  public function activationView() {
      return view('registration.internalactivate');
      //return view('registration.unavailable');
  }
  public function activationViewDownline() {
      return view('registration.packageupgrade');
      //return view('registration.unavailable');
  }
  public function activate(Request $request) {

      $amount       = $request->input('amount');
      $user_id      = $request->input('user_id');
      $password     = $request->input('password');
      $transaction  = $request->input('transpassword');
      $payment_type = $request->input('pay_type');
      $invoice_no   = rand(111111,9999999);

      $lfid =  'ljs' .rand(111111,9999999);


      $findUser = DB::table('user_registration')
                        ->where('user_id',$user_id)
                        ->where('password',$password)
                        ->where('t_code',$transaction)
                        ->count('id');

      $urls="https://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

        if($findUser > 0) {

              $countActivatedAccount = DB::table('lifejacket_subscription')
                                        ->where('user_id',$user_id)
                                        ->count('id');
              if(  $countActivatedAccount > 0) {

                    DB::table('lifejacket_subscription')->where('user_id',$user_id)->delete();
                    //  return back()->with(['message' => 'Package Activation is only allowed once per account','type' => 'error']);
              }
                  $pb = $amount ;

                  $startdate=date('Y-m-d');
                  $enddate = date('Y-m-d', strtotime('+20 months'));

                  $rwallet = DB::table('final_r_wallet')->where('user_id',$user_id)->first(['amount'])->amount;
                  $vwallet = DB::table('final_apin_wallet')->where('user_id',$user_id)->first(['amount'])->amount;

                  if($payment_type == 'Virtual Wallet') {

                    if($vwallet >= $amount) {
                      $ref_id = DB::table('user_registration')->where('user_id',$user_id)->first(['ref_id'])->ref_id;
                      $ref_name  = DB::table('user_registration')->where('user_id',$ref_id)->first(['username'])->username;

                      DB::table('final_apin_wallet')->where('user_id',$user_id)->decrement('amount',$amount);

                      DB::table('lifejacket_subscription')
                              ->insert([
                                        'user_id'       => $user_id,
                                        'package'       => $amount,
                                        'amount'        => $amount,
                                        'pay_type'      => $payment_type,
                                        'transaction_no'=> $invoice_no,
                                        'date'          => $startdate,
                                        'expire_date'   => $enddate,
                                        'remark'        => 'Package Purchase',
                                        'status'        => 'Active',
                                        'invoice_no'    => $invoice_no ,
                                        'lifejacket_id' => $lfid,
                                        'username'      => $ref_id,
                                        'sponsor'       => $ref_name,
                                        'pb'            => $pb,
                                        'pin_no'        => $user_id
                              ]);

                              DB::table('credit_debit')
                                    ->insert([
                                            'transaction_no' => $invoice_no,
                                            'user_id' => $user_id,
                                            'credit_amt' => 0,
                                            'debit_amt' => $amount,
                                            'admin_charge' => 0,
                                            'receiver_id' => $user_id,
                                            'sender_id' => $user_id,
                                            'receive_date' => date('Y-m-d'),
                                            'ttype' => 'Package Purchase',
                                            'TranDescription' => 'Package Purchase by '. $user_id,
                                            'Cause' => 'Package Purchase by '. $user_id,
                                            'Remark'    => 'Package Purchase',
                                            'invoice_no' => $invoice_no,
                                            'product_name' => 'Package Purchase',
                                            'status'  => 0,
                                            'ewallet_used_by' => $payment_type,
                                            'current_url'  => $urls
                                    ]);

                                  return back()->with(['message' => 'Account activated','type' => 'success']);
                      }
                      else {
                              return back()->with(['message' => 'Not enough Virtual Wallet','type' => 'error']);
                      }
                  }
                  else if($payment_type == 'Rwallet+Virtual Wallet') {

                      $pb = $amount * 80 /100;
                      $vamount = $amount * 20/100;

                      if($rwallet >= $pb && $vwallet >= $vamount) {

                          DB::table('final_r_wallet')->where('user_id',$user_id)->decrement('amount',$pb);
                          DB::table('final_apin_wallet')->where('user_id',$user_id)->decrement('amount',$vamount);

                        $ref_id = DB::table('user_registration')->where('user_id',$user_id)->first(['ref_id'])->ref_id;
                        $ref_name  = DB::table('user_registration')->where('user_id',$ref_id)->first(['username'])->username;
                        DB::table('lifejacket_subscription')
                              ->insert([
                                        'user_id'       => $user_id,
                                        'package'       => $amount,
                                        'amount'        => $amount,
                                        'pay_type'      => $payment_type,
                                        'transaction_no'=> $invoice_no,
                                        'date'          => $startdate,
                                        'expire_date'   => $enddate,
                                        'remark'        => 'Package Purchase',
                                        'status'        => 'Active',
                                        'invoice_no'    => $invoice_no ,
                                        'lifejacket_id' => $lfid,
                                        'username'      => $ref_id,
                                        'sponsor'       => $ref_name,
                                        'pb'            => $amount,
                                        'pin_no'        => $user_id
                              ]);

                              DB::table('credit_debit')
                                    ->insert([
                                            'transaction_no'      => $invoice_no,
                                            'user_id'             => $user_id,
                                            'credit_amt'          => 0,
                                            'debit_amt'           => $amount,
                                            'admin_charge'        => 0,
                                            'receiver_id'         => $user_id,
                                            'sender_id'           => $user_id,
                                            'receive_date'        => date('Y-m-d'),
                                            'ttype'               => 'Package Purchase',
                                            'TranDescription'     => 'Package Purchase by '. $user_id . '80% RWallet + 20% Virtual',
                                            'Cause'               => 'Package Purchase by '. $user_id,
                                            'Remark'              => 'Package Purchase',
                                            'invoice_no'          => $invoice_no,
                                            'product_name'   => 'Package Purchase',
                                            'status'  => 0,
                                            'ewallet_used_by' => $payment_type,
                                            'current_url'  => $urls
                                    ]);
                            /*Inserting Record of BV in manage bv table for all upliners code starts here*/
                              $upliners = DB::table('level_income_binary')->where('down_id',$user_id)->get();
                              foreach($upliners as $upline){
                                $income_id=$upline->income_id;
                                $position=$upline->leg;
                                $user_level=$upline->level;
                                    DB::table('manage_bv_history')
                                              ->insert([
                                                    'income_id'     =>  $income_id,
                                                    'downline_id'   => $user_id,
                                                    'level'         => $user_level,
                                                    'bv'            => $pb,
                                                    'position'      => $position,
                                                    'date'          => date('Y-m-d'),
                                                    'description'   => 'Package Purchase Amount',
                                                    'status'        => 0 ,
                                                    'pair'          => $pb
                                              ]);
                                      }

                                        $this->commission_of_referal($ref_id,$user_id,$amount,$invoice_no,$amount);

                                        return back()->with(['message' => 'Account activated','type' => 'success']);
                              }

                              else {


                                      return back()->with(['message' => 'Not enough  Wallet','type' => 'error']);

                              }

                          }

                          else if($payment_type == 'R Wallet') {

                              $pb = $amount ;


                              if($rwallet >= $pb ) {
                                  DB::table('final_r_wallet')->where('user_id',$user_id)->decrement('amount',$pb);
                                $ref_id = DB::table('user_registration')->where('user_id',$user_id)->first(['ref_id'])->ref_id;
                                $ref_name  = DB::table('user_registration')->where('user_id',$ref_id)->first(['username'])->username;
                                DB::table('lifejacket_subscription')
                                      ->insert([
                                                'user_id'       => $user_id,
                                                'package'       => $amount,
                                                'amount'        => $amount,
                                                'pay_type'      => $payment_type,
                                                'transaction_no'=> $invoice_no,
                                                'date'          => $startdate,
                                                'expire_date'   => $enddate,
                                                'remark'        => 'Package Purchase',
                                                'status'        => 'Active',
                                                'invoice_no'    => $invoice_no ,
                                                'lifejacket_id' => $lfid,
                                                'username'      =>  $ref_id ,
                                                'sponsor'       => $ref_name,
                                                'pb'            => $amount,
                                                'pin_no'        => $user_id
                                      ]);

                                      DB::table('credit_debit')
                                            ->insert([
                                                    'transaction_no'  => $invoice_no,
                                                    'user_id'         => $user_id,
                                                    'credit_amt'      => 0,
                                                    'debit_amt'       => $amount,
                                                    'admin_charge'    => 0,
                                                    'receiver_id'     => $user_id,
                                                    'sender_id'       => $user_id,
                                                    'receive_date'    => date('Y-m-d'),
                                                    'ttype'           => 'Package Purchase',
                                                    'TranDescription' => 'Package Purchase by '. $user_id . '80% RWallet + 20% Virtual',
                                                    'Cause'           => 'Package Purchase by '. $user_id,
                                                    'Remark'          => 'Package Purchase',
                                                    'invoice_no'      => $invoice_no,
                                                    'product_name'    => 'Package Purchase',
                                                    'status'          => 0,
                                                    'ewallet_used_by' => $payment_type,
                                                    'current_url'     => $urls
                                            ]);
                                    /*Inserting Record of BV in manage bv table for all upliners code starts here*/
                                      $upliners = DB::table('level_income_binary')->where('down_id',$user_id)->get();
                                      foreach($upliners as $upline){
                                        $income_id=$upline->income_id;
                                        $position=$upline->leg;
                                        $user_level=$upline->level;
                                            DB::table('manage_bv_history')
                                                      ->insert([
                                                            'income_id'     =>  $income_id,
                                                            'downline_id'   => $user_id,
                                                            'level'         => $user_level,
                                                            'bv'            => $pb,
                                                            'position'      => $position,
                                                            'date'          => date('Y-m-d'),
                                                            'description'   => 'Package Purchase Amount',
                                                            'status'        => 0 ,
                                                            'pair'          => $pb
                                                      ]);
                                              }

                                                $this->commission_of_referal($ref_id,$user_id,$amount,$invoice_no,$amount);

                                                return back()->with(['message' => 'Account activated','type' => 'success']);
                                      }

                                      else {

                                              return back()->with(['message' => 'Not enough  Wallet','type' => 'error']);

                                      }

                            }


        }

        else {

                    return back()->with(['message' => 'User Not Found','type' => 'error']);

        }

  }
  public function activateDownline(Request $request) {

      $amount       = $request->input('amount');
      $user_id      = $request->input('user_id');
      $downline_id  = $request->input('downline_id');
      $password     = $request->input('password');
      $transaction  = $request->input('transpassword');
      $payment_type = $request->input('pay_type');
      $invoice_no   = rand(111111,9999999);

      $lfid =  'ljs' .rand(111111,9999999);


      $findUser = DB::table('user_registration')
                        ->where('user_id',$user_id)
                        ->where('password',$password)
                        ->where('t_code',$transaction)
                        ->count('id');

      $urls="https://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

        if($findUser > 0) {

              $countActivatedAccount = DB::table('lifejacket_subscription')
                                        ->where('user_id',$downline_id)
                                        ->count('id');
              if(  $countActivatedAccount > 0) {

                    DB::table('lifejacket_subscription')->where('user_id',$downline_id)->delete();
                    //  return back()->with(['message' => 'Package Activation is only allowed once per account','type' => 'error']);
              }
                  $pb = $amount ;

                  $startdate=date('Y-m-d');
                  $enddate = date('Y-m-d', strtotime('+20 months'));

                  $rwallet = DB::table('final_r_wallet')->where('user_id',$user_id)->first(['amount'])->amount;
                  $vwallet = DB::table('final_apin_wallet')->where('user_id',$user_id)->first(['amount'])->amount;

                  if($payment_type == 'Virtual Wallet') {

                    if($vwallet >= $amount) {
                      $ref_id = DB::table('user_registration')->where('user_id',$downline_id)->first(['ref_id'])->ref_id;
                      $ref_name  = DB::table('user_registration')->where('user_id',$downline_id)->first(['username'])->username;

                      DB::table('final_apin_wallet')->where('user_id',$user_id)->decrement('amount',$amount);

                      DB::table('lifejacket_subscription')
                              ->insert([
                                        'user_id'       => $user_id,
                                        'package'       => $amount,
                                        'amount'        => $amount,
                                        'pay_type'      => $payment_type,
                                        'transaction_no'=> $invoice_no,
                                        'date'          => $startdate,
                                        'expire_date'   => $enddate,
                                        'remark'        => 'Package Purchase',
                                        'status'        => 'Active',
                                        'invoice_no'    => $invoice_no ,
                                        'lifejacket_id' => $lfid,
                                        'username'      => $ref_id,
                                        'sponsor'       => $ref_name,
                                        'pb'            => $pb,
                                        'pin_no'        => $user_id
                              ]);

                              DB::table('credit_debit')
                                    ->insert([
                                            'transaction_no' => $invoice_no,
                                            'user_id' => $user_id,
                                            'credit_amt' => 0,
                                            'debit_amt' => $amount,
                                            'admin_charge' => 0,
                                            'receiver_id' => $user_id,
                                            'sender_id' => $user_id,
                                            'receive_date' => date('Y-m-d'),
                                            'ttype' => 'Package Purchase',
                                            'TranDescription' => 'Package Purchase by '. $user_id,
                                            'Cause' => 'Package Purchase by '. $user_id,
                                            'Remark'    => 'Package Purchase',
                                            'invoice_no' => $invoice_no,
                                            'product_name' => 'Package Purchase',
                                            'status'  => 0,
                                            'ewallet_used_by' => $payment_type,
                                            'current_url'  => $urls
                                    ]);

                                  return back()->with(['message' => 'Account activated','type' => 'success']);
                      }
                      else {
                              return back()->with(['message' => 'Not enough Virtual Wallet','type' => 'error']);
                      }
                  }
                  else if($payment_type == 'Rwallet+Virtual Wallet') {

                      $pb = $amount * 80 /100;
                      $vamount = $amount * 20/100;

                      if($rwallet >= $pb && $vwallet >= $vamount) {

                          DB::table('final_r_wallet')->where('user_id',$user_id)->decrement('amount',$pb);
                          DB::table('final_apin_wallet')->where('user_id',$user_id)->decrement('amount',$vamount);

                        $ref_id = DB::table('user_registration')->where('user_id',$downline_id)->first(['ref_id'])->ref_id;
                        $ref_name  = DB::table('user_registration')->where('user_id',$downline_id)->first(['username'])->username;
                        DB::table('lifejacket_subscription')
                              ->insert([
                                        'user_id'       => $downline_id,
                                        'package'       => $amount,
                                        'amount'        => $amount,
                                        'pay_type'      => $payment_type,
                                        'transaction_no'=> $invoice_no,
                                        'date'          => $startdate,
                                        'expire_date'   => $enddate,
                                        'remark'        => 'Package Purchase',
                                        'status'        => 'Active',
                                        'invoice_no'    => $invoice_no ,
                                        'lifejacket_id' => $lfid,
                                        'username'      => $ref_id,
                                        'sponsor'       => $ref_name,
                                        'pb'            => $amount,
                                        'pin_no'        => $user_id
                              ]);

                              DB::table('credit_debit')
                                    ->insert([
                                            'transaction_no'      => $invoice_no,
                                            'user_id'             => $user_id,
                                            'credit_amt'          => 0,
                                            'debit_amt'           => $amount,
                                            'admin_charge'        => 0,
                                            'receiver_id'         => $downline_id,
                                            'sender_id'           => $user_id,
                                            'receive_date'        => date('Y-m-d'),
                                            'ttype'               => 'Package Purchase',
                                            'TranDescription'     => 'Package Purchase by '. $user_id . '80% RWallet + 20% Virtual',
                                            'Cause'               => 'Package Purchase by '. $user_id,
                                            'Remark'              => 'Package Purchase',
                                            'invoice_no'          => $invoice_no,
                                            'product_name'   => 'Package Purchase',
                                            'status'  => 0,
                                            'ewallet_used_by' => $payment_type,
                                            'current_url'  => $urls
                                    ]);
                            /*Inserting Record of BV in manage bv table for all upliners code starts here*/
                              $upliners = DB::table('level_income_binary')->where('down_id',$downline_id)->get();
                              foreach($upliners as $upline){
                                $income_id=$upline->income_id;
                                $position=$upline->leg;
                                $user_level=$upline->level;
                                    DB::table('manage_bv_history')
                                              ->insert([
                                                    'income_id'     =>  $income_id,
                                                    'downline_id'   => $downline_id,
                                                    'level'         => $user_level,
                                                    'bv'            => $pb,
                                                    'position'      => $position,
                                                    'date'          => date('Y-m-d'),
                                                    'description'   => 'Package Purchase Amount',
                                                    'status'        => 0 ,
                                                    'pair'          => $pb
                                              ]);
                                      }

                                      $this->commission_of_referal($ref_id,$downline_id,$amount,$invoice_no,$amount);

                                    return back()->with(['message' => 'Account activated','type' => 'success']);
                              }

                              else {


                                      return back()->with(['message' => 'Not enough  Wallet','type' => 'error']);

                              }

                          }

                          else if($payment_type == 'R Wallet') {

                              $pb = $amount ;


                              if($rwallet >= $pb ) {
                                  DB::table('final_r_wallet')->where('user_id',$user_id)->decrement('amount',$pb);
                                $ref_id = DB::table('user_registration')->where('user_id',$downline_id)->first(['ref_id'])->ref_id;
                                $ref_name  = DB::table('user_registration')->where('user_id',$downline_id)->first(['username'])->username;
                                DB::table('lifejacket_subscription')
                                      ->insert([
                                                'user_id'       => $downline_id,
                                                'package'       => $amount,
                                                'amount'        => $amount,
                                                'pay_type'      => $payment_type,
                                                'transaction_no'=> $invoice_no,
                                                'date'          => $startdate,
                                                'expire_date'   => $enddate,
                                                'remark'        => 'Package Purchase',
                                                'status'        => 'Active',
                                                'invoice_no'    => $invoice_no ,
                                                'lifejacket_id' => $lfid,
                                                'username'      =>  $ref_id ,
                                                'sponsor'       => $ref_name,
                                                'pb'            => $amount,
                                                'pin_no'        => $user_id
                                      ]);

                                      DB::table('credit_debit')
                                            ->insert([
                                                    'transaction_no'  => $invoice_no,
                                                    'user_id'         => $user_id,
                                                    'credit_amt'      => 0,
                                                    'debit_amt'       => $amount,
                                                    'admin_charge'    => 0,
                                                    'receiver_id'     => $downline_id,
                                                    'sender_id'       => $user_id,
                                                    'receive_date'    => date('Y-m-d'),
                                                    'ttype'           => 'Package Purchase',
                                                    'TranDescription' => 'Package Purchase by '. $user_id . '100% RWallet',
                                                    'Cause'           => 'Package Purchase by '. $user_id,
                                                    'Remark'          => 'Package Purchase',
                                                    'invoice_no'      => $invoice_no,
                                                    'product_name'    => 'Package Purchase',
                                                    'status'          => 0,
                                                    'ewallet_used_by' => $payment_type,
                                                    'current_url'     => $urls
                                            ]);
                                    /*Inserting Record of BV in manage bv table for all upliners code starts here*/
                                      $upliners = DB::table('level_income_binary')->where('down_id',$downline_id)->get();
                                      foreach($upliners as $upline){
                                        $income_id=$upline->income_id;
                                        $position=$upline->leg;
                                        $user_level=$upline->level;
                                            DB::table('manage_bv_history')
                                                      ->insert([
                                                            'income_id'     =>  $income_id,
                                                            'downline_id'   => $downline_id,
                                                            'level'         => $user_level,
                                                            'bv'            => $pb,
                                                            'position'      => $position,
                                                            'date'          => date('Y-m-d'),
                                                            'description'   => 'Package Purchase Amount',
                                                            'status'        => 0 ,
                                                            'pair'          => $pb
                                                      ]);
                                              }

                                                $this->commission_of_referal($ref_id,$downline_id,$amount,$invoice_no,$amount);

                                                return back()->with(['message' => 'Account activated','type' => 'success']);
                                      }

                                      else {

                                              return back()->with(['message' => 'Not enough  Wallet','type' => 'error']);

                                      }

                            }


        }

        else {

                    return back()->with(['message' => 'User Not Found','type' => 'error']);

        }

  }
  public function member_position($ref_id) {

    $left_leg_count   =  DB::table('level_income_binary')->where('income_id',$ref_id)->where('leg','left');
    $right_leg_count  =  DB::table('level_income_binary')->where('income_id',$ref_id)->where('leg','right');
    $position ='left' ;
    if($left_leg_count==$right_leg_count) {
        $position='left';
    }
    else {
    // find the weeker leg
      $min=min( $left_leg_count,$right_leg_count );
          if($min==$left_leg_count){
              $position='left';
          }
          if( $min==$right_leg_count ){
              $position='right';
          }
    }
    return $position;
  }


  /*Registration Spill Code Starts Here for finding the nomid */
  public function spillOverMember($sponsor_id,$position) {
     global $nom_id ;

    $data = DB::table('user_registration')->where('nom_id',$sponsor_id)->where('binary_pos',$position)->first(['user_id']);
    if($data){
        $this->spillOverMember($data->user_id,$position);
    }
    else
    {
      $nom_id= $sponsor_id;
    }
  return $nom_id;
  }

  public function generateUserid(){

    $encypt1=uniqid(rand(1000000000,9999999999), true);
    $usid1=str_replace(".", "", $encypt1);
    $pre_userid = substr($usid1, 0, 7);

    if (User::where('user_id', '=', $pre_userid)->exists()) {
        $this->generateUserid();
    }
    return $pre_userid;
  }

  public function spill_over_binary_income_level1($ref_id,$useridss,$amount,$invoice_no,$packages)
  {
  	$refcount=0;
  	$date=date('Y-m-d');

    $refcount =  DB::table('user_registration')->where('ref_id',$ref_id)->count('user_id');
  	if($refcount>2)
  	{
  		$withdrawal_commission= $amount * (3/100 );

  		$rwallets=$withdrawal_commission * (60/100);
  		$rwallets1=$withdrawal_commission * (20/100 );
  		$rwallets2=$withdrawal_commission * (10/100);
  		$rwallets3=$withdrawal_commission * (10/100);


  		$rwallet=$rwallets;
  		$rwallet1=$rwallets1;
  		$rwallet2=$rwallets2;
  		$rwallet3=$rwallets3;

  	if( $withdrawal_commission!='' && $withdrawal_commission!=0) {

  	    $urls="http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        //UPDATE WALLET BALANCES
        DB::table('final_e_wallet')->where('user_id',$ref_id)->increment('amount', $rwallet);
        DB::table('final_compounding_wallet')->where('user_id',$ref_id)->increment('amount', $rwallet1);
        DB::table('final_forex_wallet')->where('user_id',$ref_id)->increment('amount', $rwallet2);
        DB::table('final_lotto_wallet')->where('user_id',$ref_id)->increment('amount', $rwallet3);
        // INSERT HISTORY
        DB::table('credit_debit')
              ->insert([
                          'transaction_no'    => $invoice_no,
                          'user_id'           => $ref_id,
                          'credit_amt'        => $rwallet,
                          'debit_amt'         => 0 ,
                          'admin_charge'      => 0,
                          'receiver_id'       => $ref_id,
                          'sender_id'         => $useridss,
                          'receive_date'      => $date ,
                          'ttype'             => 'Leadership Income',
                          'TranDescription'   => 'Earn Leadership Income from $useridss for $packages Package',
                          'Cause'             => 'Commission of USD $rwallet For Package $packages' ,
                          'Remark'            => 'Leadership Income',
                          'invoice_no'        => $invoice_no,
                          'product_name'      => 'Leadership Income Level 1',
                          'status'            => 0 ,
                          'ewallet_used_by'   => 'E Wallet' ,
                          'current_url'       => $urls
                      ]);

          DB::table('credit_debit')
                  ->insert([
                            'transaction_no'    => $invoice_no,
                            'user_id'           => $ref_id,
                            'credit_amt'        => $rwallet1,
                            'debit_amt'         => 0 ,
                            'admin_charge'      => 0,
                            'receiver_id'       => $ref_id,
                            'sender_id'         => $useridss,
                            'receive_date'      => $date ,
                            'ttype'             => 'Leadership Income',
                            'TranDescription'   => 'Earn Leadership Income from $useridss for $packages Package',
                            'Cause'             => 'Commission of USD $rwallet For Package $packages' ,
                            'Remark'            => 'Leadership Income',
                            'invoice_no'        => $invoice_no,
                            'product_name'      => 'Leadership Income Level 1',
                            'status'            => 0 ,
                            'ewallet_used_by'   => 'Compound Wallet' ,
                            'current_url'       => $urls
                        ]);

          DB::table('credit_debit')
                  ->insert([
                            'transaction_no'    => $invoice_no,
                            'user_id'           => $ref_id,
                            'credit_amt'        => $rwallet2,
                            'debit_amt'         => 0 ,
                            'admin_charge'      => 0,
                            'receiver_id'       => $ref_id,
                            'sender_id'         => $useridss,
                            'receive_date'      => $date ,
                            'ttype'             => 'Leadership Income',
                            'TranDescription'   => 'Earn Leadership Income from $useridss for $packages Package',
                            'Cause'             => 'Commission of USD $rwallet For Package $packages' ,
                            'Remark'            => 'Leadership Income',
                            'invoice_no'        => $invoice_no,
                            'product_name'      => 'Leadership Income Level 1',
                            'status'            => 0 ,
                            'ewallet_used_by'   => 'Forex Wallet' ,
                            'current_url'       => $urls
                        ]);
          DB::table('credit_debit')
                    ->insert([
                              'transaction_no'    => $invoice_no,
                              'user_id'           => $ref_id,
                              'credit_amt'        => $rwallet3,
                              'debit_amt'         => 0 ,
                              'admin_charge'      => 0,
                              'receiver_id'       => $ref_id,
                              'sender_id'         => $useridss,
                              'receive_date'      => $date ,
                              'ttype'             => 'Leadership Income',
                              'TranDescription'   => 'Earn Leadership Income from $useridss for $packages Package',
                              'Cause'             => 'Commission of USD $rwallet For Package $packages' ,
                              'Remark'            => 'Leadership Income',
                              'invoice_no'        => $invoice_no,
                              'product_name'      => 'Leadership Income Level 1',
                              'status'            => 0 ,
                              'ewallet_used_by'   => 'Lotto Wallet' ,
                              'current_url'       => $urls
                          ]);
  	               // $this->spill_over_binary_income_level2($ref_id,$useridss,$amount,$invoice_no,$packages);

  	   	}

  	}
  	else
  	   	{
  	   		   $this->spill_over_binary_income_level3($ref_id,$useridss,$amount,$invoice_no,$packages);
  	   	}


  }



  public function spill_over_binary_income_level2($ref_id,$useridss,$amount,$invoice_no,$packages)
  {
  	$date=date('Y-m-d');
  	$refcountc=0;


    $matrix = DB::table('matrix_downline')
                        ->where('down_id',$useridss)
                        ->where('level','>',1)
                        ->get();

    $refcountc=0;
      $user =   Session::get('user_id');
    foreach($matrix as $matrixs){
      $income_id=$matrixs->income_id;
  	$refcount = DB::table('user_registration')->where('ref_id',$income_id)->where('user_id',$ref_id)->count('id');
    if($refcount > 2)
  	{
  		$withdrawal_commission=$amount*2/100;

  		$rwallets=$withdrawal_commission*60/100;
  		$rwallets1=$withdrawal_commission*20/100;
  		$rwallets2=$withdrawal_commission*10/100;
  		$rwallets3=$withdrawal_commission*10/100;



  		$rwallet=$rwallets;
  		$rwallet1=$rwallets1;
  		$rwallet2=$rwallets2;
  		$rwallet3=$rwallets3;


  		if($withdrawal_commission!='' && $withdrawal_commission!=0)
  		{


  	    $urls="http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

        DB::table('final_e_wallet')->where('user_id',$income_id)->increment('amount', $rwallet);
        DB::table('final_compounding_wallet')->where('user_id',$income_id)->increment('amount', $rwallet1);
        DB::table('final_forex_wallet')->where('user_id',$income_id)->increment('amount', $rwallet2);
        DB::table('final_lotto_wallet')->where('user_id',$income_id)->increment('amount', $rwallet3);

      // INSERT HISTORY
        DB::table('credit_debit')
              ->insert([
                          'transaction_no'    => $invoice_no,
                          'user_id'           => $income_id,
                          'credit_amt'        => $rwallet,
                          'debit_amt'         => 0 ,
                          'admin_charge'      => 0,
                          'receiver_id'       => $income_id,
                          'sender_id'         => $user,
                          'receive_date'      => $date ,
                          'ttype'             => 'Leadership Income',
                          'TranDescription'   => 'Earn Leadership Income from $useridss for $packages Package',
                          'Cause'             => 'Commission of USD $rwallet For Package $packages' ,
                          'Remark'            => 'Leadership Income',
                          'invoice_no'        => $invoice_no,
                          'product_name'      => 'Leadership Income Level 2',
                          'status'            => 0 ,
                          'ewallet_used_by'   => 'E Wallet' ,
                          'current_url'       => $urls
                      ]);

          DB::table('credit_debit')
                  ->insert([
                            'transaction_no'    => $invoice_no,
                            'user_id'           => $income_id,
                            'credit_amt'        => $rwallet1,
                            'debit_amt'         => 0 ,
                            'admin_charge'      => 0,
                            'receiver_id'       => $income_id,
                            'sender_id'         => $user,
                            'receive_date'      => $date ,
                            'ttype'             => 'Leadership Income',
                            'TranDescription'   => 'Earn Leadership Income from $useridss for $packages Package',
                            'Cause'             => 'Commission of USD $rwallet For Package $packages' ,
                            'Remark'            => 'Leadership Income',
                            'invoice_no'        => $invoice_no,
                            'product_name'      => 'Leadership Income Level 1',
                            'status'            => 0 ,
                            'ewallet_used_by'   => 'Compound Wallet' ,
                            'current_url'       => $urls
                        ]);

          DB::table('credit_debit')
                  ->insert([
                            'transaction_no'    => $invoice_no,
                            'user_id'           => $income_id,
                            'credit_amt'        => $rwallet2,
                            'debit_amt'         => 0 ,
                            'admin_charge'      => 0,
                            'receiver_id'       => $income_id,
                            'sender_id'         => $user,
                            'receive_date'      => $date ,
                            'ttype'             => 'Leadership Income',
                            'TranDescription'   => 'Earn Leadership Income from $useridss for $packages Package',
                            'Cause'             => 'Commission of USD $rwallet For Package $packages' ,
                            'Remark'            => 'Leadership Income',
                            'invoice_no'        => $invoice_no,
                            'product_name'      => 'Leadership Income Level 1',
                            'status'            => 0 ,
                            'ewallet_used_by'   => 'Forex Wallet' ,
                            'current_url'       => $urls
                        ]);
          DB::table('credit_debit')
                    ->insert([
                              'transaction_no'    => $invoice_no,
                              'user_id'           => $income_id,
                              'credit_amt'        => $rwallet3,
                              'debit_amt'         => 0 ,
                              'admin_charge'      => 0,
                              'receiver_id'       => $income_id,
                              'sender_id'         => $user,
                              'receive_date'      => $date ,
                              'ttype'             => 'Leadership Income',
                              'TranDescription'   => 'Earn Leadership Income from $useridss for $packages Package',
                              'Cause'             => 'Commission of USD $rwallet For Package $packages' ,
                              'Remark'            => 'Leadership Income',
                              'invoice_no'        => $invoice_no,
                              'product_name'      => 'Leadership Income Level 1',
                              'status'            => 0 ,
                              'ewallet_used_by'   => 'Lotto Wallet' ,
                              'current_url'       => $urls
                          ]);


          $refcountc++;





          $this->spill_over_binary_income_level4($income_id,$user,$amount,$invoice_no,$packages);


  	   	}

  	}
      $ref=$income_id;
  	if($refcountc>0)
  	   	{
  	   		break;
  	   	}

  	}


  }



  public function spill_over_binary_income_level3($ref,$useridss,$amount,$invoice_no,$packages)
  {
  	$date=date('Y-m-d');
  	$refcountc=0;

          $matrix = DB::table('matrix_downline')
                              ->where('down_id',$useridss)
                              ->where('level','>',1)
                              ->get();

          $refcountc=0;
            $user =   Session::get('user_id');
          foreach($matrix as $matrixs){

            $income_id=$matrixs->income_id;


        $refcount = DB::table('user_registration')->where('ref_id',$income_id)->where('user_id',$ref)->count('id');

  	     if($refcount > 2) {
      		$withdrawal_commission=$amount*3/100;

      		$rwallets=$withdrawal_commission*60/100;
      		$rwallets1=$withdrawal_commission*20/100;
      		$rwallets2=$withdrawal_commission*10/100;
      		$rwallets3=$withdrawal_commission*10/100;



      		$rwallet=$rwallets;
      		$rwallet1=$rwallets1;
      		$rwallet2=$rwallets2;
      		$rwallet3=$rwallets3;


  		if($withdrawal_commission!='' && $withdrawal_commission!=0) {


  	       $urls="http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

            DB::table('final_e_wallet')->where('user_id',$income_id)->increment('amount', $rwallet);
            DB::table('final_compounding_wallet')->where('user_id',$income_id)->increment('amount', $rwallet1);
            DB::table('final_forex_wallet')->where('user_id',$income_id)->increment('amount', $rwallet2);
            DB::table('final_lotto_wallet')->where('user_id',$income_id)->increment('amount', $rwallet3);

  // INSERT HISTORY
            DB::table('credit_debit')
              ->insert([
                          'transaction_no'    => $invoice_no,
                          'user_id'           => $income_id,
                          'credit_amt'        => $rwallet,
                          'debit_amt'         => 0 ,
                          'admin_charge'      => 0,
                          'receiver_id'       => $income_id,
                          'sender_id'         => $user,
                          'receive_date'      => $date ,
                          'ttype'             => 'Leadership Income',
                          'TranDescription'   => 'Earn Leadership Income from $useridss for $packages Package',
                          'Cause'             => 'Commission of USD $rwallet For Package $packages' ,
                          'Remark'            => 'Leadership Income',
                          'invoice_no'        => $invoice_no,
                          'product_name'      => 'Leadership Income Level 1',
                          'status'            => 0 ,
                          'ewallet_used_by'   => 'E Wallet' ,
                          'current_url'       => $urls
                      ]);

          DB::table('credit_debit')
                  ->insert([
                            'transaction_no'    => $invoice_no,
                            'user_id'           => $income_id,
                            'credit_amt'        => $rwallet1,
                            'debit_amt'         => 0 ,
                            'admin_charge'      => 0,
                            'receiver_id'       => $income_id,
                            'sender_id'         => $user,
                            'receive_date'      => $date ,
                            'ttype'             => 'Leadership Income',
                            'TranDescription'   => 'Earn Leadership Income from $useridss for $packages Package',
                            'Cause'             => 'Commission of USD $rwallet For Package $packages' ,
                            'Remark'            => 'Leadership Income',
                            'invoice_no'        => $invoice_no,
                            'product_name'      => 'Leadership Income Level 1',
                            'status'            => 0 ,
                            'ewallet_used_by'   => 'Compound Wallet' ,
                            'current_url'       => $urls
                        ]);

          DB::table('credit_debit')
                  ->insert([
                            'transaction_no'    => $invoice_no,
                            'user_id'           => $income_id,
                            'credit_amt'        => $rwallet2,
                            'debit_amt'         => 0 ,
                            'admin_charge'      => 0,
                            'receiver_id'       => $income_id,
                            'sender_id'         => $user,
                            'receive_date'      => $date ,
                            'ttype'             => 'Leadership Income',
                            'TranDescription'   => 'Earn Leadership Income from $useridss for $packages Package',
                            'Cause'             => 'Commission of USD $rwallet For Package $packages' ,
                            'Remark'            => 'Leadership Income',
                            'invoice_no'        => $invoice_no,
                            'product_name'      => 'Leadership Income Level 1',
                            'status'            => 0 ,
                            'ewallet_used_by'   => 'Forex Wallet' ,
                            'current_url'       => $urls
                        ]);
          DB::table('credit_debit')
                    ->insert([
                              'transaction_no'    => $invoice_no,
                              'user_id'           => $income_id,
                              'credit_amt'        => $rwallet3,
                              'debit_amt'         => 0 ,
                              'admin_charge'      => 0,
                              'receiver_id'       => $income_id,
                              'sender_id'         => $user,
                              'receive_date'      => $date ,
                              'ttype'             => 'Leadership Income',
                              'TranDescription'   => 'Earn Leadership Income from $useridss for $packages Package',
                              'Cause'             => 'Commission of USD $rwallet For Package $packages' ,
                              'Remark'            => 'Leadership Income',
                              'invoice_no'        => $invoice_no,
                              'product_name'      => 'Leadership Income Level 1',
                              'status'            => 0 ,
                              'ewallet_used_by'   => 'Lotto Wallet' ,
                              'current_url'       => $urls
                          ]);

          $refcountc++;


          $this->spill_over_binary_income_level2($income_id,$ref,$amount,$invoice_no,$packages);


  	   	}

  	}

  	$ref = $income_id;

  	if($refcountc>0)
  	   	{
  	   		break;
  	   	}

  	}

  }




  public function spill_over_binary_income_level4($ref,$useridss,$amount,$invoice_no,$packages)
  {
  	$date=date('Y-m-d');
  	$refcountc=0;


    $user =   Session::get('user_id');
    $matrix  = DB::table('matrix_downline')->where('down_id',$ref)->get();
    foreach ($matrix as $key => $value) {


  		$income_id=$value->income_id;




  	$refcount = DB::table('user_registration')->where('ref_id',$income_id)->where('user_id',$ref);
    if($refcount->ref_count > 2)
  	{
  		$withdrawal_commission=$amount*1/100;

  		$rwallets=$withdrawal_commission*60/100;
  		$rwallets1=$withdrawal_commission*20/100;
  		$rwallets2=$withdrawal_commission*10/100;
  		$rwallets3=$withdrawal_commission*10/100;

  		// $rwalletss=$rwallets*0/100;
  		// $rwalletss1=$rwallets1*0/100;
  		// $rwalletss2=$rwallets2*0/100;
  		// $rwalletss3=$rwallets3*0/100;

  		$rwallet=$rwallets;
  		$rwallet1=$rwallets1;
  		$rwallet2=$rwallets2;
  		$rwallet3=$rwallets3;


  		if($withdrawal_commission!='' && $withdrawal_commission!=0)
  		{


  	    $urls="http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];


                  DB::table('final_e_wallet')->where('user_id',$income_id)->increment('amount', $rwallet);
                  DB::table('final_compounding_wallet')->where('user_id',$income_id)->increment('amount', $rwallet1);
                  DB::table('final_forex_wallet')->where('user_id',$income_id)->increment('amount', $rwallet2);
                  DB::table('final_lotto_wallet')->where('user_id',$income_id)->increment('amount', $rwallet3);

                  DB::table('credit_debit')
                        ->insert([
                                    'transaction_no'    => $invoice_no,
                                    'user_id'           => $income_id,
                                    'credit_amt'        => $rwallet,
                                    'debit_amt'         => 0 ,
                                    'admin_charge'      => 0,
                                    'receiver_id'       => $income_id,
                                    'sender_id'         => $user,
                                    'receive_date'      => $date ,
                                    'ttype'             => 'Leadership Income',
                                    'TranDescription'   => 'Earn Leadership Income from $useridss for $packages Package',
                                    'Cause'             => 'Commission of USD $rwallet For Package $packages' ,
                                    'Remark'            => 'Leadership Income',
                                    'invoice_no'        => $invoice_no,
                                    'product_name'      => 'Leadership Income Level 3',
                                    'status'            => 0 ,
                                    'ewallet_used_by'   => 'E Wallet' ,
                                    'current_url'       => $urls
                                ]);

                    DB::table('credit_debit')
                            ->insert([
                                      'transaction_no'    => $invoice_no,
                                      'user_id'           => $income_id,
                                      'credit_amt'        => $rwallet1,
                                      'debit_amt'         => 0 ,
                                      'admin_charge'      => 0,
                                      'receiver_id'       => $income_id,
                                      'sender_id'         => $user,
                                      'receive_date'      => $date ,
                                      'ttype'             => 'Leadership Income',
                                      'TranDescription'   => 'Earn Leadership Income from $useridss for $packages Package',
                                      'Cause'             => 'Commission of USD $rwallet For Package $packages' ,
                                      'Remark'            => 'Leadership Income',
                                      'invoice_no'        => $invoice_no,
                                      'product_name'      => 'Leadership Income Level 3',
                                      'status'            => 0 ,
                                      'ewallet_used_by'   => 'Compound Wallet' ,
                                      'current_url'       => $urls
                                  ]);

                    DB::table('credit_debit')
                            ->insert([
                                      'transaction_no'    => $invoice_no,
                                      'user_id'           => $income_id,
                                      'credit_amt'        => $rwallet2,
                                      'debit_amt'         => 0 ,
                                      'admin_charge'      => 0,
                                      'receiver_id'       => $income_id,
                                      'sender_id'         => $user,
                                      'receive_date'      => $date ,
                                      'ttype'             => 'Leadership Income',
                                      'TranDescription'   => 'Earn Leadership Income from $useridss for $packages Package',
                                      'Cause'             => 'Commission of USD $rwallet For Package $packages' ,
                                      'Remark'            => 'Leadership Income',
                                      'invoice_no'        => $invoice_no,
                                      'product_name'      => 'Leadership Income Level 3',
                                      'status'            => 0 ,
                                      'ewallet_used_by'   => 'Forex Wallet' ,
                                      'current_url'       => $urls
                                  ]);
                    DB::table('credit_debit')
                              ->insert([
                                        'transaction_no'    => $invoice_no,
                                        'user_id'           => $income_id,
                                        'credit_amt'        => $rwallet3,
                                        'debit_amt'         => 0 ,
                                        'admin_charge'      => 0,
                                        'receiver_id'       => $income_id,
                                        'sender_id'         => $user,
                                        'receive_date'      => $date ,
                                        'ttype'             => 'Leadership Income',
                                        'TranDescription'   => 'Earn Leadership Income from $useridss for $packages Package',
                                        'Cause'             => 'Commission of USD $rwallet For Package $packages' ,
                                        'Remark'            => 'Leadership Income',
                                        'invoice_no'        => $invoice_no,
                                        'product_name'      => 'Leadership Income Level 3',
                                        'status'            => 0 ,
                                        'ewallet_used_by'   => 'Lotto Wallet' ,
                                        'current_url'       => $urls
                                    ]);
                $refcountc++;

  	   	}

  	}
      $ref=$income_id;
  	if($refcountc>0)
  	   	{
  	   		break;
  	   	}

  	}

  }

  public function commission_of_referal($ref,$useridss,$amount,$invoice_no,$packages) {
  	$date=date('Y-m-d');

  	$withdrawal_commission1= $amount *  (5 /100 );
    $withdrawal_commission = $withdrawal_commission1 - ($withdrawal_commission1 * 0.1);

  	$rwallets=$withdrawal_commission * (80/100);
  	$rwallets2=$withdrawal_commission * (20/100 );



    $investment = DB::table('lifejacket_subscription')->where('user_id',$ref)->sum('amount');
  	$rwallet=$rwallets;
  	$rwallet2=$rwallets2;


    if($investment > 0) {

      if($withdrawal_commission!='' && $withdrawal_commission!=0){

          $urls="http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

          DB::table('final_e_wallet')->where('user_id',$ref)->increment('amount', $rwallet);
          DB::table('final_forex_wallet')->where('user_id',$ref)->increment('amount', $rwallet2);


          DB::table('credit_debit')
                ->insert([
                            'transaction_no'    => $invoice_no,
                            'user_id'           => $ref,
                            'credit_amt'        => $rwallet,
                            'debit_amt'         => 0 ,
                            'admin_charge'      => 0,
                            'receiver_id'       => $ref,
                            'sender_id'         => $useridss,
                            'receive_date'      => $date ,
                            'ttype'             => 'Referral Income',
                            'TranDescription'   => 'Earn Referral Income from '.$useridss.' for ' . $packages .'Package',
                            'Cause'             => 'Commission of USD '.$rwallet .'For Package '.$packages,
                            'Remark'            => 'Referral Income',
                            'invoice_no'        => $invoice_no,
                            'product_name'      => 'Referral Income',
                            'status'            => 0 ,
                            'ewallet_used_by'   => 'E Wallet' ,
                            'current_url'       => $urls
                        ]);

                DB::table('credit_debit')
                        ->insert([
                                  'transaction_no'    => $invoice_no,
                                  'user_id'           => $ref,
                                  'credit_amt'        => $rwallet2,
                                  'debit_amt'         => 0 ,
                                  'admin_charge'      => 0,
                                  'receiver_id'       => $ref,
                                  'sender_id'         => $useridss,
                                  'receive_date'      => $date ,
                                  'ttype'             => 'Referral Income',
                                  'TranDescription'   => 'Earn Referral Income from '.$useridss.' for ' . $packages .'Package',
                                  'Cause'             => 'Commission of USD '.$rwallet2 .'For Package '.$packages,
                                  'Remark'            => 'Referral Income',
                                  'invoice_no'        => $invoice_no,
                                  'product_name'      => 'Referral Income ',
                                  'status'            => 0 ,
                                  'ewallet_used_by'   => 'Forex Wallet' ,
                                  'current_url'       => $urls
                              ]);
        }

    }



  }


  public function resetPass() {
              return view('registration.reset');

  }

  public function updatePass(Request $request) {

    $user_id    = $request->input('user_id');
    $email      = $request->input('email');

    $countUser = DB::table('user_registration')->where('user_id',$user_id)->where('email',$email)->count('id');

      if($countUser > 0) {

        $users = User::where('user_id',$user_id)->first();
        //$name  = User::where('email','louisesalas8.26@gmail.com')->first(['username']);
        $users->notify(new Registration('Password Reset',
                                         "Here's your Password",
                                         'Password : ' . DB::table('user_registration')->where('user_id',$user_id)
                                            ->first(['password'])->password
                             ));
                                return back()->with(['message' => 'Password has been sent']);
      }

      else {
                return back()->with(['message' => 'No account found']);
      }
  }
  public function resetTransPass() {
              return view('registration.transpassword');

  }

  public function updateTransPass(Request $request) {

    $user_id    = $request->input('user_id');
    $email      = $request->input('email');

    $countUser = DB::table('user_registration')->where('user_id',$user_id)->where('email',$email)->count('id');

      if( $countUser > 0 ) {

        $users = User::where('user_id',$user_id)->first();
        //$name  = User::where('email','louisesalas8.26@gmail.com')->first(['username']);
        $users->notify(new Registration('Transaction Password Reset',
                                         "Here's your Password",
                                         'Transaction Password : ' . DB::table('user_registration')->where('user_id',$user_id)
                                            ->first(['t_code'])->t_code
                             ));

                    return back()->with(['message' => 'Transaction Password has been sent']);
      }
      else {
                return back()->with(['message' => 'No account found']);
      }

  }

  public function sendMail(Request $request) {

      $senders= 'noreply@xinrox.com' ;
      $rc  = $request->input('email');
      $phone = $request->input('phone');
      $subject = 'XINROX TRADING GUIDE';
      $data=[

              'sender'  => 'noreply@xinrox.com',
              'receiver'  => $rc,
              'phone'  => $phone,
              'subject'   => $subject
      ];

      Mail::send('emails.ticket_info', [$data], function ($m) use ($data) {
         $m->from('noreply@xinrox.com', 'XINROX');
         $m->to($data['receiver'], $data['receiver'])->subject('TRADING GUIDE');
         $m->attach('learningtools.pdf',$options = []);
     });

     Mail::send('emails.ticket_status', ['data'=> $data], function ($m) use ($data) {
        $m->from('noreply@xinrox.com', 'XINROX');
        $m->to('lis.oyao@devcoretech.com', 'lis.oyao@devcoretech.com')->subject('FACEBOOK CAMPAIGN SIGNUP');

    });

     return back()->with(['message'=> 'Successfully submitted !. An ebook has been sent to your email','type'=>'success']);

    }
}
