<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        // Validate request data
        $validator = \Validator::make($request->all(), [
            'FirstName' => 'required|string|max:255',
            'LastName' => 'required|string|max:255',
            'Email' => 'required|email|unique:users,Email',
            'PhoneNumber' => 'required|unique:users,PhoneNumber',
            'Password' => 'required|string|min:6',
            'ProfilePicture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ]);
        }

        // Handle file upload
        $fileName = null;
        if ($request->hasFile('ProfilePicture')) {
            $fileName = time() . '.' . $request->file('ProfilePicture')->getClientOriginalExtension();
            $request->file('ProfilePicture')->storeAs('public/custom_folder', $fileName);
        }

        // Create the user
        User::create([
            'FirstName' => $request->FirstName,
            'LastName' => $request->LastName,
            'Email' => $request->Email,
            'PhoneNumber' => $request->PhoneNumber,
            'Password' => bcrypt($request->Password),
            'ProfilePicture' => $fileName,
        ]);

        // Return success response
        return response()->json(['success' => true, 'message' => 'User added successfully!']);
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'FirstName' => 'required|string|max:255',
            'LastName' => 'required|string|max:255',
            'Email' => 'required|email|max:255',
            'PhoneNumber' => 'required|string|max:255',
            'Password' => 'nullable|string|min:6',
            'ProfilePicture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fileName = $user->ProfilePicture;
        if ($request->hasFile('ProfilePicture')) {
            $fileName = time() . '.' . $request->file('ProfilePicture')->getClientOriginalExtension();
            $request->file('ProfilePicture')->storeAs('public/custom_folder', $fileName);
        }

        $user->update([
            'FirstName' => $request->FirstName,
            'LastName' => $request->LastName,
            'Email' => $request->Email,
            'PhoneNumber' => $request->PhoneNumber,
            'Password' => $request->Password ? Hash::make($request->Password) : $user->Password,
            'ProfilePicture' => $fileName,
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
