<?php
  use App\Repositories\SharesRepository;
  use Carbon\Carbon;
  use Illuminate\Support\Str;
  $sharesRepo = new SharesRepository;
  $announcementModel = new \App\Models\Announcement;
?>

@extends('front.app')

@section('title')
  {{ config('app.name') }}
@stop

@section('breadcrumb')
  <ul class="breadcrumb">
    <li><a href="#">@lang('breadcrumbs.front')</a></li>
    <li class="active">@lang('breadcrumbs.dashboard')</li>
  </ul>
@stop

@section('content')
  <main>
    @include('front.include.sidebar')
    <div class="main-container">
      @include('front.include.header')
      <div class="main-content" autoscroll="true" bs-affix-target="" init-ripples="" style="">
        <div class="dashboard grey lighten-3">
          <div class="row no-gutter">
            <div class="col-sm-12 col-md-12 col-lg-12" style="background:#F9F9F9;">
              <div class="p-20 clearfix">
                <div class="pull-right">
                  <a href="{{ route('network.binary', ['lang' => \App::getLocale()]) }}" target="_blank" class="btn btn-round-sm btn-link" data-toggle="tooltip" title="@lang('home.qCheckHierarchy')"><i class="md md-swap-vert"></i></a>
                  <a href="{{ route('member.register', ['lang' => \App::getLocale()]) }}" class="btn btn-round-sm btn-link" data-toggle="tooltip" title="@lang('home.qAddMember')"><i class="md md-person-add"></i></a>
                  <a href="{{ route('transaction.withdraw', ['lang' => \App::getLocale()]) }}" class="btn btn-round-sm btn-link" data-toggle="tooltip" title="@lang('home.qWithdraw')"><i class="md md-account-balance-wallet"></i></a>
                  <a href="{{ route('shares.market', ['lang' => \App::getLocale()]) }}" class="btn btn-round-sm btn-link" data-toggle="tooltip" title="@lang('home.qShares')"><i class="md md-trending-up"></i></a>
                </div>

                <h4 class="grey-text">
                  <i class="md md-dashboard"></i> <span class="hidden-xs">@lang('home.qTitle')</span>
                </h4>
              </div>

              <div class="p-20 no-p-t">
                @if (is_null($member->secret_password) || $member->secret_password == '')
                <div class="row">
                  <div class="col-md-4">
                    <div class="bs-component">
                      <div class="alert alert-dismissible alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        @lang('home.spMissing') <a href="{{ route('settings.account', ['lang' => \App::getLocale()]) }}" class="alert-link" style="text-decoration: underline;">@lang('home.spMissingLink')</a>.
                      </div>
                    </div>
                  </div>
                </div>
                @endif

                <div class="row gutter-14 kpi-dashboard">
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

                  <div class="col-md-4">
                    <div class="card small">
                      <div class="theme-secondary p-10">
                        <div class="pull-right">
                          <div> <i class="md md-trending-up text-rgb-5"></i></div>
                        </div>
                        <h4 class="no-margin white-text w600">@lang('common.sharesTitle')</h4>
                        <div class="f11" style="opacity:0.8"> <i class="md md-visibility"></i>@lang('common.sharesSub')</div>
                      </div>
                      <div class="card-content p-10">
                        <div class="row">
                          <div class="col-md-4 text-center" style="border-right: 1px #F0F0F0 solid;">
                            <h3 class="no-margin w300"><span data-count data-start="0" data-end="{{ $member->wallet->purchase_point }}" data-decimal="2"></span></h3>
                            <p class="grey-text w600">@lang('common.purchase')</p>
                          </div>
                          <div class="col-md-4 text-center" style="border-right: 1px #F0F0F0 solid;">
                            <h3 class="no-margin w300"><span data-count data-start="0" data-end="{{ $member->shares->amount }}" data-decimal="0"></span></h3>
                            <p class="grey-text w600">@lang('common.active')</p>
                          </div>
                          <?php
                            $freeze = $member->freezeShares()->where('has_process', 0)->get();
                            $freezeTotal = 0;
                            if (count($freeze) > 0) {
                              foreach ($freeze as $shares) {
                                $freezeTotal += $shares->amount;
                              }
                            }
                          ?>
                          <div class="col-md-4 text-center">
                            <h3 class="no-margin w300"><span data-count data-start="0" data-end="{{ $freezeTotal }}" data-decimal="0"></span></h3>
                            <p class="grey-text w600">@lang('common.lock')</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="card small">
                      <div class="green p-10">
                        <div class="pull-right">
                          <div> <i class="md md-accessibility text-rgb-5"></i></div>
                        </div>
                        <h4 class="no-margin white-text w600">@lang('common.membersTitle')</h4>
                        <div class="f11" style="opacity:0.8"> <i class="md md-visibility"></i> @lang('common.membersSub')</div>
                      </div>
                      <div class="card-content p-10">
                        <div class="row">
                          <div class="col-md-4 text-center" style="border-right: 1px #F0F0F0 solid;">
                            <h3 class="no-margin w300" data-count data-start="0" data-end="{{ $member->children()->count() }}" data-decimal="0"></h3>
                            <p class="grey-text w600">@lang('common.direct')</p>
                          </div>
                          <div class="col-md-4 text-center" style="border-right: 1px #F0F0F0 solid;">
                            <h3 class="no-margin w300"><span data-count data-start="0" data-end="{{ $member->left_total }}" data-decimal="0"></span></h3>
                            <p class="grey-text w600">@lang('common.leftTotal')</p>
                          </div>
                          <div class="col-md-4 text-center">
                            <h3 class="no-margin w300"><span data-count data-start="0" data-end="{{ $member->right_total }}" data-decimal="0"></span></h3>
                            <p class="grey-text w600">@lang('common.rightTotal')</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <?php $currentShares = $sharesRepo->getCurrentShareState(); ?>
                <div class="row gutter-14">
                  <div class="col-md-4">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h2 class="panel-title grey-text">@lang('common.currentShareTitle')</h2>
                        <h1 class="m-t-10 m-b-5 f30">{{ number_format($currentShares->current_price, 3) }}</h1>
                        <div class="row">
                          <div class="col-xs-6">
                            <div class="progress m-b-5">
                              <div class="progress-bar" style="width: 100%;"></div>
                            </div>
                          </div>
                        </div>
                        <p class="small grey-text no-margin">
                          <?php $lastShareDate = Carbon::createFromFormat('Y-m-d H:i:s', $currentShares->updated_at); ?>
                          @lang('common.lastDate'): {{ date('d') . ' ' . date('F') . ' ' . date('Y') }}
                        </p>
                      </div>
                    </div>

                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h2 class="panel-title grey-text">@lang('common.mdpoint')</h2>
                        <h1 class="m-t-10 m-b-5 f30">{{ number_format($member->wallet->md_point, 2) }}</h1>
                        <div class="row">
                          <div class="col-xs-6">
                            <div class="progress m-b-5">
                              <div class="progress-bar" style="width: 100%;"></div>
                            </div>
                          </div>
                        </div>
                        <p class="small grey-text no-margin">
                          @lang('common.mdpointsub')
                        </p>
                      </div>
                    </div>

                    <?php $announcement = $announcementModel->orderBy('created_at', 'desc')->first(); ?>
                    @if ($announcement)
                      <?php
                        $lang = \App::getLocale();
                        $announcementTitle = null;
                        $announcementContent = null;
                        if (isset($announcement->{"title_$lang"})) $announcementTitle = $announcement->{"title_$lang"};
                        else $announcementTitle = $announcement->title_en;
                        if (isset($announcement->{"content_$lang"})) $announcementContent = $announcement->{"content_$lang"};
                        else $announcementContent = $announcement->content_en;
                      ?>
                      <div class="panel panel-success panel-announcement">
                        <div class="panel-heading">
                          <h2 class="panel-title grey-text">
                            <i class="md md-alarm"></i> {{ $announcement->created_at->format('d F Y H:i A') }}
                          </h2>
                          <h1 class="m-t-10 m-b-5 f30">
                            <i class="md md-new-releases"></i> {{ $announcementTitle }}
                          </h1>
                          <p class="small grey-text no-margin">
                            {{ Str::limit(strip_tags($announcementContent), 100) }}
                          </p>
                          <hr>
                          <a href="{{ route('announcement.read', ['id' => $announcement->id, 'lang' => $lang]) }}" class="btn btn-primary">@lang('common.read')</a>
                        </div>
                      </div>
                    @endif
                  </div>

                  <div class="col-md-8">
                    <div class="card">
                      <div class="card-header">
                        <div class="card-title">@lang('home.rateTitle')</div>
                        <div class="small grey-text">@lang('home.rateSub')</div>
                      </div>
                      <?php $countries = config('misc.countries'); ksort($countries); ?>
                      <div class="table-responsive">
                        <table class="table table-full table-full-small table-dashboard-widget-1">
                          <thead>
                            <tr>
                              <th>@lang('home.rateCountry')</th>
                              <th>@lang('home.rateCurrency')</th>
                              <th>@lang('home.rateBuy')</th>
                              <th>@lang('home.rateSell')</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($countries as $index => $country)
                            <tr>
                              <td><img src="{{ asset('assets/img/flags/' . $index . '.png') }}" alt="{{ \Lang::get('country.' . $index) }}" width="25" class="m-r-5" /> @lang('country.' . $index)</td>
                              <td>{{ $country['currency'] }}</td>
                              <td>{{ $country['buy'] }}</td>
                              <td>{{ $country['sell'] }}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <?php
    $annNew = \Cache::remember('announcement.new', 60, function () {
      return \App\Models\Announcement::whereRaw('Date(created_at) = CURDATE()')->first();
    });
  ?>
  @if ($annNew)
    <div class="modal fade" tabindex="-1" role="dialog" id="annModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">@lang('announcement.newTitle')</h4>
          </div>
          <div class="modal-body">
            <p>@lang('announcement.newContent') <a href="{{ route('announcement.read', ['id' => $annNew->id, 'lang' => $lang]) }}">@lang('announcement.newLink')</a></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">@lang('common.close')</button>
          </div>
        </div>
      </div>
    </div>
  @endif
@stop
