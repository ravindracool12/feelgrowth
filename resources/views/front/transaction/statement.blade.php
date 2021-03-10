@extends('front.app')

@section('title')
@lang('wdStatement.title') | {{ config('app.name') }}
@stop

@section('breadcrumb')
<ul class="breadcrumb">
  <li><a href="#">@lang('breadcrumbs.front')</a></li>
  <li><a href="{{ route('home', ['lang' => \App::getLocale()]) }}">@lang('breadcrumbs.dashboard')</a></li>
  <li><a href="{{ route('transaction.withdraw', ['lang' => \App::getLocale()]) }}">@lang('breadcrumbs.withdraw')</a></li>
  <li class="active">@lang('breadcrumbs.withdrawStatement')<</li>
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
          <h1><i class="md md-account-balance"></i> @lang('wdStatement.title')</h1>
          <p class="lead">@lang('wdStatement.subTitle')</p>
        </div>

        <div class="card">
          <div class="card-content">
            <div class="datatables">
              <table class="table table-full table-full-small dt-responsive display nowrap table-grid" cellspacing="0" width="100%" role="grid" data-url="{{ route('withdraw.list', ['lang' => \App::getLocale()]) }}">
                <thead>
                  <tr>
                    <th data-id="created_at">@lang('wdStatement.create')</th>
                    <th data-id="amount">@lang('wdStatement.amount')</th>
                    <th data-id="admin">@lang('wdStatement.adminFee')</th>
                    <th data-id="status">@lang('wdStatement.status')</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</main>
@stop
