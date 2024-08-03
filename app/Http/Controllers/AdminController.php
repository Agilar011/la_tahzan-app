<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Mengambil semua data pengguna
        $users = User::all();

        // Mengembalikan view dengan data pengguna
        return view('admin.user', compact('users'));
    }

    public function changeRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $roles = ['customer', 'seller', 'admin'];
        $currentRoleIndex = array_search($user->role, $roles);
        $newRoleIndex = ($currentRoleIndex + 1) % count($roles);
        $user->role = $roles[$newRoleIndex];
        $user->save();

        return response()->json(['status' => 'success', 'new_role' => $user->role]);
    }

    public function changeSellerType(Request $request, $id)
    {
    $user = User::findOrFail($id);

    if ($user->role !== 'seller') {
        return response()->json([
            'status' => 'error',
            'message' => 'User must be a seller to change seller type'
        ]);
    }

    $currentStatus = $user->status_seller;
    $newStatus = '';

    if ($currentStatus === 'Common') {
        $newStatus = 'VIP';
    } elseif ($currentStatus === 'VIP') {
        $newStatus = 'Star Seller';
    } elseif ($currentStatus === 'Star Seller') {
        $newStatus = 'Common';
    } else {
        $newStatus = 'Common';
    }

    $user->status_seller = $newStatus;
    $user->save();

    return response()->json([
        'status' => 'success',
        'new_status_seller' => $user->status_seller
    ]);
    }

}
