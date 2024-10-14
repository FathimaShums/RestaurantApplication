@extends('layouts.app')
@section('title', 'Sign Up')
@section('content')
    <div>
               <!-- To display Errors -->
            @if ($errors->any())
               <div class="alert alert-danger">
                   <ul>
                       @foreach ($errors->all() as $error)
                           <li>{{ $error }}</li>
                       @endforeach
                   </ul>
               </div>
           @endif
        <form action="{{ route('register.store') }}" method="post">
            @csrf
            <div class=" flex flex-cols-2">
                <input type="text" name="firstname" placeholder="First name">
                 <input type="text" name="lastname" placeholder="Surname">
            </div>
            <div>
                <input type="text" name="phone" placeholder="Phone Number">
                <input type="text" name="email" placeholder="Email Address">
            </div>
            <input type="text" name="address" placeholder="Address">


            
            <input type="text" name="name" placeholder="Username">
            <input type="password" name="password" placeholder="Password">
            
            <button>Sign Up</button>
        </form>

    </div>
@endsection