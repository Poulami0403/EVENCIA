<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();

        return view('users.list', compact('users'));
    }

    public function updateStatus(Request $request, User $user)
{
    $request->validate([
        'status' => 'required|boolean',
    ]);

    $user->status = $request->status;
    $user->save();

    return back()->with('success', 'User status updated successfully.');
}
}

