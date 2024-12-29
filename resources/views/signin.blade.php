@extends('masterLayout')

@section('title')
    Sign In
@endsection

@push('styles')
<style>
    .card {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        color: #333;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    input {
        padding: 10px;
        margin-bottom: 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        transition: border-color 0.3s ease-in-out;
        outline: none;
        color: #333;
    }

    input:focus {
        border-color: #555;
    }

    button {
        background-color: #3498db;
        color: #fff;
        padding: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out;
    }

    button:hover {
        background-color: #2980b9;
    }
</style>
@endpush

@section('contents')
@include('components.header')
<div class="container mt-5" style="width: 100%;max-width: 400px;">   
    <div class="card">
        <h2>Sign In</h2>
        <form action="" method="POST"
        onsubmit="validateSignIn();"
        >
            @csrf
            <div class="form-group">
                <input type="text" id="user_username" name="user_username" value="{{ old('user_username', session('user_username'), $user->user_username ?? '') }}" placeholder="Enter Username" class="form-control">
                <span class="error-message" id="username-error">{{ $errors->first('user_username') }}</span>
            </div>
            <div class="form-group" style="position: relative;">
                <input type="password" id="user_password" name="user_password" value="{{ old('user_password'), session('user_password') }}" placeholder="Please Enter Password" class="form-control">
                <span class="error-message" id="password-error">{{ $errors->first('user_password') }}</span>
                <span class="toggle-password" style="position: absolute; right: 10px; top: 10px; cursor: pointer;">
                    <i class="fa fa-eye" id="togglePassword"></i>
                </span>
            </div>
            <button type="submit">Sign In</button>
        </form>
        <span style="text-align:right;margin-top:5px;">Don't have an account? <a href="{{ route('signup') }}">Sign up</a></span>
    </div>
</div>
@endsection
@push('scripts')
<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#user_password');

    togglePassword.addEventListener('click', function () {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });    
</script>
@endpush
