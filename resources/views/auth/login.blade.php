@extends('layouts.outer_app')

@section('content')
<div class="card-body login-card-body">
      <p class="login-box-msg"><b>{{ __('Login') }}</b> | Sign in to start your session</p>

      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
        <div class="input-group mb-3">
          <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('E-Mail Address') }}" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
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
        <div class="form-group">
        <div class="input-group mb-3">
          <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}" name="password" required autocomplete="current-password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" name="remember"  {{ old('remember') ? 'checked' : '' }}>
              <label for="remember">
              {{ __('Remember Me') }}
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


      <p class="mb-1 mt-2">
      @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        @endif
        <!-- <a href="forgot-password.html">I forgot my password</a> -->
      </p>
      <p class="mb-0">
        @if (Route::has('register'))        
            <a class="text-center" href="{{ route('register') }}">{{ __('Register') }}</a>        
        @endif
      </p>
    </div>
    <!-- /.login-card-body -->
@endsection
