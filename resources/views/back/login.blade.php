@extends('back.app')

@section('title')
Login - {{ config('app.name') }}
@stop

@section('content')
<div class="center">
  <div class="card bordered z-depth-2" style="margin:0% auto; max-width:400px;">
    <div class="card-header">
      <div class="brand-logo">
        <img src="{{ asset('assets/img/logo.png') }}" width="100">
      </div>
    </div>
    <form class="form-floating action-form" http-type="post" data-url="{{ route('admin.postLogin') }}">
      <div class="card-content">
        <div class="m-b-30">
          <div class="card-title strong pink-text">Login</div>
          <p class="card-title-desc"> Welcome to {{ config('app.name') }} | ADMIN AREA</p>
        </div>
        <div class="form-group">
          <label for="username" class="control-label">Username</label>
          <input type="text" name="username" class="form-control" id="username" required="">
        </div>
        <div class="form-group">
          <label for="password" class="control-label">Password</label>
          <input type="password" name="password" class="form-control" id="password" required="">
        </div>
        <div class="form-group">
          <div class="checkbox">
          <label><input type="checkbox" name="remember"> Remember me </label>
          </div>
        </div>
      </div>
      <div class="card-action clearfix">
        <div class="pull-right">
          <button type="submit" class="btn btn-link black-text">
            <span class="btn-preloader">
              <i class="md md-cached md-spin"></i>
            </span>
            <span>Login</span>
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

@stop