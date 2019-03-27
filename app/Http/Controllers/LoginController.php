<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Session;
use Auth;
use DB;
class LoginController extends Controller
{
  // public function __construct() {
  //     $this->middleware('auth');
  // }
  //
  public function login(Request $request) {
        $username = $request->input('username');
        $password = $request->input('password');

          $userCount = DB::table('user_registration')
                            ->where('username',$username)
                            ->where('password',$password)
                            ->count('id');
          if($userCount > 0) {
            $user_id = DB::table('user_registration')
                              ->where('username',$username)
                              ->where('password',$password)
                              ->first(['id'])->id;

                      Auth::loginUsingId($user_id);


                      

                   return redirect()->intended('dashboard');
          }

          else {
              return back()->with(['message' => 'Invalid Login']);
          }


  }
}
