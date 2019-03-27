<?php
use Illuminate\Support\Facades\DB;
  function isActiveRoute($route, $output = 'active')
    {
        if (Route::currentRouteName() == $route) {
            return $output;
        }
    }

  function left_member_count($userid)  {


      $count = DB::table('level_income_binary')
                                ->where('income_id',$userid)
                                ->where('leg','left')
                                ->count('id');


        return $count;
    }

   function right_member_count($userid)
    {

      $right_member_count  = DB::table('level_income_binary')
                                      ->where('income_id',$userid)
                                      ->where('leg','right')
                                      ->count('id');

        return $right_member_count;
    }

   function left_bv_count($userid) {

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
   function right_bv_count($userid) {

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

   function left_bv_count_today($userid) {


       $left_bv_count_today= DB::table('manage_bv_history')
                                ->where('income_id',$userid)
                                ->where('position','left')
                                ->where('description','<>','Carry Forward BV')
                                ->where('status','0')
                                ->where('date',date('Y-m-d'))
                                ->sum('pair');


           if( $left_bv_count_today !=0 || $left_bv_count_today !='' ) {
                 return $left_bv_count_today;
             }
             else {
                 return 0;
              }
    }

   function right_bv_count_today($userid) {

       $right_bv_count_today= DB::table('manage_bv_history')
                                ->where('income_id',$userid)
                                ->where('position','right')
                                ->where('description','<>','Carry Forward BV')
                                ->where('status','0')
                                ->where('date',date('Y-m-d'))
                                ->sum('pair');


           if( $right_bv_count_today !=0 || $right_bv_count_today !='' ) {
                 return $right_bv_count_today;
             }
             else {
                 return 0;
              }
    }

       function left_bv_count_week($userid) {


           $left_bv_count_today= DB::table('manage_bv_history')
                                    ->where('income_id',$userid)
                                    ->where('position','left')
                                    ->where('description','=','Package Purchase Amount')
                                    ->where('status','0')
                                    ->sum('pair');


               if( $left_bv_count_today !=0 || $left_bv_count_today !='' ) {
                     return $left_bv_count_today;
                 }
                 else {
                     return 0;
                  }
        }
    function right_bv_count_week($userid) {

        $right_bv_count_today= DB::table('manage_bv_history')
                                 ->where('income_id',$userid)
                                 ->where('position','right')
                                 ->where('description','=','Package Purchase Amount')
                                 ->where('status','0')
                                 ->sum('pair');

            if( $right_bv_count_today !=0 || $right_bv_count_today !='' ) {
                  return $right_bv_count_today;
              }
              else {
                  return 0;
               }
     }
   function left_carry_count($userid) {

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

   function right_carry_count($userid) {
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
