@extends('layouts.auth')

@section('title', 'Sign Up')

@section('content')
    <div class="w-100 d-flex flex-column border-1 justify-content-center align-items-center" style="height: 100vh;">
        <h2>Sign Up</h2>
        <form class="border p-4 rounded w-25" id="signupForm">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name">
                <span class="invalid-feedback" id="nameError"></span>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email">
                <span class="invalid-feedback" id="emailError"></span>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                <span class="invalid-feedback" id="passwordError"></span>
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
                <span class="invalid-feedback" id="confirmPasswordError"></span>
            </div>
            <div>
                Already have an account? <a href="/login"> Login</a>
            </div>
            <br>
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
    </div>
@endsection('content')