@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 ">
            <div class="card">
                <div class="card-header">ISESER2020</div>
                <div class="card-body">
                <img src="{{url('/')}}/v_6_telif.jpg" style="width: 100%">
                    <hr>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">ISESER2020</div>
                <div class="card-body">
                    User Page is preparing, but you can register for now...
                    <hr>
                    <a href="/register">Register Page</a>
                </div>
            </div>
<!--
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12  offset-md-2">
                                <button type="submit" class="col-md-8 btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                            </div>
                            <div class="col-md-12  offset-md-2">

                                <a class="btn btn-link" href="{{ route('register') }}">{{ __('Register') }}</a>


                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                    </form>

                    <hr>
                    <b>Announcements</b> (last 2 -> <a href="{{url('/')}}/blog">Click For More</a>)
                    @php($i=1)
                    <hr>

                       <hr>
                </div>
            </div>

            -->
        </div>
    </div>
</div>
@endsection
