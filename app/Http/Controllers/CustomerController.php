<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::select(['id', 'name', 'email', 'status', 'role']);
            return DataTables::of($users)
                ->addColumn('action', function ($user) {
                    return "
                        <button class='btn btn-info editbtn' data-id='{$user->id}' data-toggle='modal' data-target='#userModal'>Edit</button>
                        <button class='btn btn-danger deletebtn' data-id='{$user->id}'>Delete</button>
                    ";
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('customer.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'status' => 'required|string',
            'role' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return response()->json(['success' => 'User created successfully.']);
    }

    public function show($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'status' => 'required|string',
            'role' => 'required|string',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = User::find($id);

        if ($request->has('password') && !empty($request->input('password'))) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']); 
        }

        $user->update($validated);

        return response()->json(['success' => 'User updated successfully.']);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json(['success' => 'User deleted successfully.']);
    }
}
