<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //function for customer to register
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
       
    //function to load registration page
    }
    public function showRegisterForm(){
        return view('pages.customer-register');

    }
    //function to load login page
    //  public function showLoginForm()
    //  {
    //      return view('pages.login'); 
    //  }
     //function to login
    public function login(Request $request)
{
    $credentials = $request->validate([
        'name' => 'required|string',
        'password' => 'required|string',
    ]);

    if (User::attemptLogin($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('pages.home');
    }

    return back()->withErrors([
        'name' => 'The provided credentials do not match our records.',
    ])->onlyInput('name');
}
//function to logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); 
    }
//function to add an employee
   
 public function addEmployee(Request $request)
     {
        if (!Auth::check() || Auth::user()->user_type !== 'Admin') {
            return redirect()->route('pages.home')->with('error', 'Unauthorized access');
        }
         $validator = Validator::make($request->all(), [
             'EmployeeFirstName' => 'required|string|max:25',
             'EmployeeSurname' => 'required|string|max:25',
             'EmployeePhone' => 'nullable|string|max:12',
             'EmployeeEmail' => 'required|string|email|max:100|unique:users,email',
             'EmployeeAddress' => 'nullable|string|max:255',
             'name' => 'required|string|max:255|unique:users,name',
             'password' => 'required|string|min:8',
             'designation' => 'required|string|max:100',
         ]);
 
         if ($validator->fails()) {
             return redirect()->back()
                 ->withErrors($validator)
                 ->withInput();
         }
 
         $userData = [
             'first_name' => $request->EmployeeFirstName,
             'last_name' => $request->EmployeeSurname,
             'phone' => $request->EmployeePhone,
             'email' => $request->EmployeeEmail,
             'address' => $request->EmployeeAddress,
             'name' => $request->name,
             'password' => $request->password,
             'user_type' => 'Employee',
             'additional_info' => $request->designation,
         ];
 
         User::createNewUser($userData);
 
         return redirect()->route('pages.home')->with('success', 'Employee added successfully');
     }
 

//function to view all employees
public function showHome()
    {
        $employees = [];
        if (Auth::check() && Auth::user()->user_type == 'Admin') {
            $employees = User::where('user_type', 'Employee')->get();
        }
        return view('pages.home', compact('employees'));
    }
//function to delete an employee
public function deleteEmployee($id)
    {
        if (!Auth::check() || Auth::user()->user_type !== 'Admin') {
            return redirect()->route('pages.home')->with('error', 'Unauthorized access');
        }

        $employee = User::findOrFail($id);
        $employee->delete();
        return redirect()->route('pages.home')->with('success', 'Employee deleted successfully');
    }


    //these should deal with foodItem class?
//function to add new food item

//function to view all food items

//function to delete a food item
    //these should deal with OrderItem or something
//function to add an item to cart(should also specify quantity)

//function to delete an item off the cart 

//function to place order?
//order Id should be generated asw


}
