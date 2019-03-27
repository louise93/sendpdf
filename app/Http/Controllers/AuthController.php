<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use User;
use Auth;
class AuthController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function postLogin(Request $request){

    if ($user = User::where('username', request()->email)->where('password', request()->password)->first()) {
          // Auth::login($user);
          // return redirect()->to('/home');
          echo var_dump($user);
            return redirect()->back()->with(['error' => 'Invalid User']);
      }
      else {
            return redirect()->back()->with(['error' => 'Invalid User']);
      }
  }
}
