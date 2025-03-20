<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {

        $userData = User::all();
        return view('user.index', compact('userData'));
    }

    public function create() {
        $roles = Role::orderBy('name', 'ASC')->get(); 
        $selectedRoles = []; // Empty array for new users (no roles assigned)
    
        return view('user.edit', compact('roles', 'selectedRoles'));
    }
    

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'roles' => 'array|required',
            'roles.*' => 'exists:roles,id',
        ]);
    
        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password
        ]);
    
        // Assign roles
        $user->roles()->attach($request->roles);
    
        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }
    

    public function edit(User $user) {
        $roles = Role::orderBy('name', 'ASC')->get(); 
        $selectedRoles = $user->roles()->pluck('id')->toArray(); // ✅ Get assigned role IDs
    
        return view('user.edit', compact('user', 'roles', 'selectedRoles'));
    }
    
    
    public function update(Request $request, User $user) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'roles' => 'array|required',
            'roles.*' => 'exists:roles,id',
            'password' => 'nullable|min:6', // Password is optional when updating
        ]);
    
        // Update user data
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);
    
        // Sync roles to update user roles correctly
        $user->roles()->sync($request->roles);
    
        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }
    

    // public function update(Request $request, User $user) {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'roles' => 'array|required',
    //         'roles.*' => 'exists:roles,id',
    //        'email' => 'required|email|unique:users,email,' . $user->id,

    //     ]);
    
    //     // Update user data
    //     $user->update(['name' => $request->name]);
    
    //     // Sync roles to update user roles correctly
    //     $user->roles()->sync($request->roles);
    
    //     return redirect()->route('user.index')->with('success', 'User updated successfully.');
    // }
    
    
}
