<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {   
    $validator = Validator::make($request->all(), [
        'firstname' => 'required|string|max:25',
        'lastname' => 'required|string|max:25',
        'phone' => 'nullable|string|max:12',
        'email' => 'required|string|email|max:100|unique:users,email',
        'address' => 'nullable|string|max:255',
        'name' => 'required|string|max:255|unique:users,name',
        'password' => 'required|string|min:8',
    ]);
    if ($validator->fails()) {
        return redirect()->back()
                         ->withErrors($validator)
                         ->withInput();
    }
    $userData = [
        'first_name' => $request->firstname,
        'last_name' => $request->lastname,
        'phone' => $request->phone,
        'email' => $request->email,
        'address' => $request->address,
        'name' => $request->name,
        'password' => $request->password,];
    $user = User::createNewUser($userData);

    Auth::login($user);
    return redirect()->route('pages.home');
        
    }
    public function showRegisterForm(){
        return view('pages.customer-register');

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); // Redirect to home or login page
    }
    public function addEmployee(){}


}
