@extends('front.app')

@section('title')
  @lang('success.title') | {{ config('app.name') }}
@stop

@section('breadcrumb')
  <ul class="breadcrumb">
    <li><a href="#">@lang('breadcrumbs.front')</a></li>
    <li><a href="{{ route('home', ['lang' => \App::getLocale()]) }}">@lang('breadcrumbs.dashboard')</a></li>
    <li><a href="{{ route('member.register', ['lang' => \App::getLocale()]) }}">@lang('breadcrumbs.register')</a></li>
    <li class="active">@lang('breadcrumbs.registerSuccess')</li>
  </ul>
@stop

@section('content')
  <main>
    @include('front.include.sidebar')
    <div class="main-container">
      @include('front.include.header')
      <div class="main-content" autoscroll="true" bs-affix-target="" init-ripples="" style="">
        <section>
          <div class="page-header">
            <h1><i class="md md-done-all"></i> @lang('success.title')</h1>
          </div>

          <div class="row m-b-40">
            <div class="col-md-8">
              <div class="well white text-center">
                <h1 class="theme-text text-uppercase w300">@lang('success.text1')</h1>
                <h3>@lang('success.text2')<span class="theme-text">{{ $model->username }}</span></h3>
                <a href="{{ route('member.register', ['lang' => \App::getLocale()]) }}" class="btn btn-primary btn-block m-t-50">
                  <i class="md md-navigate-before"></i> @lang('success.back')
                </a>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </main>
@stop
