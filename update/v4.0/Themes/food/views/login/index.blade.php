@extends('theme::layouts.app')

@section('content')
<div class="main-content mt-50">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 offset-lg-3">
				<div class="login-card">
					<div class="login-header">
						<h5>{{ __('Login your account') }}</h5>
					</div>	
					<div class="login-body">
						<div class="login-form">
							<form action="{{ route('login') }}" method="POST">
								@csrf
								<div class="form-group">
									<label>{{ __('Email') }}</label>
									<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
									@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
								<div class="form-group">
									<label>{{ __('Password') }}</label>
									<input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
									@error('password')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
								<div class="remember-section d-flex">
									<div class="remember">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input area" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
											<label class="custom-control-label" for="remember">{{ __('Remember Me') }}</label>
										</div>
									</div>
									<div class="forgotten">
										@if(Route::has('password.request'))
										<a href="{{ route('password.request') }}">{{ __('Forgot password?') }}</a>
										@endif
									</div>
								</div>
								<div class="login-button">
									<button type="submit">{{ __('Login Now') }}</button>
								</div>
							</form>
						</div>
						<div class="login-bottom-area">
							<div class="dont-have-account text-center">
								<p>{{ __("Don't Have An Account?") }} <a href="{{ url('user/register') }}">{{ __('Register Now') }}</a></p>
								<h6>{{ __('OR') }}</h6>
							</div>
							<div class="social-login text-center">
								<div class="social-links">
									@if(env('FACEBOOK_CLIENT_ID') != null)
									<a class="facebook" href="{{ url('login/facebook') }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 2C6.477 2 2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.879V14.89h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.989C18.343 21.129 22 16.99 22 12c0-5.523-4.477-10-10-10z"/></svg></a>
									@endif
	
									@if(env('GOOGLE_CLIENT_ID') != null)
									<a class="google" href="{{ url('login/google') }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M3.064 7.51A9.996 9.996 0 0 1 12 2c2.695 0 4.959.99 6.69 2.605l-2.867 2.868C14.786 6.482 13.468 5.977 12 5.977c-2.605 0-4.81 1.76-5.595 4.123-.2.6-.314 1.24-.314 1.9 0 .66.114 1.3.314 1.9.786 2.364 2.99 4.123 5.595 4.123 1.345 0 2.49-.355 3.386-.955a4.6 4.6 0 0 0 1.996-3.018H12v-3.868h9.418c.118.654.182 1.336.182 2.045 0 3.046-1.09 5.61-2.982 7.35C16.964 21.105 14.7 22 12 22A9.996 9.996 0 0 1 2 12c0-1.614.386-3.14 1.064-4.49z"/></svg></a>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection