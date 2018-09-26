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
  public function Create(Request $request)
  {
    //Here the a User is created and returned.
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);
    $user->save();

    return $user;
  }

  public function Delete(Request $request)
  {
    //Here the a User is deleted and returned.
    $user = User::find($request->id)->first;
    if(Gate::allows('user.delete', $user)){
      $backup = $user;
      $user->delete();
      return $backup;
    }else{
      return 401;
    }
  }

	//Storage the image to use as avatar
  public function AvatarUpdate(Request $request){
    $user = User::find($request->id);
    //Authorization verification
		if(Gate::allows('user.update', $user)){
			Storage::put('avatar/'.$user->id.'.png', $request);
			return 200;
		}else{
			return 401;
		}
  }
  //Update de User name, with the text sended by 'post'.
  public function NameUpdate(Request $request){
    $user = User::find($request->id);
    if(Gate::allows('user.update', $user)){
        //Saving the user requested with the new name.
        $user->name = $request->name;
        $user->save();
        return $user;
    }else{
      return 401;
    }
  }

  //Update the User email, with the text sended by 'post'.
  public function EmailUpdate(Request $request){
    $user = User::find($request->id);
    if(Gate::allows('user.update', $user)){
      //Saving the user requested with the new email.
      if(User::where('email', $request->email)->count() > 0){
        return 403;
      }
      $user->email = $request->email;
      $user->save();
      return $user;
    }else{
      return 401;
    }
  }

//Update the password, with a 'Hashed' text passed by 'post'.
  public function PasswordUpdate(Request $request){
    $user = User::find($request->id);
    if(Gate::allows('user.update', $user)){
      //Saving the user requested with the new password.
      $user->password = Hash::make($request->password);
      $user->save();
      return $user;
		}else{
		  return 401;
		}
  }

}
