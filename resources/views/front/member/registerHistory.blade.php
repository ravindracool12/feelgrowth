@extends('front.app')

@section('title')
  @lang('registerHistory.title') | {{ config('app.name') }}
@stop

@section('breadcrumb')
  <ul class="breadcrumb">
    <li><a href="#">@lang('breadcrumbs.front')</a></li>
    <li><a href="{{ route('home', ['lang' => \App::getLocale()]) }}">@lang('breadcrumbs.dashboard')</a></li>
    <li><a href="{{ route('member.register', ['lang' => \App::getLocale()]) }}">@lang('breadcrumbs.register')</a></li>
    <li class="active">@lang('breadcrumbs.registerHistory')</li>
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
            <h1><i class="md md-group-add"></i> @lang('registerHistory.title')</h1>
            <p class="lead">@lang('registerHistory.subTitle')</p>
          </div>

          <div class="card">
            <div>
              <div class="datatables">
                <table class="table table-full table-full-small dt-responsive display nowrap table-grid" cellspacing="0" width="100%" role="grid" data-url="{{ route('member.registerHistoryList') }}">
                  <thead>
                    <tr>
                      <th data-id="created_at">@lang('registerHistory.join')</th>
                      <th data-id="username">@lang('registerHistory.username')</th>
                      <th data-id="package_amount">@lang('registerHistory.package')</th>
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
