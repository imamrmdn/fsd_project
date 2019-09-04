
<style media="screen">
  #logo{
    background-image: url('css/Fanfix.png');
    background-repeat: no-repeat;
    display: inline-block;
    background-size: 200px;
    width: 200px;
    height: 200px;
    margin-left: 480px;
    margin-top: 75px;
  }
  p{
    text-align: center;
  }
</style>
@extends('layouts.app')
@section('content')
<div class="container" >
  <div align="center" id="logo"></div>
    <div class="row" style="margin-left: 330px">
        <div class="col-md-6 m-auto borderpt-4">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-3 control-label"></label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" style="width: 250px;" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-3 control-label"></label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Password" style="width: 250px;" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-md-3 control-label"></label>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary form-control" style="width: 250px;">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
