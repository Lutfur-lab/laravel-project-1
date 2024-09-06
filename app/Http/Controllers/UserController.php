<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'role' => 'required|string|in:user,super_user',
        ]);

        $user->role = $validatedData['role'];
        $user->save();

        return redirect()->route('users.index')->with('success', 'User role updated successfully.');
    }
}
