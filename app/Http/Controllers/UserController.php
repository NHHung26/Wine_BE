<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserController extends Controller
{
    //
    function getData()
    {
        return User::all();
    }
    function register(Request $req)
    {
        $user = new User;
        $user->username = $req->input('username');
        $user->password = Hash::make($req->input('password'));
        $user->email = $req->input('email');
        $user->role = $req->input('role');
        $user->created_at = Carbon::now();
        $user->updated_at = $user->created_at;
        $user->save();

        return $user;
    }
    function editUser(Request $req, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Người dùng không tồn tại'], 404);
        }

        $user->username = $req->input('username');
        $user->email = $req->input('email');
        $user->password = Hash::make($req->input('password'));
        $user->role = $req->input('role');
        $user->updated_at = Carbon::now();
        $user->save();

        return $user;
    }

    function deleteUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Người dùng không tồn tại'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'Xóa người dùng thành công'], 200);
    }

    function getUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Người dùng không tồn tại'], 404);
        }

        return $user;
    }
}
