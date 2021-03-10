@extends('front.app')

@section('title')
@lang('misc.summaryTitle') | {{ config('app.name') }}
@stop

@section('breadcrumb')
<ul class="breadcrumb">
  <li><a href="#">@lang('breadcrumbs.front')</a></li>
  <li><a href="{{ route('home', ['lang' => \App::getLocale()]) }}">@lang('breadcrumbs.dashboard')</a></li>
  <li class="active">@lang('breadcrumbs.summary')</li>
</ul>
@stop

@section('content')
<main>
  @include('front.include.sidebar')
  <div class="main-container">
    @include('front.include.header')
    <div class="main-content" autoscroll="true" bs-affix-target="" init-ripples="" style="">
      <section class="tables-data">
        <div class="page-header">
          <h1><i class="md md-account-balance"></i> @lang('misc.summaryTitle')</h1>
          <p class="lead">@lang('misc.summarySubtitle')</p>
        </div>

        <div class="row m-b-10">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <p class="theme-text text-uppercase">@lang('misc.transfer')</p>
              </div>
              <div class="card-content">
                <div class="datatables">
                  <table class="table table-full table-full-small dt-responsive display nowrap table-grid" cellspacing="0" width="100%" role="grid" data-url="{{ route('transfer.list', ['lang' => \App::getLocale()]) }}">
                    <thead>
                      <tr>
                        <th data-id="created_at">@lang('misc.create')</th>
                        <th data-id="from_username" data-visible="xs">@lang('common.from')</th>
                        <th data-id="to_username">@lang('common.to')</th>
                        <th data-id="type">@lang('misc.transfer.type')</th>
                        <th data-id="amount">@lang('misc.transfer.amount')</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <p class="theme-text text-uppercase">@lang('misc.withdraw')</p>
              </div>
              <div class="card-content">
                <div class="datatables">
                  <table class="table table-full table-full-small dt-responsive display nowrap table-grid" cellspacing="0" width="100%" role="grid" data-url="{{ route('withdraw.list', ['lang' => \App::getLocale()]) }}">
                    <thead>
                      <tr>
                        <th data-id="created_at">@lang('wdStatement.create')</th>
                        <th data-id="amount">@lang('wdStatement.amount')</th>
                        <th data-id="status">@lang('wdStatement.status')</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row m-b-10">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <p class="theme-text text-uppercase">@lang('misc.direct')</p>
              </div>
              <div class="card-content">
                <div class="datatables">
                  <table class="table table-full table-full-small dt-responsive display nowrap table-grid" cellspacing="0" width="100%" role="grid" data-url="{{ route('bonus.directList', ['lang' => \App::getLocale()]) }}">
                    <thead>
                      <tr>
                        <th data-id="created_at">@lang('misc.create')</th>
                        <th data-id="from_username">@lang('common.from')</th>
                        <th data-id="amount_cash">@lang('misc.cash')</th>
                        <th data-id="amount_promotion">@lang('misc.promotion')</th>
                        <th data-id="total">@lang('misc.total')</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <p class="theme-text text-uppercase">@lang('misc.override')</p>
              </div>
              <div class="card-content">
                <div class="datatables">
                  <table class="table table-full table-full-small dt-responsive display nowrap table-grid" cellspacing="0" width="100%" role="grid" data-url="{{ route('bonus.overrideList', ['lang' => \App::getLocale()]) }}">
                    <thead>
                      <tr>
                        <th data-id="created_at">@lang('misc.create')</th>
                        <th data-id="from_username">@lang('common.from')</th>
                        <th data-id="amount_cash">@lang('misc.cash')</th>
                        <th data-id="amount_promotion">@lang('misc.promotion')</th>
                        <th data-id="total">@lang('misc.total')</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <p class="theme-text text-uppercase">@lang('misc.group')</p>
              </div>
              <div class="card-content">
                <div class="datatables">
                  <table class="table table-full table-full-small dt-responsive display nowrap table-grid" cellspacing="0" width="100%" role="grid" data-url="{{ route('bonus.groupList', ['lang' => \App::getLocale()]) }}">
                    <thead>
                      <tr>
                        <th data-id="created_at">@lang('misc.create')</th>
                        <th data-id="from_usernames" data-orderable="false">@lang('misc.fromUsernames')</th>
                        <th data-id="amount_cash">@lang('misc.cash')</th>
                        <th data-id="amount_promotion">@lang('misc.promotion')</th>
                        <th data-id="total">@lang('misc.total')</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                  <a href="{{ route('bonus.group.pending', ['lang' => \App::getLocale()]) }}" class="btn btn-primary" target="_blank">
                    <i class="md md-wallet-giftcard"></i> @lang('misc.groupPending.btnLabel')
                  </a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <p class="theme-text text-uppercase">@lang('misc.pairing')</p>
              </div>
              <div class="card-content">
                <div class="datatables">
                  <table class="table table-full table-full-small dt-responsive display nowrap table-grid" cellspacing="0" width="100%" role="grid" data-url="{{ route('bonus.pairingList', ['lang' => \App::getLocale()]) }}">
                    <thead>
                      <tr>
                        <th data-id="created_at">@lang('misc.create')</th>
                        <th data-id="amount_cash">@lang('misc.cash')</th>
                        <th data-id="amount_promotion">@lang('misc.promotion')</th>
                        <th data-id="total">@lang('misc.total')</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</main>
@stop
