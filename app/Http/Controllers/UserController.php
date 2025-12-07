<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function showUsers()
    {
        $users = User::all();
        return view('user-dashboard', ['users' => $users]);
    }

    public function editUser(User $user)
    {
        return view('edit-user', ['user' => $user]);
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'is_admin' => 'boolean',
            'is_author' => 'boolean',
        ]);

        $user->update([
            'name' => $request->name,
            'firstname' => $request->firstname,
            'email' => $request->email,
            'is_admin' => $request->boolean('is_admin'),
            'is_author' => $request->boolean('is_author'),
        ]);

        return redirect()->route('admin-dashboard.users')->with('success', 'User updated successfully!');
    }

    public function deleteUser(User $user)
    {
        if ($user->is_admin){
            return redirect()->route('admin-dashboard.users')->with('error', 'Cannot delete an admin user!');
        }
        $user->delete();
        return redirect()->route('admin-dashboard.users')->with('success', 'User deleted successfully!');
    }
}
