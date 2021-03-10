<?php
use App\Models\Package;
$packages = Package::orderBy('id', 'asc')->get();
?>

@extends('back.app')

@section('title')
Package Settings | {{ config('app.name') }}
@stop

@section('breadcrumb')
<ul class="breadcrumb">
  <li><a href="#">Front Page</a></li>
  <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
  <li class="active">Package Settings</li>
</ul>
@stop

@section('content')
<main>
  @include('back.include.sidebar')
  <div class="main-container">
    @include('back.include.header')
    <div class="main-content" autoscroll="true" bs-affix-target="" init-ripples="" style="">
      <section class="tables-data">
        <div class="page-header">
          <h1><i class="md md-wallet-giftcard"></i> Package</h1>
        </div>

        <div class="card">
          <div>
            <table id="packageListTable" class="table table-full table-bordered table-full-small" cellspacing="0" width="100%" role="grid">
              <thead>
                <tr>
                  <th>Amount</th>
                  <th>Direct %</th>
                  <th>Pairing %</th>
                  <th>Group Level</th>
                  <th>Max Pair Daily</th>
                  <th>Max Pair Bonus</th>
                  <th>Shares Limit</th>
                  <th>Max Shares Sales</th>
                  <th>Purchase Point</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @if (count($packages) > 0)
                @foreach ($packages as $package)
                <tr>
                  <td>
                    <div class="input-group">
                      <span class="input-group-addon">$</span>
                      <input type="number" class="form-control" name="package_amount" value="{{ (float) $package->package_amount }}" required="" min="0">
                    </div>
                  </td>

                  <td>
                    <div class="input-group">
                      <input type="number" class="form-control" name="direct_percent" value="{{ (integer) $package->direct_percent }}" required="" min="0">
                      <span class="input-group-addon">%</span>
                    </div>
                  </td>

                  <td>
                    <div class="input-group">
                      <input type="number" class="form-control" name="pairing_percent" value="{{ (integer) $package->pairing_percent }}" required="" min="0">
                      <span class="input-group-addon">%</span>
                    </div>
                  </td>

                  <td>
                    <div class="input-group">
                      <input type="number" name="group_level" class="form-control" value="{{ (integer) $package->group_level }}" required="" min="0">
                      <span class="input-group-addon">level(s)</span>
                    </div>
                  </td>

                  <td>
                    <div class="input-group">
                      <input type="number" class="form-control" name="max_pair" value="{{ (integer) $package->max_pair }}" required="" min="0">
                      <span class="input-group-addon">pair(s)</span>
                    </div>
                  </td>

                  <td>
                    <div class="input-group">
                      <span class="input-group-addon">$</span>
                      <input type="number" class="form-control" name="max_pairing_bonus" value="{{ (float) $package->max_pairing_bonus }}" required="" min="0">
                    </div>
                  </td>

                  <td>
                    <div class="input-group">
                      <input type="number" class="form-control" name="share_limit" value="{{ (integer) $package->share_limit }}" required="" min="0">
                      <span class="input-group-addon">shares</span>
                    </div>
                  </td>

                  <td>
                    <div class="input-group">
                      <span class="input-group-addon">$</span>
                      <input type="number" class="form-control" name="max_share_sale" value="{{ (float) $package->max_share_sale }}" required="" min="0">
                    </div>
                  </td>

                  <td>
                    <div class="input-group">
                      <span class="input-group-addon">$</span>
                      <input type="number" class="form-control" name="purchase_point" value="{{ (float) $package->purchase_point }}" required="" min="0">
                    </div>
                  </td>

                  <td>
                    <button class="btn btn-warning btn-flat-border btn-update" data-url="{{ route('admin.package.update', ['id' => $package->id]) }}" type="submit">
                      <i class="md md-mode-edit"></i> Update
                    </button>
                  </td>
                </tr>
                @endforeach
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </section>
    </div>
  </div>
</main>
@stop
