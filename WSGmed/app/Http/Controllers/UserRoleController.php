<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    /**
     * Display a listing of users with their roles.
     */
    public function index()
    {
        $users = User::all();
        return view('roles.index', compact('users'));
    }

    /**
     * Update the role of a user.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'role' => 'required|in:patient,staff,admin',
        ]);

        $user->update($validated);

        return redirect()->route('roles.index')->with('success', 'Rola użytkownika została zaktualizowana.');
    }
}
