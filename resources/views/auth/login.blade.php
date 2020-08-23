{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Login') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('login') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

{{--                                    <label class="form-check-label" for="remember">--}}
{{--                                        {{ __('Remember Me') }}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-8 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Login') }}--}}
{{--                                </button>--}}

{{--                                @if (Route::has('password.request'))--}}
{{--                                    <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                        {{ __('Forgot Your Password?') }}--}}
{{--                                    </a>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@endsection--}}

@extends('layouts.app')
@section('title','پنل مدیریت | صفحه ورود')
@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>ورود به سایت</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">


                <div class="card-body login-card-body">
                <p class="login-box-msg">فرم زیر را تکمیل کنید و ورود بزنید</p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                    <div class="input-group mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror"  name="email" value="{{ old('email') }}" placeholder="{{ __('ایمیل') }}">
                    </div>
                        <div class="input-group-append">
                            <small class="text-danger"
                                   id="email">{{$errors->first('email')}}</small>
                        </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"  placeholder="{{ __('پسورد') }}">

                    </div>
                        <div class="input-group-append">
                            <small class="text-danger"
                                   id="password">{{$errors->first('password')}}</small>
                        </div>
                    <div class="row">
                        <div class="col-8">
{{--                            <div class="checkbox icheck">--}}
{{--                                <label>--}}
{{--                                    <input type="checkbox"> یاد آوری من--}}
{{--                                </label>--}}
{{--                            </div>--}}
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('یاد آوری من') }}
                                </label>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('ورود') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                        <!-- /.col -->
{{--                        <div class="col-4">--}}
{{--                            <button type="submit" class="btn btn-primary btn-block btn-flat"> {{ __('ورود') }}</button>--}}
{{--                        </div>--}}
                        <!-- /.col -->
                    </div>
                </form>


                <!-- /.social-auth-links -->

{{--                <p class="mb-1">--}}
{{--                    <a href="#">رمز عبورم را فراموش کرده ام.</a>--}}
{{--                    @if (Route::has('password.request'))--}}
{{--                        <a  href="{{ route('password.request') }}">--}}
{{--                            {{ __('Forgot Your Password?') }}--}}
{{--                        </a>--}}
{{--                    @endif--}}
{{--                </p>--}}

                <p class="mb-0">
                    <a href="{{route('register')}}" class="text-center">ثبت نام</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
@endsection