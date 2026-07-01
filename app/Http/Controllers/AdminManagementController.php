<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = User::where('role', 'admin')->get();

        return view('admins.list', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'admin_name' => 'required|max:255',
            'admin_email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'status' => 'required'
        ]);


        // save admin
        admin::create([
            'admin_name' => $request->admin_name,
            'admin_email' => $request->admin_email,
            'password' => Hash::make($request->password),
            'role' =>'admin',
            'status' => $request->status
        ]);

        return redirect()->route('admins.index')->with('success', 'admin created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin = User::findorFail($id);
        return view('admins.edit',compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $admin = User::findOrFail($id);

        $request->validate([
            'admin_name' => 'required|max:255',
            'admin_email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|confirmed|min:8',
            'status' => 'required',
        ]);

        $data = [
            'admin_name' => $request->admin_name,
            'admin_email' => $request->admin_email,
            'role' => 'admin',
            'status' => $request->status,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);

        return redirect()
            ->route('admins.index')
            ->with('success', 'Admin updated successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function updateStatus(Request $request, User $admin)
    {
        $request->validate([
            'status' => 'required|boolean',
        ]);

        $admin->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Admin status updated successfully.');
    }
    
}
