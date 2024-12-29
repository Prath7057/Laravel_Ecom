@extends('masterLayout')

@section('title')
    Sign Up
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

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .error-message {
            color: red;
            min-height: 10px;
        }
    </style>
@endpush

@section('contents')
    @include('components.header')

    <div class="container mt-5" style="width: 100%;max-width: 400px;">
        <div class="card">
            <h2>Sign Up</h2>
            <form action="{{ route('signupdata') }}" method="POST" id="signupForm" onsubmit="return validateSignUpForm();">
                @csrf
                <input type="hidden" id="user_id" name="user_id" value="{{ old('user_id', $user->user_id ?? '') }}" />
                <div class="form-group">
                    <input type="text" id="user_username" name="user_username"
                        value="{{ old('user_username', $user->user_username ?? '') }}" placeholder="Enter Username"
                        class="form-control"
                        onkeydown="if (event.keyCode == 13) {
                                        event.preventDefault();
                                        inputOnfocus('user_email');                                        
                                        return false;
                                   } else if (event.keyCode == 8 && this.value == '') {
                                        inputOnfocus(''); 
                                        return false;
                                   }">
                    <span class="error-message" id="username-error">{{ $errors->first('user_username') }}</span>
                </div>

                <div class="form-group">
                    <input type="email" id="user_email" name="user_email"
                        value="{{ old('user_email', $user->user_email ?? '') }}" placeholder="Please Enter Email"
                        class="form-control"
                        onkeydown="if (event.keyCode == 13) {
                                        inputOnfocus('user_password');                                        
                                        return false;
                                    } else if (event.keyCode == 8 && this.value == '') {
                                        inputOnfocus('user_username'); 
                                        return false;
                                    }">
                    <span class="error-message" id="email-error">{{ $errors->first('user_email') }}</span>
                </div>

                <div class="form-group" style="position: relative;">
                    <input type="password" id="user_password" name="user_password" value="{{ old('user_password') }}"
                        placeholder="Please Enter Password" class="form-control"
                        onkeydown="if (event.keyCode == 13) {
                                      inputOnfocus('cpassword');                                        
                                      return false;
                                  } else if (event.keyCode == 8 && this.value == '') {
                                      inputOnfocus('user_email'); 
                                      return false;
                                  }">
                    <span class="error-message" id="password-error">{{ $errors->first('user_password') }}</span>
                    <span class="toggle-password" style="position: absolute; right: 10px; top: 10px; cursor: pointer;">
                        <i class="fa fa-eye" id="togglePassword"></i>
                    </span>
                </div>

                <div class="form-group">
                    <input type="password" id="cpassword" name="cpassword"
                        value="{{ old('cpassword', $user->user_ipassword ?? '') }}" placeholder="Please Confirm Password"
                        class="form-control"
                        onkeydown="if (event.keyCode == 13) {
                                     inputOnfocus('signUp');                                        
                                     return false;
                                 } else if (event.keyCode == 8 && this.value == '') {
                                     inputOnfocus('user_password'); 
                                    return false;
                                 }">
                    <span class="error-message" id="cpassword-error">{{ $errors->first('cpassword') }}</span>
                </div>
                @if (!isset($user->user_id))
                    <button type="submit" class="btn btn-primary" id="signUp">Sign Up</button>
                @else
                    <button type="submit" class="btn btn-primary" id="signUp">Update</button>
                @endif
            </form>
            @if (!isset($user->user_id))
                <span style="text-align:right;margin-top:5px;">
                    Have an account? <a href="{{ route('signin') }}">Log in</a>
                </span>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#user_password');

        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
    </script>
@endpush
