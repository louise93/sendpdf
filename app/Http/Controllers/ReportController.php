<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class ReportController extends Controller
{
  public function __construct() {
      $this->middleware('auth');
  }
  public function sponsorincome() {

        $reports = DB::table('credit_debit')
                               ->whereIn('ttype', ['Referral Income', 'Binary Income', 'Profit Share Income'])
                                ->where('user_id',Auth::user()->user_id)
                                ->orderBy('id','desc')
                                ->paginate(10000);
        return view('reports.incomereports',compact('reports'));
  }
  public function searchIncome(Request $request) {

      $type       = $request->input('type');
      $date_from  = $request->input('date_from');
      $date_to    = $request->input('date_to');

      if($type =='all' && $date_from =='' && $date_to =='') {

          $reports = DB::table('credit_debit')
                                ->whereIn('ttype', ['Referral Income', 'Binary Income', 'Profit Share Income'])
                                ->where('user_id',Auth::user()->user_id)
                                ->orderBy('id','desc')
                                ->paginate(10000);
        return view('reports.incomereports',compact('reports'));
      }
      else if($type !='all' && $date_from =='' && $date_to =='') {

                $reports = DB::table('credit_debit')
                                 ->whereIn('ttype', [$type])
                                  ->where('user_id',Auth::user()->user_id)
                                  ->orderBy('id','desc')
                                  ->paginate(10000);
          return view('reports.incomereports',compact('reports'));

      }
      else if($type =='all' && $date_from !='' && $date_to !='') {

                $reports = DB::table('credit_debit')
                                  ->whereIn('ttype', ['Referral Income', 'Binary Income', 'Profit Share Income'])
                                  ->where('user_id',Auth::user()->user_id)
                                  ->where('receive_date','>=',$date_from)
                                  ->where('receive_date','<=',$date_to)
                                  ->orderBy('id','desc')
                                  ->paginate(10000);
          return view('reports.incomereports',compact('reports'));

      }
      else if($type !='all' && $date_from !='' && $date_to !='') {

                $reports = DB::table('credit_debit')
                                  ->whereIn('ttype', [$type])
                                  ->where('user_id',Auth::user()->user_id)
                                  ->where('receive_date','>=',$date_from)
                                  ->where('receive_date','<=',$date_to)
                                  ->orderBy('id','desc')
                                  ->paginate(10000);
              return view('reports.incomereports',compact('reports'));
      }
  }
  public function searchHistory(Request $request) {

      $user_id       = $request->input('user_id');
      $date_from     = $request->input('date_from');
      $date_to      = $request->input('date_to');
      if($user_id =='' && $date_from =='' && $date_to =='') {

            $reports = DB::table('credit_debit')
                              ->where('ttype', 'Fund Transfer')
                              ->where('user_id',Auth::user()->user_id)
                              ->orderBy('id','desc')
                              ->paginate(10000);

                  return view('reports.transactions',compact('reports'));
      }
      else if($user_id !='' && $date_from =='' && $date_to =='') {

                $reports = DB::table('credit_debit')
                                  ->where('ttype', 'Fund Transfer')
                                  ->where('user_id',Auth::user()->user_id)
                                  ->where('receiver_id',$user_id)
                                  ->orderBy('id','desc')
                                  ->paginate(10000);

                        return view('reports.transactions',compact('reports'));

      }
      else if($user_id =='' && $date_from !='' && $date_to !='') {

        $reports = DB::table('credit_debit')
                          ->where('ttype', 'Fund Transfer')
                          ->where('user_id',Auth::user()->user_id)
                          ->where('receive_date','>=',$date_from)
                          ->where('receive_date','<=',$date_to)
                          ->orderBy('id','desc')
                          ->paginate(10000);

                      return view('reports.transactions',compact('reports'));

      }
      else if($user_id !='' && $date_from !='' && $date_to !='') {

          $reports = DB::table('credit_debit')
                            ->where('ttype', 'Fund Transfer')
                            ->where('user_id',Auth::user()->user_id)
                            ->where('receive_date','>=',$date_from)
                            ->where('receive_date','<=',$date_to)
                            ->where('receiver_id',$user_id)
                            ->orderBy('id','desc')
                            ->paginate(10000);

              return view('reports.transactions',compact('reports'));
      }
  }
  public function transferHistory() {

    $reports = DB::table('credit_debit')
                      ->where('ttype', 'Fund Transfer')
                      ->where('user_id',Auth::user()->user_id)
                      ->orderBy('id','desc')
                      ->paginate(10000);

            return view('reports.transactions',compact('reports'));

  }
  public function matchingincome() {

      $matchingincome = DB::table('credit_debit')
                        ->where('ttype','Binary Income')
                        ->where('user_id',Auth::user()->user_id)
                        ->paginate(10);
    return view('reports.matchingincome',compact('matchingincome'));
  }


  public function leadershipincome() {

      $leadershipincome = DB::table('credit_debit')
                        ->where('ttype','Leadership Income')
                        ->where('user_id',Auth::user()->user_id)
                        ->paginate(10);
    return view('reports.leadershipincome',compact('leadershipincome'));
  }
  public function promotionalincome() {

      $promotionalincome = DB::table('credit_debit')
                        ->where('ttype','Promotional Income')
                        ->where('user_id',Auth::user()->user_id)
                        ->paginate(10);
    return view('reports.promotionalincome',compact('promotionalincome'));
  }

  public function profitshareincome() {

      $profitshareincome = DB::table('credit_debit')
                        ->where('ttype','Profit Share Income')
                        ->where('user_id',Auth::user()->user_id)
                        ->paginate(10);
              return view('reports.profitshareincome',compact('profitshareincome'));
  }
  public function poolbonus() {

      $poolbonus = DB::table('credit_debit')
                        ->where('ttype','Turnover Income')
                        ->where('user_id',Auth::user()->user_id)
                        ->paginate(10);
              return view('reports.poolbonus',compact('poolbonus'));
  }


  public function reward() {

            $reward = DB::table('credit_debit')
                        ->where('ttype','  Rewards Point')
                        ->where('user_id',Auth::user()->user_id)
                        ->paginate(10);
              return view('reports.reward',compact('reward'));
  }

  public function matchingpoints() {

      $matchingpoints = DB::table('manage_bv_history')
                        ->where('income_id',Auth::user()->user_id)
                        ->where('pair','<>',0)
                        ->orderBy('id','desc')
                        ->paginate(10000);
              return view('reports.matchingpoint',compact('matchingpoints'));
  }

}
