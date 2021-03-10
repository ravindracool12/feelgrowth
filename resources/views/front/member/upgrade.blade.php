<?php
  use App\Models\Package;
  $packages = Package::all();
?>

@extends('front.app')

@section('title')
  @lang('upgrade.title') | {{ config('app.name') }}
@stop

@section('breadcrumb')
  <ul class="breadcrumb">
    <li><a href="#">@lang('breadcrumbs.front')</a></li>
    <li><a href="{{ route('home', ['lang' => \App::getLocale()]) }}">@lang('breadcrumbs.dashboard')</a></li>
    <li class="active">@lang('breadcrumbs.upgrade')</li>
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
            <h1><i class="md md-person-add"></i> @lang('upgrade.title')</h1>
            {{-- <p class="lead">@lang('upgrade.subTitle')</p> --}}
          </div>

          <div class="row m-b-40">
            <div class="col-md-2">
              <div class="row">
                <div class="col-xs-6 col-md-12">
                  <label>@lang('common.register')</label>
                  <h2 class="theme-text" style="margin-top:0;"><span data-count data-start="0.00" data-end="{{ $member->wallet->register_point }}" data-decimal="0"></span></h2>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="well white">
                <form class="action-form" data-parsley-validate="" role="form" http-type="post" data-url="{{ route('member.postUpgrade') }}">
                  <fieldset>
                    <div class="form-group">
                      <label class="control-label" for="inputPackage">@lang('upgrade.package')</label>
                      <div class="input-group">
                        <select class="form-control" name="package_id" id="inputPackage" required="">
                        @if (count($packages) > 0)
                          @foreach ($packages as $package)
                            @if ($member->package_amount <= $package->package_amount)
                              <option value="{{ $package->id }}">{{ number_format($package->package_amount, 0) }} @if ($member->package_amount == $package->package_amount) (@lang('upgrade.renew')) @endif</option>
                            @endif
                          @endforeach
                        @endif
                        </select>
                        <span class="input-group-addon">USD</span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="inputS">@lang('register.security')</label>
                      <input type="password" class="form-control" required="" name="s" id="inputS">
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
          </div>
        </section>
      </div>
    </div>
  </main>
@stop
