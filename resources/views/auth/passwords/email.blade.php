@extends('layouts.outer_app')

@section('content')
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body login-card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group">
                                <div class="input-group mb-3">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('E-Mail Address') }}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                            <div class="col-md-12">
                                <p class="mb-0 mt-4">     
                                    <a class="text-center" href="{{ route('login') }}">{{ __('Login') }}</a> | 
                                    @if (Route::has('register'))        
                                        <a class="text-center" href="{{ route('register') }}">{{ __('Register') }}</a>        
                                    @endif
                                </p>
                            </div>
                        </div>
                    </form>
                </div>            
@endsection
