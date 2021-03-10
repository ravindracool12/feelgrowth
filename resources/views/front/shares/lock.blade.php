@extends('front.app')

@section('title')
  @lang('sharesLock.title') | {{ config('app.name') }}
@stop

@section('breadcrumb')
  <ul class="breadcrumb">
    <li><a href="#">@lang('breadcrumbs.front')</a></li>
    <li><a href="{{ route('home', ['lang' => \App::getLocale()]) }}">@lang('breadcrumbs.dashboard')</a></li>
    <li><a href="{{ route('shares.market', ['lang' => \App::getLocale()]) }}">@lang('breadcrumbs.sharesMarket')</a></li>
    <li class="active">@lang('breadcrumbs.sharesLock')</li>
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
            <h1><i class="md md-account-balance"></i> @lang('sharesLock.title')</h1>
            <p class="lead">@lang('sharesLock.subTitle')</p>
          </div>

          <div class="card">
            <div>
              <div class="datatables">
                <table class="table table-full table-full-small dt-responsive display nowrap table-grid" cellspacing="0" width="100%" role="grid" data-url="{{ route('shares.freezeList') }}">
                  <thead>
                    <tr>
                      <th data-id="created_at">@lang('sharesLock.create')</th>
                      <th data-id="active_date">@lang('sharesLock.active')</th>
                      <th data-id="amount">@lang('sharesLock.amount')</th>
                      <th data-id="has_process">@lang('sharesLock.process')</th>
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
