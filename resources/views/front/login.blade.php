@extends('front.app')

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
    <form class="form-floating action-form" http-type="post" data-url="{{ route('login.post', ['lang' => \App::getLocale()]) }}">
      <div class="card-content">
        <div class="m-b-30">
          <div class="card-title strong pink-text">@lang('login.title')</div>
          <!-- <p><a href="{{ route('login', ['lang' => 'en']) }}">English</a> | <a href="{{ route('login', ['lang' => 'chs']) }}">简体中文</a> | <a href="{{ route('login', ['lang' => 'cht']) }}">繁體中文</a></p> -->
          <p class="card-title-desc"> @lang('login.subtitle')</p>
        </div>
        <div class="form-group">
          <label for="username" class="control-label">@lang('login.username')</label>
          <input type="text" name="username" class="form-control" id="username" required="">
        </div>
        <div class="form-group">
          <label for="password" class="control-label">@lang('login.password')</label>
          <input type="password" name="password" class="form-control" id="password" required="">
        </div>
        <div class="form-group">
          <div class="checkbox">
          <label><input type="checkbox" name="remember"> @lang('login.remember') </label>
          </div>
        </div>
      </div>
      <div class="card-action clearfix">
        <div class="pull-right">
          <button type="submit" class="btn btn-link black-text">
            <span class="btn-preloader">
              <i class="md md-cached md-spin"></i>
            </span>
            <span>@lang('login.title')</span>
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

@stop
