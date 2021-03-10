<?php
  \Session::forget('binary.session');
?>

@extends('front.app')

@section('title')
  @lang('binary.title') | {{ config('app.name') }}
@stop

@section('breadcrumb')
  <ul class="breadcrumb">
    <li><a href="#">@lang('breadcrumbs.front')</a></li>
    <li><a href="{{ route('home', ['lang' => \App::getLocale()]) }}">@lang('breadcrumbs.dashboard')</a></li>
    <li class="active">@lang('breadcrumbs.binary')</li>
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
            <h1><i class="md md-swap-vert"></i> @lang('binary.title')</h1>
            <p class="lead">@lang('binary.subTitle')</p>
          </div>

          <div class="row m-b-40">
            <div class="col-md-12">
              <div class="well white m-b-10">
                <form class="floating-label" data-parsley-validate="" role="form" id="binaryForm" data-url="{{ route('member.getBinary', ['lang' => \App::getLocale()]) }}" onsubmit="return false;">
                  <fieldset>
                    <div class="form-group">
                      <label class="control-label" for="inputMember">@lang('binary.member')</label>
                      <input type="text" name="u" class="form-control" required="" id="inputMember" value="{{ $member->username }}">
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="inputSecret">@lang('binary.secret')</label>
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

                <div class="btn-group">
                  <button class="btn btn-info" id="toTopBtn" data-url="{{ route('member.getBinaryTop', ['lang' => \App::getLocale()]) . '?type=top' }}">
                    <i class="md md-swap-vert"></i> @lang('binary.top')
                  </button>

                  <button class="btn btn-warning" id="upLevelBtn" data-url="{{ route('member.getBinaryTop', ['lang' => \App::getLocale()]) . '?type=up' }}">
                    <i class="md md-swap-vert"></i> @lang('binary.upline')
                  </button>
                </div>
              </div>
              <div class="well white m-b-10" id="binaryContainer">
                <div id="binaryNetwork" class="clearfix" data-show="{{ route('member.binary.modal', ['lang' => \App::getLocale()]) }}">
                  <div class="loader">
                    <img src="{{ asset('assets/img/loading.gif') }}" alt="Network Loading">
                  </div>
                  <div id="binaryContent">
                    <div class="alert alert-warning">
                      @lang('binary.notice')
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </main>

  <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="showModalLabel">@lang('binary.modal.title')</h4>
        </div>
        <div class="modal-body">
          <div class="loading text-center">
            <img src="{{ asset('assets/img/loading.gif') }}" alt="Network Loading">
            <br>
            <small class="text-primary">@lang('common.modal.load')</small>
          </div>

          <div class="error text-center">
            <i class="md md-error"></i>
            <br>
            <small class="text-danger">@lang('common.modal.error')</small>
          </div>

          <div id="modalContent"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-raised" data-dismiss="modal">@lang('common.close')</button>
        </div>
      </div>
    </div>
  </div>
@stop
