@extends('front.app')

@section('title')
@lang('transfer.title') | {{ config('app.name') }}
@stop

@section('breadcrumb')
<ul class="breadcrumb">
  <li><a href="#">@lang('breadcrumbs.front')</a></li>
  <li><a href="{{ route('home', ['lang' => \App::getLocale()]) }}">@lang('breadcrumbs.dashboard')</a></li>
  <li class="active">@lang('breadcrumbs.transfer')</li>
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
          <h1><i class="md md-swap-vert"></i> @lang('transfer.title')</h1>
          <p class="lead">@lang('transfer.subTitle')</p>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="card small">
              <div class="theme-lighten-1 p-10">
                <div class="pull-right">
                  <div> <i class="md md-account-balance-wallet text-rgb-5"></i></div>
                </div>
                <h4 class="no-margin white-text w600">@lang('common.pointTitle')</h4>
                <div class="f11" style="opacity:0.8"> <i class="md md-visibility"></i> @lang('common.pointSub')</div>
              </div>
              <div class="card-content p-10">
                <div class="row">
                  <div class="col-md-4 text-center" style="border-right: 1px #F0F0F0 solid;">
                    <h3 class="no-margin w300"><span data-count data-start="0" data-end="{{ $member->wallet->cash_point }}" data-decimal="2"></span></h3>
                    <p class="grey-text w600">@lang('common.cash')</p>
                  </div>
                  <div class="col-md-4 text-center" style="border-right: 1px #F0F0F0 solid;">
                    <h3 class="no-margin w300"><span data-count data-start="0" data-end="{{ $member->wallet->register_point }}" data-decimal="0"></span></h3>
                    <p class="grey-text w600">@lang('common.register')</p>
                  </div>
                  <div class="col-md-4 text-center">
                    <h3 class="no-margin w300"><span data-count data-start="0" data-end="{{ $member->wallet->promotion_point }}" data-decimal="2"></span></h3>
                    <p class="grey-text w600">@lang('common.promotion')</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-8">
            <div class="well white">
              <form id="transferForm" role="form" class="action-form" data-url="{{ route('transaction.postTransfer', ['lang' => \App::getLocale()]) }}" data-parsley-validate="" onsubmit="return false;" http-type="post">
                <fieldset>
                  <div class="form-group">
                    <label class="control-label">@lang('transfer.transfer')</label>
                    <select class="form-control" name="type">
                      <option value="cash">@lang('common.cash')</option>
                      <option value="promotion">@lang('common.promotion')</option>
                      <option value="register">@lang('common.register')</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label class="control-label">@lang('transfer.amount')</label>
                    <div class="input-group">
                      <span class="input-group-addon">$</span>
                      <input type="number" min="10" class="form-control" name="amount" required="">
                    </div>
                    <span class="help-block">@lang('transfer.amountNotice')</span>
                  </div>

                  <div class="form-group">
                    <label class="control-label">@lang('transfer.target')</label>
                    <input type="text" class="form-control" name="to_username" required="">
                    <span class="help-block">@lang('transfer.targetNotice')</span>
                    <button type="button" class="btn btn-success btn-show" data-toggle="modal" data-target="#showModal" data-url="{{ route('member.showModal', ['lang' => \App::getLocale()]) }}">
                      <span class="md md-help"></span> @lang('register.checkID')
                    </button>
                  </div>

                  <div class="form-group">
                    <label class="control-label">@lang('transfer.security')</label>
                    <input type="password" class="form-control" name="s" required="">
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
