<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Validator;

class UserDetailController extends Controller
{
    // Lấy thông tin chi tiết người dùng
    public function getUserDetail($userId)
    {
        $userDetail = UserDetail::where('user_id', $userId)->first();

        if (!$userDetail) {
            return response()->json(['message' => 'Thông tin chi tiết người dùng không tồn tại'], 404);
        }

        return $userDetail;
    }

    // Thêm thông tin chi tiết người dùng mới
    public function addUserDetail(Request $request, $userId)
    {
        $validator = Validator::make($request->all(), [
            'fullName' => 'max:50',
            'phone' => 'max:20',
            'address' => 'max:100',
            'email' => 'max:50|email',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 400);
        }

        $userDetail = new UserDetail;
        $userDetail->user_id = $userId;
        $userDetail->fullName = $request->input('fullName');
        $userDetail->phone = $request->input('phone');
        $userDetail->address = $request->input('address');
        $userDetail->email = $request->input('email');
        $userDetail->save();

        return $userDetail;
    }

    // Sửa thông tin chi tiết người dùng
    public function editUserDetail(Request $request, $userId)
    {
        $userDetail = UserDetail::where('user_id', $userId)->first();

        if (!$userDetail) {
            return response()->json(['message' => 'Thông tin chi tiết người dùng không tồn tại'], 404);
        }

        $validator = Validator::make($request->all(), [
            'fullName' => 'max:50',
            'phone' => 'max:20',
            'address' => 'max:100',
            'email' => 'max:50|email',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 400);
        }

        $userDetail->fullName = $request->input('fullName');
        $userDetail->phone = $request->input('phone');
        $userDetail->address = $request->input('address');
        $userDetail->email = $request->input('email');
        $userDetail->save();

        return $userDetail;
    }

    // Xóa thông tin chi tiết người dùng
    public function deleteUserDetail($userId)
    {
        $userDetail = UserDetail::where('user_id', $userId)->first();

        if (!$userDetail) {
            return response()->json(['message' => 'Thông tin chi tiết người dùng không tồn tại'], 404);
        }

        $userDetail->delete();

        return response()->json(['message' => 'Xóa thông tin chi tiết người dùng thành công'], 200);
    }
}
