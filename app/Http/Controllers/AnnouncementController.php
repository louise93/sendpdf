<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class AnnouncementController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index() {

     return view('announcement.index');
  }

  public function getAnnouncement() {

        $list = DB::table('promo')->where('status',0)
                  ->get();


        return response()->json($list);
  }

  public function detail($n_id) {
    $detail = DB::table('promo')->where('status',0)
              ->first(['news_name','description','posted_date']);

       return view('announcement.detail',compact('detail'));
  }

}
