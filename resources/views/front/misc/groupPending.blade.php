@extends('front.app')

@section('title')
@lang('misc.groupPending') | {{ config('app.name') }}
@stop

@section('breadcrumb')
<ul class="breadcrumb">
  <li><a href="#">@lang('breadcrumbs.front')</a></li>
  <li><a href="{{ route('home', ['lang' => \App::getLocale()]) }}">@lang('breadcrumbs.dashboard')</a></li>
  <li class="active">@lang('breadcrumbs.groupPending')</li>
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
          <h1><i class="md md-wallet-giftcard"></i> @lang('misc.groupPending')</h1>
          <p class="lead">@lang('misc.groupPendingSubtitle')</p>
        </div>

        <div class="row m-b-10">
          <div class="col-md-12">
            <div class="card">
              <div class="card-content">
                @if ($member->is_group_bonus)
                <div class="datatables">
                  <table class="table table-full table-full-small dt-responsive display nowrap table-grid" cellspacing="0" width="100%" role="grid" data-url="{{ route('bonus.group.pendingList', ['lang' => \App::getLocale()]) }}">
                    <thead>
                      <tr>
                        <th data-id="created_at">@lang('misc.groupPending.join')</th>
                        <th data-id="active_on" data-orderable="false">@lang('misc.groupPending.active')</th>
                        <th data-id="username">@lang('misc.groupPending.username')</th>
                        <th data-id="amount">@lang('misc.groupPending.amount')</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
                @else
                <div class="alert alert-danger">
                  @lang('misc.groupPending.alert')
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
