<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Auth;
use Hash;
use App\User;
use Session;
use Feeds;
use App\Notifications\UpdateNotif;
class ProfileController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index() {

     return view('profile.profile');
  }
  public function learning(){
    return view('profile.learningtool');
  }
  public function educational() {
    
     $feed = Feeds::make('https://medium.com/feed/xinrox');

      $items = $feed->get_items();
    return view('profile.education',compact('items'));
  }
  public function getBankInfo() {
     return view('profile.bank');
  }
  public function getWallet() {
     return view('profile.wallet');
  }
  public function getPassword() {
     return view('profile.password');
  }
  public function getTransPassword() {
     return view('profile.transactionpassword');
  }
  public function kyc() {

       return view('profile.kyc');
  }

  public function fileUploadPhoto(Request $request) {
    $this->validate($request, [
        'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);
    if ($request->hasFile('photo')) {
        $image = $request->file('photo');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/img');
        $image->move($destinationPath, $name);
          DB::table('user_registration')
              ->where('user_id',Auth::user()->user_id)
              ->update(['id_no' => $name]);
        return back()->with(['message','Image Upload successfully','type' =>'success']);
    }
      return back()->with(['message','Invalid image','type' =>'error']);
}
public function fileUploadID(Request $request) {
  $this->validate($request, [
      'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
  ]);
  if ($request->hasFile('photo')) {
      $image = $request->file('photo');
      $name = time().'.'.$image->getClientOriginalExtension();
      $destinationPath = public_path('/img');
      $image->move($destinationPath, $name);
        DB::table('user_registration')
            ->where('user_id',Auth::user()->user_id)
            ->update(['id_card' => $name]);
      return back()->with(['message','Image Upload successfully','type' =>'success']);
  }
    return back()->with(['message','Invalid image','type' =>'error']);
}
public function fileUploadAddress(Request $request) {
  $this->validate($request, [
      'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
  ]);
  if ($request->hasFile('photo')) {
      $image = $request->file('photo');
      $name = time().'.'.$image->getClientOriginalExtension();
      $destinationPath = public_path('/img');
      $image->move($destinationPath, $name);
        DB::table('user_registration')
            ->where('user_id',Auth::user()->user_id)
            ->update(['master_account' => $name]);
      return back()->with(['message','Image Upload successfully','type' =>'success']);
  }
    return back()->with(['message','Invalid image','type' =>'error']);
}
  public function getProfile() {

        $personal_info = DB::table('user_registration')
                        ->where('user_id',Auth::user()->user_id)
                        ->get();
          return response()->json($personal_info);
  }

  public function updateBank(Request $request) {

        $response_data =  ['type' => 'success' ,'message' => ''] ;

        DB::table('user_registration')
            ->where('user_id', Auth::user()->user_id)
            ->update($request->all());
         $response_data =  ['type' => 'success' ,'message' => 'Profile Has been updated'] ;

        return response()->json($response_data);

  }

  public function updatePassword(Request $request) {

        $response_data =  ['type' => 'success' ,'message' => ''] ;
        if (Hash::check($request->input('password'), Auth::user()->password)) {

            DB::table('user_registration')
                ->where('user_id', Auth::user()->user_id)
                ->update([
                        'password'  => Hash::make($request->input('new_password'))
                ]);

                $users = User::where('email',Auth::user()->email)->first();
                //$name  = User::where('email','louisesalas8.26@gmail.com')->first(['username']);
                $users->notify(new UpdateNotif('Password Changed',"Password has been updated of account id :" . Auth::user()->user_id,Auth::user()->username,$request->input('new_password')));
             $response_data =  ['type' => 'success' ,'message' => 'Password Has been updated'] ;
        }

        else {
               $response_data =  ['type' => 'error' ,'message' => 'Current Password is incorrect'] ;
        }

      return response()->json($response_data);

  }
  public function updateTransPassword(Request $request) {

        $response_data =  ['type' => 'success' ,'message' => ''] ;
        if (DB::table('user_registration')->where('t_code' ,$request->input('password'))->where('user_id',Auth::user()->user_id)->count('id') > 0) {

            DB::table('user_registration')
                ->where('user_id', Auth::user()->user_id)
                ->update([
                        't_code'  => $request->input('new_password')
                ]);

                $users = User::where('email',Auth::user()->email)->first();
                //$name  = User::where('email','louisesalas8.26@gmail.com')->first(['username']);
                $users->notify(new UpdateNotif('Password Changed',"Transaction Password has been updated of account id :" . Auth::user()->user_id,Auth::user()->username,$request->input('new_password')));
             $response_data =  ['type' => 'success' ,'message' => 'Transaction Password Has been updated'] ;
        }

        else {
               $response_data =  ['type' => 'error' ,'message' => 'Current Transaction Password is incorrect'] ;
        }



        return response()->json($response_data);

  }
  public function updateWallet(Request $request) {

        $response_data =  ['type' => 'success' ,'message' => ''] ;

        DB::table('user_registration')
            ->where('user_id', Auth::user()->user_id)
            ->update($request->all());
         $response_data =  ['type' => 'success' ,'message' => 'Profile Has been updated'] ;

        return response()->json($response_data);

  }


  public function updateProfile(Request $request) {

          $username = Auth::user()->username ;
          $response_data =  ['type' => 'success' ,'message' => ''] ;

          if($request->input('username') != $username && !empty($request->input('username')) ) {
                $validatedData = DB::table('user_registration')
                                  ->where('username',$request->input('username'))
                                  ->count('user_id');

                   if($validatedData > 0) {

                        $response_data =  ['type' => 'error' ,'message' => 'Username already taken'] ;
                   }
                   else {
                          DB::table('user_registration')
                              ->where('user_id', Auth::user()->user_id)
                              ->update($request->all());
                           $response_data =  ['type' => 'success' ,'message' => 'Profile Has been updated'] ;
                   }

          }
          else {
                if(empty($request->input('username'))) {
                      $response_data =  ['type' => 'error' ,'message' => 'Username cannot be blank'] ;
                }
                else {
                    DB::table('user_registration')
                        ->where('user_id', Auth::user()->user_id)
                        ->update($request->all());
                    $response_data =  ['type' => 'success' ,'message' => 'Profile has been updated'] ;
                }

          }

          return response()->json($response_data);

  }

}
