<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function index()
    {
        // Only admin can access
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }
        $users = User::where('role', '!=', 'admin')->get();
        return view('roles.index', compact('users'));
    }

    public function update(Request $request)
    {
        // Only admin can update
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|in:user,staff',
        ]);
        $user = User::findOrFail($request->user_id);
        $user->role = $request->role;
        $user->save();
        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }
} 