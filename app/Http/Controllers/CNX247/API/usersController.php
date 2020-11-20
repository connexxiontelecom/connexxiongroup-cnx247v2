<?php

namespace App\Http\Controllers\CNX247\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
class usersController extends Controller
{
		//
		public function users(Request $request)
		{
			$tenant_id = $request->input("tenant_id");
			$users = User::where('users.tenant_id', $tenant_id)->get();
			foreach($users as $user)
			{
				   /* parse profile picture */
					 $user["avatar"] = url("/assets/images/avatars/thumbnails/" . $user["avatar"]);
			}
			return response()->json(['users' => $users,
		], 500);
		}


}//end class
