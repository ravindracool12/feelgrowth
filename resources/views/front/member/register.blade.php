<?php
  use App\Models\Package;
  $packages = Package::where('package_amount', '!=', 0)->get();
?>

@extends('front.app')

@section('title')
  @lang('register.title') | {{ config('app.name') }}
@stop

@section('breadcrumb')
  <ul class="breadcrumb">
    <li><a href="#">@lang('breadcrumbs.front')</a></li>
    <li><a href="{{ route('home', ['lang' => \App::getLocale()]) }}">@lang('breadcrumbs.dashboard')</a></li>
    <li><a href="{{ route('network.binary', ['lang' => \App::getLocale()]) }}">@lang('breadcrumbs.hierarchy')</a></li>
    <li class="active">@lang('breadcrumbs.register')</li>
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
            <h1><i class="md md-person-add"></i> @lang('register.title')</h1>
            <p class="lead">@lang('register.notice')</p>
          </div>

          <div class="row m-b-40">
            <div class="col-md-2">
              <div class="row">
                <div class="col-xs-6 col-md-12">
                  <label>@lang('common.register')</label>
                  <h2 class="theme-text" style="margin-top:0;"><span data-count data-start="0.00" data-end="{{ $member->wallet->register_point }}" data-decimal="0"></span></h2>
                </div>

                <div class="col-xs-6 col-md-12">
                  <label>@lang('common.promotion')</label>
                  <h2 class="theme-text" style="margin-top:0;"><span data-count data-start="0.00" data-end="{{ $member->wallet->promotion_point }}" data-decimal="2"></span></h2>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="well white">
                <form class="action-form" data-parsley-validate="" role="form" id="registerForm" http-type="post" data-url="{{ route('member.postRegister') }}" data-nationality="true">
                  <fieldset>
                    <div class="form-group">
                      <label class="control-label" for="inputPackage">@lang('register.package')</label>
                      <div class="input-group">
                        <select class="form-control" name="package_id" id="inputPackage" required="">
                        @if (count($packages) > 0)
                          @foreach ($packages as $package)
                            <option value="{{ $package->id }}" data-value="{{ $package->package_amount }}">
                              {{ number_format($package->package_amount, 0) }}
                            </option>
                          @endforeach
                        @endif
                        </select>
                        <span class="input-group-addon">INR</span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label">@lang('register.username')</label>
                      <input type="text" name="username" class="form-control" required="">
                    </div>

                    <div class="form-group">
                      <label class="control-label">@lang('register.name')</label>
                      <input type="text" name="name" class="form-control" required="">
                    </div>

                    <div class="form-group">
                      <label class="control-label">@lang('register.email')</label>
                      <input type="email" name="email" class="form-control" required="">
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="inputMobile">@lang('register.mobile')</label>
                      <input type="text" class="form-control" required="" name="mobile_phone" id="inputMobile">
                    </div>

                    <?php $countries = config('misc.countries'); ksort($countries); ?>
                    <div class="form-group">
                      <label class="control-label" for="inputNationality">@lang('register.nationality')</label>
                      <select class="form-control dd-icon" name="nationality" id="inputNationality">
                        @foreach ($countries as $country => $value)
                          <option value="{{ $country }}" data-imagesrc="{{ asset('assets/img/flags/' . $country . '.png') }}" data-description="{{ \Lang::get('country.selected') }}">@lang('country.' . $country)</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="inputPassword">@lang('register.password')</label>
                      <input type="password" id="inputPassword" name="password" class="form-control" required="" minlength="5">
                    </div>

                    <div class="form-group">
                      <label class="control-label">@lang('register.repassword')</label>
                      <input type="password" data-parsley-equalto="#inputPassword" class="form-control" required="" minlength="5">
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="inputSPassword">@lang('register.spassword')</label>
                      <input type="password" id="inputSPassword" name="secret" class="form-control" required="" minlength="5">
                    </div>

                    <div class="form-group">
                      <label class="control-label">@lang('register.respassword')</label>
                      <input type="password" data-parsley-equalto="#inputSPassword" class="form-control" required="" minlength="5">
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="inputDirect">@lang('register.direct')</label>
                      <input type="text" class="form-control" required="" name="direct_id" id="inputDirect">
                      <span class="help-block">
                        <div class="btn-group">
                          <a href="{{ route('network.binary', ['lang' => \App::getLocale()]) }}" target="_blank" class="btn btn-primary"><span class="md md-swap-vert"></span> @lang('register.uplineLink')</a>
                          <button type="button" class="btn btn-success btn-show" data-toggle="modal" data-target="#showModal" data-url="{{ route('member.showModal', ['lang' => \App::getLocale()]) }}">
                            <span class="md md-help"></span> @lang('register.checkID')
                          </button>
                        </div>
                      </span>
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="inputUpline">@lang('register.binary')</label>
                      <input type="text" class="form-control" required="" name="parent_id" id="inputUpline" @if (\Input::has('u')) value="{{ trim(\Input::get('u')) }}" @endif>
                      <span class="help-block">
                        <div class="btn-group">
                          <a href="{{ route('network.binary', ['lang' => \App::getLocale()]) }}" target="_blank" class="btn btn-primary"><span class="md md-swap-vert"></span> @lang('register.uplineLink')</a>
                          <button type="button" class="btn btn-success btn-show" data-toggle="modal" data-target="#showModal" data-url="{{ route('member.showModal', ['lang' => \App::getLocale()]) }}">
                            <span class="md md-help"></span> @lang('register.checkID')
                          </button>
                        </div>
                      </span>
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="inputPosition">@lang('register.position')</label>
                      <select class="form-control" name="position" id="inputPosition">
                        <option value="left" @if (\Input::get('p') == 'left') selected="" @endif>@lang('register.position.left')</option>
                        <option value="right" @if (\Input::get('p') == 'right') selected="" @endif>@lang('register.position.right')</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="inputPoint">@lang('register.registerPoint')</label>
                      <div class="input-group">
                        <select class="form-control" name="point_amount" id="inputPoint">
                          @for ($i=0; $i<=50; $i+=10)
                            <option value="{{ $i }}">{{ $i }}</option>
                          @endfor
                        </select>
                        <span class="input-group-addon">%</span>
                      </div>
                      <span class="help-block">
                        <p style="margin-bottom:5px;"><small>@lang('register.registerNeed') <span class="theme-text" id="registerPointValue"></span></small></p>
                        <p><small>@lang('register.promoNeed') <span class="theme-text" id="promotionPointValue"></span></small></p>
                      </span>
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="inputS">@lang('register.security')</label>
                      <input type="password" class="form-control" required="" name="s" id="inputS">
                    </div>

                    <div class="form-group">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" required="" name="terms"> @lang('register.agree')
                        </label>
                      </div>
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

  <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="showModalLabel">
            <span class="md md-accessibility"></span> @lang('register.modal.title')
          </h4>
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
