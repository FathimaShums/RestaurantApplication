@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
@if(Auth::user()->role == 'Customer')
<!-- Content for customers -->
@elseif(Auth::user()->role == 'Employee')
<!-- Content for employees -->

@elseif(Auth::user()->role == 'Admin')
<!-- Content for the admin -->
<div>
    <form action="/addEmployee" method="post">
        <div class=" flex flex-cols-2">
            <input type="text" name="EmployeeFirstName" placeholder="First name">
             <input type="text" name="EmployeeSurname" placeholder="Surname">
        </div>
        <div>
            <input type="text" name="EmployeePhone" placeholder="Phone Number">
            <input type="text" name="EmployeeEmail" placeholder="Email Address">
        </div>
        <input type="text" name="EmployeeAddress" placeholder="Address">


        
        <input type="text" name="name" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
    </form>
</div>
@endif
@endsection