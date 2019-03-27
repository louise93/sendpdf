@extends('layouts.app')
@section('header')
<header> <!-- extra class no-background -->
  <a class="go-back-link" href="javascript:history.back();"><i class="fa fa-arrow-left"></i></a>
  <h1 class="page-title">LOG IN</h1>
  <div class="navi-menu-button">
    <em></em>
    <em></em>
    <em></em>
  </div>
</header>

@endsection
@section('content')
	<div class="form-divider"></div>
		<div class="form-divider"></div>

				<div class="container">
					<div class="form-divider"></div>
					<div class="form-divider"></div>
					<div class="form-label-divider">  @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong style="color:red;">{{ $errors->first('email') }}</strong>
                </span>
            @endif    @if ($errors->has('password'))
                  <span class="invalid-feedback" role="alert">
                      <strong style="color:red;">{{ $errors->first('password') }}</strong>
                  </span>
              @endif</div>
					<div class="form-divider"></div>
          <form method="POST" action="{{ route('login') }}" id="form">
              @csrf
					<div class="form-row-group with-icons">
						<div class="form-row no-padding">
							<i class="fa fa-envelope"></i>
							<input type="text"  class="form-element{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Username or Email">
						</div>
						<div class="form-row no-padding">
							<i class="fa fa-lock"></i>
							<input type="password"  class="form-element{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">
						</div>

					</div>

					<div class="form-row txt-center mt-15">
						<a href="" data-loader="show">Forgot password?</a>
					</div>

					<div class="form-divider"></div>

					<div class="form-row">
						<button type="submit" class="button circle block orange" id="btn">Login</button>
					</div>

					<div class="form-row txt-center mt-15">
						Don't you have an account yet? <a href="signup.html" data-loader="show">Sign Up</a>
					</div>
        </form>
				</div>

	@endsection
