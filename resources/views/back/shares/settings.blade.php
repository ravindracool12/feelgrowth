<?php
$shares = \DB::table('Shares_Centre')->first();
?>

@extends('back.app')

@section('title')
Shares Settings | {{ config('app.name') }}
@stop

@section('breadcrumb')
<ul class="breadcrumb">
  <li><a href="#">Front Page</a></li>
  <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
  <li class="active">Shares Settings</li>
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
          <h1><i class="md md-trending-up"></i> Shares Settings</h1>
        </div>

        <div class="card">
          <div>
            <table id="sharesListTable" class="table table-bordered table-full table-full-small" cellspacing="0" width="100%" role="grid">
              <thead>
                <tr>
                  <th>Minimum Price</th>
                  <th>Current Price</th>
                  <th>Current Sales Total</th>
                  <th>Raise Every</th>
                  <th>Raise By</th>
                  <th>Always Buy Company?</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <td>
                  <div class="input-group">
                    <span class="input-group-addon">$</span>
                    <input type="number" name="minimum_price" class="form-control" value="{{ (float) $shares->minimum_price }}" required="" min="0">
                  </div>
                </td>

                <td>
                  <div class="input-group">
                    <span class="input-group-addon">$</span>
                    <input type="number" name="current_price" class="form-control" value="{{ (float) $shares->current_price }}" required="" min="0">
                  </div>
                </td>

                <td>
                  <div class="input-group">
                    <input type="number" class="form-control" value="{{ (integer) $shares->current_accumulate }}" disabled="" readonly="">
                    <span class="input-group-addon">shares</span>
                  </div>
                </td>

                <td>
                  <div class="input-group">
                    <input type="number" name="raise_limit" class="form-control" value="{{ (integer) $shares->raise_limit }}" required="" min="0">
                    <span class="input-group-addon">shares</span>
                  </div>
                </td>

                <td>
                  <div class="input-group">
                    <span class="input-group-addon">$</span>
                    <input type="number" name="raise_by" class="form-control" value="{{ (float) $shares->raise_by }}" required="" min="0">
                  </div>
                </td>

                <td colspan="2">
                  <div class="switch">
                    <label class="filled"> 
                    No <input type="checkbox" name="always_company" @if ($shares->always_company) checked="checked" @endif> <span class="lever"></span> Yes </label>
                  </div>
                </td>

                <td>
                  <button class="btn btn-warning btn-flat-border btn-update" data-url="{{ route('admin.shares.update', ['id' => $shares->id]) }}" type="submit">
                    <i class="md md-mode-edit"></i> Update
                  </button>
                </td>
              </tbody>
            </table>
          </div>
        </div>
      </section>
    </div>
  </div>
</main>
@stop
