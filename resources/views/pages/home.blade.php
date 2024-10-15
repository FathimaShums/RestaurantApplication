@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
@auth
@if(auth()->user()->user_type === 'Employee')
<div>
    <p>Welcome, Employee! Your designation is: {{ Auth::user()->additional_info }}</p>
</div>
@elseif(auth()->user()->user_type === 'Customer')
  <!-- Customer specific content here -->
  <h1>customersss</h1>
@elseif(auth()->user()->user_type === 'Admin')
<div>
    <h3>Add New Employee</h3>
    <form action="{{ route('admin.addEmployee') }}" method="post">
        @csrf
        <div>
            <input type="text" name="EmployeeFirstName" placeholder="First name" required>
            <input type="text" name="EmployeeSurname" placeholder="Surname" required>
        </div>
        <div>
            <input type="text" name="EmployeePhone" placeholder="Phone Number">
            <input type="email" name="EmployeeEmail" placeholder="Email Address" required>
        </div>
        <input type="text" name="EmployeeAddress" placeholder="Address">
        <input type="text" name="name" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="designation" placeholder="Designation" required>
        <button type="submit">Add Employee</button>
    </form>
</div>
<div>
    <h3>Employee List</h3>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Designation</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
                <tr>
                    <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->phone }}</td>
                    <td>{{ $employee->additional_info }}</td>
                    <td>
                        <form action="{{ route('admin.deleteEmployee', $employee->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this employee?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<div>
    <p>Welcome, Guest! </p>
</div>
@endif
@endauth

  









@endsection
