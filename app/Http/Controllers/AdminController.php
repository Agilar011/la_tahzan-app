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
}
