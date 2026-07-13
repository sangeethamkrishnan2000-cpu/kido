<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
public function createUser(){
   
   
   $u = User::create([
   'name' => 'Geetha',
   'email' => 'geetha@gmail.com',
   'email_verified_at' => Carbon::now()
   ]);
   if($u) {
      return response()->json(['status' => 200, 'message' => 'Created succesfully']);
   }
}   

   public function index()
    {
        return response()->json(
            User::all()
        );
    }

}
