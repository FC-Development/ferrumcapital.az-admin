<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Str;


class UserController extends Controller
{
       private User $user;
       public function __construct(User $user)
       {
              $this->user = $user;
       }
    //
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
       
       public function store(Request $request)
       {
              $data = $request->validate([
                     'email' => 'required|email',
                     'password' => 'required'
              ]);
              if(Auth::attempt($data)){
                     $request->session()->regenerate();
                     return response(['message'=> "Success"],201);
              } else{
                     return response(['message'=>'bad cred'],401);
              }
       }
       public function GetUsers()
       {
              $users = $this->user::all();
              return response($users);
       }
       public function registerUser()
       {
              $attribute=request()->validate([
                     'username'=> ["required","max:255","min:3","unique:mysql2.adminpanel_user,username"],
                     'email'=>["required","email","max:255",'unique:mysql2.adminpanel_user,email'],
                     'password'=>'required|min:7|max:255'
                 ]);
              $user = $this->user::create([
                     'uniq_id' => Str::random(9),
                     'username' => htmlentities($attribute['username']),
                     'email' => \htmlentities($attribute['email']),
                     'password' => htmlentities($attribute['password']),
                     'role_id' => request()->input('role')
              ]);
              return response($user);
       }
       public function registerPage()
       {
              return view('dashboard.main-web.user');
       }
       public function destroy(Request $request)
       {
              auth()->logout();
              $request->session()->invalidate();
              $request->session()->regenerateToken();
              return response(['message'=>'Logout'],201);
       }
       public function deleteUser(Request $request)
       {
              $uniq_id = $request->input('uniq_id');
              $user = $this->user::where('uniq_id',$uniq_id);
              $user->delete();
              return response('Deleted',200);
       }
       public function updateUserRole(Request $request)
       {
              $uniq_id = $request->input('uniq_id');
              $role = $request->input('role');
              $this->user::where('uniq_id',$uniq_id)->update(['role_id'=> $role]);
              return response()->json(['msg'=>"Updated"],201);
       }
}
