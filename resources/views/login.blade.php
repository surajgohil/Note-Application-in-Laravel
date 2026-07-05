@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="w-100 d-flex flex-column border-1 justify-content-center align-items-center" style="height: 100vh;">
        <h2>Login</h2>
        <form class="border p-4 rounded w-25" id="loginForm">
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
            <div>
                If you don't have an account? <a href="/signup"> Sign up</a>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection('content')