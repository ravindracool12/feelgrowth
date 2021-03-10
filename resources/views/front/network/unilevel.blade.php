<?php
  if (\Input::has('rid')) {
    $sMember = \App\Models\Member::where('id', trim(\Input::get('rid')))->first();
  } else {
    $sMember = $member;
  }
?>

@extends('front.app')

@section('title')
  @lang('unilevel.title') | {{ config('app.name') }}
@stop

@section('breadcrumb')
  <ul class="breadcrumb">
    <li><a href="#">@lang('breadcrumbs.front')</a></li>
    <li><a href="{{ route('home', ['lang' => \App::getLocale()]) }}">@lang('breadcrumbs.dashboard')</a></li>
    <li class="active">@lang('breadcrumbs.unilevel')</li>
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
            <h1><i class="md md-swap-vert"></i> @lang('unilevel.title')</h1>
            <p class="lead">@lang('unilevel.subTitle')</p>
          </div>

          <div class="row m-b-40">
            <div class="col-md-4">
              <div class="well white">
                <form class="floating-label" data-parsley-validate="" role="form" id="unilevelForm" data-url="{{ route('member.getUnilevel', ['lang' => \App::getLocale()]) }}">
                  <fieldset>
                    <div class="form-group">
                      <label class="control-label" for="inputMember">@lang('unilevel.member')</label>
                      <input type="text" value="{{ $sMember->username }}" name="u" class="form-control" required="" id="inputMember">
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="inputSecret">@lang('unilevel.secret')</label>
                      <input type="password" name="s" class="form-control" required="" id="inputSecret">
                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary">
                        <span class="btn-preloader">
                          <i class="md md-cached md-spin"></i>
                        </span>
                        <span>@lang('common.submit')</span>
                      </button>
                      <button type="reset" class="btn btn-default">@lang('common.cancel')</button>
                    </div>
                  </fieldset>
                </form>
              </div>
            </div>

            <div class="col-md-6">
              <div class="well white">
                @if (\Input::has('rid'))
                  <div id="unilevelNetwork" data-url="{{ route('member.unilevelSearch', ['lang' => \App::getLocale()]) . '?rid=' . \Input::get('rid') }}"></div>
                @else
                  <div class="alert alert-warning">
                    @lang('unilevel.notice')
                  </div>
                @endif
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </main>
@stop
