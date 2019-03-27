<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;

class DashboardController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function index() {
      if(Auth::user()->is_admin == 1) {
            return view('admin.dashboard.index');
      }

      else {

        return redirect('/dashboard');
      }

  }

}
