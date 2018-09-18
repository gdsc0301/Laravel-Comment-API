<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function AvatarUpdate(Request $request){
      if(Gate::allows('user.update', Auth::user())){
        //$request->image->store('avatars');
        //Storage::put('avatar/'.Auth::user()->id.'.png', $request);
        return response()->json($request);
      }else{
        return $request;
      }
    }

    public function NameUpdate(Request $request){
      $user = User::find($request->id);
      if(Gate::allows('user.update', $user)){
          $user->name = $request->name;
          $user->save();
      }else{
        return false;
      }
    }
    public function EmailUpdate(Request $request){
      $user = User::find($request->id);
      if(Gate::allows('user.update', $user)){
          $user->email = $request->email;
          $user->save();
      }else{
        return false;
      }
    }
    public function PasswordUpdate(Request $request){
      $user = User::find($request->id);
      if(Gate::allows('user.update', $user)){
          $user->password = $request->password;
          $user->save();
      }else{
        return false;
      }
    }
}
