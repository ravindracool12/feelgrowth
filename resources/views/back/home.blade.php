<?php
  use Carbon\Carbon;
  use App\Repositories\SharesRepository;
  $repo = new SharesRepository;
  $state = $repo->getCurrentShareState();
  $lastUpdate = Carbon::createFromFormat('Y-m-d H:i:s', $state->updated_at);
  $mt = \App::isDownForMaintenance();
?>

@extends('back.app')

@section('title')
  Admin | {{ config('app.name') }} 
@stop

@section('breadcrumb')
<ul class="breadcrumb">
  <li><a href="#">Front Page</a></li>
  <li class="active">Dashboard</li>
</ul>
@stop

@section('content')
<main>
  @include('back.include.sidebar')
  <div class="main-container">
    @include('back.include.header')
    <div class="main-content" autoscroll="true" bs-affix-target="" init-ripples="" style="">
      <section class="dashboard lighten-3">
        <div class="row">
          <div class="col-md-2">
            <div class="well white">
              <div class="btn-group">
                <button class="btn btn-block btn-flat-border btn-primary btn-cron" data-url="{{ route('admin.cron') . '?type=pairing' }}">
                  <span class="btn-preloader">
                    <i class="md md-cached md-spin"></i>
                  </span>
                  <span>
                    <i class="md md-fast-forward"></i> Run Pairing
                  </span>
                </button>

                <button class="btn btn-block btn-flat-border btn-success btn-cron" data-url="{{ route('admin.cron') . '?type=checkGroup' }}">
                  <span class="btn-preloader">
                    <i class="md md-cached md-spin"></i>
                  </span>
                  <span>
                    <i class="md md-fast-forward"></i> Run Group Check
                  </span>
                </button>

                <button class="btn btn-block btn-flat-border btn-info btn-cron" data-url="{{ route('admin.cron') . '?type=group' }}">
                  <span class="btn-preloader">
                    <i class="md md-cached md-spin"></i>
                  </span>
                  <span>
                    <i class="md md-fast-forward"></i> Run Group Bonus
                  </span>
                </button>

                <button class="btn btn-block btn-flat-border btn-warning btn-cron" data-url="{{ route('admin.cron') . '?type=freeze' }}">
                  <span class="btn-preloader">
                    <i class="md md-cached md-spin"></i>
                  </span>
                  <span>
                    <i class="md md-fast-forward"></i> Run Freeze Check
                  </span>
                </button>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="well white">
              <p>Site Maintenace: @if ($mt) <span style="color:#f00;">ON</span> @else <span style="color:#239c1d;">OFF</span> @endif</p>
              <button id="btnMaintenance" data-url="{{ route('mt.toggle') }}" class="btn btn-danger btn-flat-border">
                <span class="btn-preloader">
                  <i class="md md-cached md-spin"></i>
                </span>
                <span><i class="md md-settings-power"></i> Toggle Maintenance</span>
              </button>
            </div>
          </div>

          <div class="col-md-4">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h2 class="panel-title grey-text">Current Price</h2>
                <h1 class="m-t-10 m-b-5 f30">{{ number_format($state->current_price, 3) }}</h1>
                <div class="row">
                  <div class="col-xs-6">
                    <div class="progress m-b-5">
                      <div class="progress-bar" style="width: 100%;"></div>
                    </div>
                  </div>
                </div>
                <p class="small grey-text no-margin">
                  Last Update: {{ $lastUpdate->format('d F Y') }}
                </p>
                <a href="{{ route('admin.shares.split') }}" class="btn btn-primary btn-flat-border">
                  <span class="md md-settings-ethernet"></span> Split Shares
                </a>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <div class="card-title">Exchange Rate</div>
                <div class="small grey-text">Overview of the current exchange rate.</div>
              </div>
              <?php $countries = config('misc.countries'); ksort($countries); ?>
              <div class="table-responsive">
                <table class="table table-full table-full-small table-dashboard-widget-1">
                  <thead>
                    <tr>
                      <th>Country</th>
                      <th>Currency</th>
                      <th>Buy IN</th>
                      <th>Sell OUT</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($countries as $index => $country)
                    <tr>
                      <td><img src="{{ asset('assets/img/flags/' . $index . '.png') }}" alt="{{ \Lang::get('country.' . $index) }}" width="25" class="m-r-5" /> {{ $index }}</td>
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
      </section>
    </div>
  </div>
</main>
@stop
