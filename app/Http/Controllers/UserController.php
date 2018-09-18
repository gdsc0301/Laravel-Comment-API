<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
	//Storage the image to use as avatar
    public function AvatarUpdate(Request $request){
      $user = User::find($request->id);
		if(Gate::allows('user.update', $user)){
			Storage::put('avatar/'.$user->id.'.png', $request);
			return true;
		}else{	
			return false;
		}
    }
	//Update de User name, with the text sended by 'post'.
    public function NameUpdate(Request $request){
      $user = User::find($request->id);
      if(Gate::allows('user.update', $user)){
          $user->name = $request->name;
          $user->save();
      }else{
        return false;
      }
    }
	
	//Update the User email, with the text sended by 'post'.
    public function EmailUpdate(Request $request){
      $user = User::find($request->id);
      if(Gate::allows('user.update', $user)){
          $user->email = $request->email;
          $user->save();
      }else{
        return false;
      }
    }
	
	//Update the password, with a 'Hashed' text passed by 'post'.
    public function PasswordUpdate(Request $request){
      $user = User::find($request->id);
      if(Gate::allows('user.update', $user)){
        $user->password = Hash::make($request->password);
        $user->save();
		}else{
		  return false;
		}
    }
}
