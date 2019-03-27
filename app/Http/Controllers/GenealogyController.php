<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;
use Notification;

use App\Notifications\FundTransfer;

class GenealogyController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index(Request $request) {
      $user_id = $request->input('user_id');
      $auth_user = Auth::user()->user_id;
      $response = [] ;
      if(!empty($user_id)) {
        $response = DB::table('user_registration')
                          ->where('ref_id',Auth::user()->user_id)
                          ->where('user_id',$user_id)
                          ->orWhere('username',$user_id)
                          ->orWhere('username',$user_id)
                            ->orderBy('id','DESC')
                          ->paginate(10000);

           return view('genealogy.directsponsor',compact('response','auth_user'));

      }
      else {
        $response = DB::table('user_registration')
                          ->where('ref_id',Auth::user()->user_id)
                            ->orderBy('id','DESC')
                          ->paginate(10000);

           return view('genealogy.directsponsor',compact('response','auth_user'));

      }

  }

  public function downlines(Request $request) {
      $user_id = $request->input('user_id');
      $auth_user = Auth::user()->user_id;
      $response = [] ;
      if(!empty($user_id)) {
        $response = DB::table('level_income_binary')
                          ->where('income_id',Auth::user()->user_id)
                          ->where('down_id',$user_id)
                          ->orderBy('id','DESC')
                          ->paginate(10000);

           return view('genealogy.directsponsor',compact('response','auth_user'));

      }
      else {
        $response = DB::table('level_income_binary')
                          ->where('income_id',Auth::user()->user_id)
                            ->orderBy('id','DESC')
                          ->paginate(10000);

           return view('genealogy.downlines',compact('response','auth_user'));

      }
  }

  public function sponsorTree($user_id) {

      $user =  DB::table('user_registration')->where('ref_id',$user_id)->get();
      return view('genealogy.sponsor',compact('user','user_id'));

  }
  public function sponsorTreeDefault() {

      $user =  DB::table('user_registration')->where('ref_id',Auth::user()->user_id)->get();

        $user_id =   Auth::user()->user_id;
      return view('genealogy.sponsor',compact('user','user_id'));

  }

  public function binaryTreeDefault(Request $request) {

        $user =  DB::table('user_registration')->where('ref_id',Auth::user()->user_id)->get();

        $user_id =   Auth::user()->user_id;

        //FIRST LEVEL TWO USERS
        $fetch1 =  DB::table('user_registration')
                        ->where('nom_id',$user_id)
                        ->where('binary_pos','left')
                        ->pluck('user_id');

        $info1  =  (count($fetch1) > 0  ? $fetch1[0] : "0") ;

        $user1   =  DB::table('user_registration')
                              ->where('user_id',$info1)
                              ->first(['username','user_id','registration_date','user_plan']);

        $fetch8 =DB::table('user_registration')
                        ->where('nom_id',$user_id)
                        ->where('binary_pos','right')
                          ->pluck('user_id');
        $info8  =    (count($fetch8) > 0   ? $fetch8[0] : '0');

        $user8   =  DB::table('user_registration')
                              ->where('user_id',$info8)
                              ->first(['username','user_id','registration_date','user_plan']);
         //FIRST LEVEL TWO USERS END HERE

         /*second level four user start here */
         $fetch2 =  DB::table('user_registration')
                         ->where('nom_id',$info1)
                         ->where('binary_pos','left')
                           ->pluck('user_id');
          $info2= (count($fetch2) >0  ? $fetch2[0] : '0');

          $user2 = DB::table('user_registration')
                                ->where('user_id',$info2)
                                ->first(['username','user_id','registration_date','user_plan']);

         $fetch5 = DB::table('user_registration')
                         ->where('nom_id',$info1)
                         ->where('binary_pos','right')
                          ->pluck('user_id');



          $info5=  (count($fetch5) > 0  ? $fetch5[0] : '0');
         $user5 =  DB::table('user_registration')
                               ->where('user_id',$info5)
                               ->first(['username','user_id','registration_date','user_plan']);

        $fetch9= DB::table('user_registration')
                      ->where('nom_id',$info8)
                      ->where('binary_pos','left')
                        ->pluck('user_id');

        //$info9=$fetch9;


          $info9= (count($fetch9) > 0 ? $fetch9[0] : '0');
        $user9=DB::table('user_registration')
                          ->where('user_id',$info9)
                          ->first(['username','user_id','registration_date','user_plan']);


       $fetch12 =  DB::table('user_registration')
                    ->where('nom_id',$info8)
                    ->where('binary_pos','right')
                      ->pluck('user_id');



          $info12=  (count($fetch12) > 0 ? $fetch12[0] : '0');
        $user12=  DB::table('user_registration')
                          ->where('user_id',$info12)
                          ->first(['username','user_id','registration_date','user_plan']);
         /*second level four user ends here */

        /*third level eight user starts here */

          $fetch3 = DB::table('user_registration')
                       ->where('nom_id',$info2)
                       ->where('binary_pos','left')
                         ->pluck('user_id');


          $info3= (count($fetch3) > 0 ? $fetch3[0] : '0');
          $user3 =  DB::table('user_registration')
                            ->where('user_id',$info3)
                            ->first(['username','user_id','registration_date','user_plan']);


          $fetch4 = DB::table('user_registration')
                      ->where('nom_id',$info2)
                      ->where('binary_pos','right')
                        ->pluck('user_id');

            $info4 = (count($fetch4) > 0 ? $fetch4[0] : '0');
            $user4 = DB::table('user_registration')
                              ->where('user_id',$info4)
                              ->first(['username','user_id','registration_date','user_plan']);

          $fetch6 = DB::table('user_registration')
                      ->where('nom_id',$info5)
                      ->where('binary_pos','left')
                        ->pluck('user_id');


          $info6 = (count($fetch6) > 0 ? $fetch6[0] : '0');
          $user6 = DB::table('user_registration')
                            ->where('user_id',$info6)
                            ->first(['username','user_id','registration_date','user_plan']);

          $fetch7 =  DB::table('user_registration')
                      ->where('nom_id',$info5)
                      ->where('binary_pos','right')
                        ->pluck('user_id');

            $info7 = (count($fetch7) > 0 ? $fetch7[0] : '0');
            $user7 =  DB::table('user_registration')
                              ->where('user_id',$info7)
                              ->first(['username','user_id','registration_date','user_plan']);

            $fetch10 =    DB::table('user_registration')
                        ->where('nom_id',$info9)
                        ->where('binary_pos','left')
                          ->pluck('user_id');

                          //$info10=$fetch10;

              $info10 =  (count($fetch10) > 0 ? $fetch10[0] : '0');
            $user10 = DB::table('user_registration')
                              ->where('user_id',$info10)
                              ->first(['username','user_id','registration_date','user_plan']);

          $fetch11  =    DB::table('user_registration')
                          ->where('nom_id',$info9)
                          ->where('binary_pos','right')
                            ->pluck('user_id');
        //$info11=$fetch11;

          $info11 =  (count( $fetch11) > 0 ? $fetch11[0] : '0');
          $user11 =  DB::table('user_registration')
                            ->where('user_id',$info11)
                            ->first(['username','user_id','registration_date','user_plan']);

         $fetch13 =  DB::table('user_registration')
                        ->where('nom_id',$info12)
                        ->where('binary_pos','left')
                          ->pluck('user_id');

          //$info13=$fetch13;
          $info13 =  (count($fetch13) > 0 ? $fetch13[0] : '0');
          $user13 =  DB::table('user_registration')
                            ->where('user_id',$info13)
                            ->first(['username','user_id','registration_date','user_plan']);



          $fetch14 =  DB::table('user_registration')
                         ->where('nom_id',$info12)
                         ->where('binary_pos','right')
                          ->pluck('user_id');
            //$info14= "" .$fetch14;

          $info14 =  (count($fetch14) > 0 ? $fetch14[0] : '0');
          $user14 =  DB::table('user_registration')
                            ->where('user_id',$info14)
                            ->first(['username','user_id','registration_date','user_plan']);

        /*third level eight user ends here */

          return view('genealogy.genealogytree',compact('user','user_id','user1','user2','user3','user4','user5','user6','user7','user8','user9','user10','user11','user12','user13','user14','info1','info2','info3','info4','info5','info6','info7','info8','info9','info10','info11','info12','info13','info14'));

  }
  public function  registerView(){
     return view('genealogy.reg_search');
  }

  public function searchSponsor(Request $request) {
    $user =  DB::table('level_income_binary')
              ->where('down_id',$request->input('username'))
              ->where('income_id',Auth::user()->user_id)
              ->count('id');

    if($user == 0) {

      return redirect()->back()->with(['error' => 'User ID not found in your downlines']);

    }
     $user_id =   $request->input('username');


     return redirect('/genealogy/networktree/'.$user_id);
    // $this->binaryTreeSearch($user_id);

  }
  public function binaryTreeSearch($user_id) {

        $user =  DB::table('user_registration')->where('ref_id',Auth::user()->user_id)->get();

      //  $user_id =   Auth::user()->user_id;


        //FIRST LEVEL TWO USERS
        $fetch1 =  DB::table('user_registration')
                        ->where('nom_id',$user_id)
                        ->where('binary_pos','left')
                        ->pluck('user_id');

        $info1  =  (count($fetch1) > 0  ? $fetch1[0] : "0") ;

        $user1   =  DB::table('user_registration')
                              ->where('user_id',$info1)
                              ->first(['username','user_id','registration_date','user_plan','binary_pos']);

        $fetch8 =DB::table('user_registration')
                        ->where('nom_id',$user_id)
                        ->where('binary_pos','right')
                          ->pluck('user_id');
        $info8  =    (count($fetch8) > 0   ? $fetch8[0] : '0');

        $user8   =  DB::table('user_registration')
                              ->where('user_id',$info8)
                              ->first(['username','user_id','registration_date','user_plan']);
         //FIRST LEVEL TWO USERS END HERE

         /*second level four user start here */
         $fetch2 =  DB::table('user_registration')
                         ->where('nom_id',$info1)
                         ->where('binary_pos','left')
                           ->pluck('user_id');

          $info2= (count($fetch2) >0  ? $fetch2[0] : '0');

          $user2 = DB::table('user_registration')
                                ->where('user_id',$info2)
                                ->first(['username','user_id','registration_date','user_plan']);

         $fetch5 = DB::table('user_registration')
                         ->where('nom_id',$info1)
                         ->where('binary_pos','right')
                          ->pluck('user_id');



          $info5=  (count($fetch5) > 0  ? $fetch5[0] : '0');
         $user5 =  DB::table('user_registration')
                               ->where('user_id',$info5)
                               ->first(['username','user_id','registration_date','user_plan']);

        $fetch9= DB::table('user_registration')
                      ->where('nom_id',$info8)
                      ->where('binary_pos','left')
                        ->pluck('user_id');

        //$info9=$fetch9;


          $info9= (count($fetch9) > 0 ? $fetch9[0] : '0');
        $user9=DB::table('user_registration')
                          ->where('user_id',$info9)
                          ->first(['username','user_id','registration_date','user_plan']);


       $fetch12 =  DB::table('user_registration')
                    ->where('nom_id',$info8)
                    ->where('binary_pos','right')
                      ->pluck('user_id');



          $info12=  (count($fetch12) > 0 ? $fetch12[0] : '0');
        $user12=  DB::table('user_registration')
                          ->where('user_id',$info12)
                          ->first(['username','user_id','registration_date','user_plan']);
         /*second level four user ends here */

        /*third level eight user starts here */

          $fetch3 = DB::table('user_registration')
                       ->where('nom_id',$info2)
                       ->where('binary_pos','left')
                         ->pluck('user_id');


          $info3= (count($fetch3) > 0 ? $fetch3[0] : '0');
          $user3 =  DB::table('user_registration')
                            ->where('user_id',$info3)
                            ->first(['username','user_id','registration_date','user_plan']);


          $fetch4 = DB::table('user_registration')
                      ->where('nom_id',$info2)
                      ->where('binary_pos','right')
                        ->pluck('user_id');

            $info4 = (count($fetch4) > 0 ? $fetch4[0] : '0');
            $user4 = DB::table('user_registration')
                              ->where('user_id',$info4)
                              ->first(['username','user_id','registration_date','user_plan']);

          $fetch6 = DB::table('user_registration')
                      ->where('nom_id',$info5)
                      ->where('binary_pos','left')
                        ->pluck('user_id');


          $info6 = (count($fetch6) > 0 ? $fetch6[0] : '0');
          $user6 = DB::table('user_registration')
                            ->where('user_id',$info6)
                            ->first(['username','user_id','registration_date','user_plan']);

          $fetch7 =  DB::table('user_registration')
                      ->where('nom_id',$info5)
                      ->where('binary_pos','right')
                        ->pluck('user_id');

            $info7 = (count($fetch7) > 0 ? $fetch7[0] : '0');
            $user7 =  DB::table('user_registration')
                              ->where('user_id',$info7)
                              ->first(['username','user_id','registration_date','user_plan']);

            $fetch10 =    DB::table('user_registration')
                        ->where('nom_id',$info9)
                        ->where('binary_pos','left')
                          ->pluck('user_id');

                          //$info10=$fetch10;

              $info10 =  (count($fetch10) > 0 ? $fetch10[0] : '0');
            $user10 = DB::table('user_registration')
                              ->where('user_id',$info10)
                              ->first(['username','user_id','registration_date','user_plan']);

          $fetch11  =    DB::table('user_registration')
                          ->where('nom_id',$info9)
                          ->where('binary_pos','right')
                            ->pluck('user_id');
        //$info11=$fetch11;

          $info11 =  (count( $fetch11) > 0 ? $fetch11[0] : '0');
          $user11 =  DB::table('user_registration')
                            ->where('user_id',$info11)
                            ->first(['username','user_id','registration_date','user_plan']);

         $fetch13 =  DB::table('user_registration')
                        ->where('nom_id',$info12)
                        ->where('binary_pos','left')
                          ->pluck('user_id');

          //$info13=$fetch13;

          $info13 =  (count($fetch13) > 0 ? $fetch13[0] : '0');
          $user13 =  DB::table('user_registration')
                            ->where('user_id',$info13)
                            ->first(['username','user_id','registration_date','user_plan']);


          $fetch14 =  DB::table('user_registration')
                         ->where('nom_id',$info12)
                         ->where('binary_pos','right')
                          ->pluck('user_id');
            //$info14= "" .$fetch14;

          $info14 =  (count($fetch14) > 0 ? $fetch14[0] : '0');
          $user14 =  DB::table('user_registration')
                            ->where('user_id',$info13)
                            ->first(['username','user_id','registration_date','user_plan']);

        /*third level eight user ends here */

      return view('genealogy.genealogytree',compact('user','user_id','user1','user2','user3','user4','user5','user6','user7','user8','user9','user10','user11','user12','user13','user14','info1','info2','info3','info4','info5','info6','info7','info8','info9','info10','info11','info12','info13','info14'));

  }

  public function left_member_count($userid)
  {
    $left_member_count= DB::table('level_income_binary')
                              ->where('income_id',$userid)
                              ->where('leg','left')
                              ->count('id');


      return left_member_count;
  }

  public function right_member_count($userid)
  {

    $right_member_count  = DB::table('level_income_binary')
                                    ->where('income_id',$userid)
                                    ->where('leg','right')
                                    ->count('id');

      return $right_member_count;
  }

  public function left_bv_count($userid) {

    $left_bv_count = DB::table('manage_bv_history')
                            ->where('income_id',$userid)
                            ->where('position','left')
                            ->where('description','<>','Carry Forward BV')
                            ->sum('pair');


       if($left_bv_count !=0 || $left_bv_count !='') {
          return $left_bv_count;
         }
         else {
            return 0;
          }

  }
  public function right_bv_count($userid) {

    $right_bv_count= DB::table('manage_bv_history')
                             ->where('income_id',$userid)
                             ->where('position','right')
                             ->where('description','<>','Carry Forward BV')
                             ->sum('pair');


        if( $right_bv_count !=0 || $right_bv_count !='' ) {
              return $right_bv_count;
          }
          else {
              return 0;
           }

  }

  public function left_bv_count_today($userid) {


     $left_bv_count_today= DB::table('manage_bv_history')
                              ->where('income_id',$userid)
                              ->where('position','left')
                              ->where('description','<>','Carry Forward BV')
                              ->where('status','0')
                              ->where('date',daate('Y-m-d'))
                              ->sum('pair');


         if( $left_bv_count_today !=0 || $left_bv_count_today !='' ) {
               return $left_bv_count_today;
           }
           else {
               return 0;
            }
  }

  public function right_bv_count_today($userid) {

     $right_bv_count_today= DB::table('manage_bv_history')
                              ->where('income_id',$userid)
                              ->where('position','right')
                              ->where('description','<>','Carry Forward BV')
                              ->where('status','0')
                              ->where('date',daate('Y-m-d'))
                              ->sum('pair');


         if( $right_bv_count_today !=0 || $right_bv_count_today !='' ) {
               return $right_bv_count_today;
           }
           else {
               return 0;
            }
  }

  public function left_carry_count($userid) {

     $left_carry_count= DB::table('manage_bv_history')
                              ->where('income_id',$userid)
                              ->where('position','left')
                              ->where('description','Carry Forward BV')
                              ->where('status','0')
                              ->sum('pair');


         if( $left_carry_count !=0 || $left_carry_count !='' ) {
               return $left_carry_count;
           }
           else {
               return 0;
            }

  }

  public function right_carry_count($userid) {
    $right_carry_count= DB::table('manage_bv_history')
                             ->where('income_id',$userid)
                             ->where('position','right')
                             ->where('description','Carry Forward BV')
                             ->where('status','0')
                             ->sum('pair');

        if( $right_carry_count !=0 || $right_carry_count !='' ) {
              return $right_carry_count;
          }
          else {
              return 0;
           }
   }

   public function getReg(){

     return view('registration.reg');
   }
}
