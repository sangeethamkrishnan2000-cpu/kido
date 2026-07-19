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
    public function destroy(User $user)
   {
    $user->delete();

    return response()->json([
        'message' => 'User deleted successfully'
    ], 200);
}
public function update(Request $request, User $user)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
    ]);

    $user->update($validated);

    return response()->json([
        'message' => 'User updated successfully',
        'data' => $user,
    ], 200);
}

}
