<?php
  use App\Repositories\SharesRepository;
  $repo = new SharesRepository;
  $state = $repo->getCurrentShareState();
?>

@extends('back.app')

@section('title')
  Split Shares | {{ config('app.name') }} 
@stop

@section('breadcrumb')
<ul class="breadcrumb">
  <li><a href="#">Front Page</a></li>
  <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
</ul>
@stop

@section('content')
<main>
  @include('back.include.sidebar')
  <div class="main-container">
    @include('back.include.header')
    <div class="main-content" autoscroll="true" bs-affix-target="" init-ripples="" style="">
      <section>
        <div class="page-header">
          <h1><i class="md md-settings-ethernet"></i> Split Shares</h1>
        </div>
        <div class="row m-b-10">
          <div class="col-md-2">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h2 class="panel-title grey-text">Current Price</h2>
                <h1 class="m-t-10 m-b-5 f30" id="currentShares">{{ number_format($state->current_price, 3) }}</h1>
                <div class="row">
                  <div class="col-xs-6">
                    <div class="progress m-b-5">
                      <div class="progress-bar" style="width: 100%;"></div>
                    </div>
                  </div>
                </div>
                <br>
                <button class="btn btn-danger btn-flat-bordered" id="removeSharesBtn" data-url="{{ route('admin.shares.removeQueue') }}">
                  <span class="btn-preloader">
                    <i class="md md-cached md-spin"></i>
                  </span>
                  <span>
                    <i class="md md-close"></i> Remove Queued Shares
                  </span>
                </button>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="well white">
              <form role="form" id="splitForm" onsubmit="return false;" class="action-form" http-type="post" data-url="{{ route('admin.postSplit') }}">
                <fieldset>
                  <div class="form-group">
                    <label class="control-label">Split To</label>
                    <input type="number" step="0.001" class="form-control" value="0" required="" name="split_to">
                  </div>

                  <div class="form-group">
                    <label class="control-label">Split By</label>
                    <input type="number" step="any" min="0" class="form-control" name="split_by" required="" value="0">
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                      <span class="btn-preloader">
                        <i class="md md-cached md-spin"></i>
                      </span>
                      <span>Submit</span>
                    </button>
                    <button type="reset" class="btn btn-default">Cancel</button>
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
