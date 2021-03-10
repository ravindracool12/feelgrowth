@extends('front.app')

@section('title')
@lang('withdraw.title') | {{ config('app.name') }}
@stop

@section('breadcrumb')
  <ul class="breadcrumb">
    <li><a href="#">@lang('breadcrumbs.front')</a></li>
    <li><a href="{{ route('home', ['lang' => \App::getLocale()]) }}">@lang('breadcrumbs.dashboard')</a></li>
    <li class="active">@lang('breadcrumbs.withdraw')</li>
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
            <h1><i class="md md-swap-vert"></i> @lang('withdraw.title')</h1>
            <p class="lead">@lang('withdraw.subTitle')</p>
          </div>

          <div class="row">
            <?php 
              $bankName = $member->detail->bank_name;
              $bankAccHolder = $member->detail->bank_account_holder;
              $bankAccNumber = $member->detail->bank_account_number;
            ?>

            @if (
              is_null($bankName) || 
              is_null($bankAccNumber) ||
              is_null($bankAccHolder)
            )
              <div class="col-md-4">
                <div class="bs-component">
                  <div class="alert alert-dismissible alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    @lang('withdraw.missingNotice') <a href="{{ route('settings.bank', ['lang' => \App::getLocale()]) }}" class="alert-link" style="text-decoration: underline;">@lang('withdraw.missingLink')</a>
                  </div>
                </div>
              </div>
            @endif
            <div class="col-md-4">
              <div class="card small">
                <div class="green p-10">
                  <div class="pull-right">
                    <div> <i class="md md-account-balance-wallet text-rgb-5"></i></div>
                  </div>
                  <h4 class="no-margin white-text w600">@lang('withdraw.account')</h4>
                </div>
                <div class="card-content p-10">
                  <div class="row">
                    <div class="col-md-6 text-center" style="border-right: 1px #F0F0F0 solid;">
                      <h3 class="no-margin w300"><span data-count data-start="0" data-end="{{ $member->wallet->cash_point }}" data-decimal="2"></span></h3>
                      <p class="grey-text w600">@lang('common.cash')</p>
                    </div>

                    <div class="col-md-6 text-center">
                      <h3 class="no-margin w300">{{ $bankName }}</h3>
                      <p class="grey-text w600">@lang('withdraw.bank')</p>
                    </div>

                    <div class="col-md-12 text-center" style="border-top: 1px #F0F0F0 solid;padding-top: 10px;">
                      <h3 class="no-margin w300">{{ $bankAccNumber }} / {{ $bankAccHolder }}</h3>
                      <p class="grey-text w600">@lang('withdraw.bank.account')</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-8">
              <div class="well white">
                <form id="withdrawForm" role="form" class="action-form" data-url="{{ route('transaction.postWithdraw', ['lang' => \App::getLocale()]) }}" data-parsley-validate="" onsubmit="return false;" http-type="post">
                  <fieldset>
                    <div class="form-group">
                      <label class="control-label">@lang('withdraw.amount')</label>
                      <div class="input-group">
                        <span class="input-group-addon">$</span>
                        <input type="number" min="10" class="form-control" name="amount" required="" min="300">
                      </div>
                      <span class="help-block">@lang('withdraw.amountNotice')</span>
                    </div>

                    <div class="form-group">
                      <label class="control-label">@lang('withdraw.fee')</label>
                      <h3 class="theme-text no-m-t" id="adminFeeLabel" data-percent="5">0</h3>
                    </div>

                    <div class="form-group">
                      <label class="control-label">@lang('withdraw.total')</label>
                      <h2 class="theme-text no-m-t" id="totalLabel">0</h2>
                    </div>

                    <div class="form-group">
                      <label class="control-label">@lang('withdraw.security')</label>
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
@stop
