<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(10);

        return response()->json($users, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validations = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'is_admin' => 'nullable|boolean',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'avatar' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'is_marketing' => 'nullable|boolean',
        ]);

        $user = User::create([
            'first_name' => $validations['first_name'],
            'last_name' => $validations['last_name'],
            'is_admin' => $validations['is_admin'] ?? false,
            'email' => $validations['email'],
            'password' => bcrypt($validations['password']),
            'avatar' => $validations['avatar'] ?? null,
            'address' => $validations['address'] ?? null,
            'phone_number' => $validations['phone_number' ?? null],
            'is_marketing' => $validations['is_marketing'] ?? false,
        ]);

        return response($user, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);

        return response($user, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validations = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,' . $id,
        ]);

        $user = User::find($id);
        $user->update($validations);

        return response($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);

        return response()->json([
            'message' => 'User deleted successfully'
        ]);
    }
}
