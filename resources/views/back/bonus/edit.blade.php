<?php $type = \Input::get('type'); ?>
@extends('back.app')

@section('title')
  Bonus {{ ucwords($type) }} #{{ $model->id }} | {{ config('app.name') }}
@stop

@section('breadcrumb')
  <ul class="breadcrumb">
    <li><a href="#">Front Page</a></li>
    <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
    <li><a href="{{ route('admin.withdraw.all') }}">Withdraw List</a></li>
    <li class="active">Edit {{ ucwords($type) }} #{{ $model->id }}}</li>
  </ul>
@stop

@section('content')
  <main>
    @include('back.include.sidebar')
    <div class="main-container">
      @include('back.include.header')
      <div class="main-content" autoscroll="true" bs-affix-target="" init-ripples="" style="">
        <section>
          <div class="row m-b-10">
            <div class="col-md-8">
              <div class="well white">
                <div class="alert alert-danger">
                  Please EDIT carefully, cannot be rolled back. REMEMBER to update member wallet later.
                </div>

                <form role="form" class="action-form" data-url="{{ route('admin.bonus.update', ['id' => $model->id, 'type' => $type]) }}" http-type="post" onsubmit="return false;">
                  <fieldset>
                    <div class="form-group">
                      <label class="control-label">User ID</label>
                      <input type="text" class="form-control" value="{{ $model->username }}">
                    </div>

                    <div class="form-group">
                      <label class="control-label">Cash Point</label>
                      <input type="number" step="any" name="amount_cash" class="form-control" value="{{ (float) $model->amount_cash }}">
                    </div>

                    <div class="form-group">
                      <label class="control-label">Promotion Point</label>
                      <input type="number" step="any" name="amount_promotion" class="form-control" value="{{ (float) $model->amount_promotion }}">
                    </div>

                    <div class="form-group">
                      <label class="control-label">Total</label>
                      <input type="number" step="any" name="total" class="form-control" value="{{ (float) $model->total }}">
                    </div>

                    <div class="form-group">
                      <label class="control-label">Date Created</label>
                      <input type="text" class="form-control" value="{{ $model->created_at }}" required="" name="created_at">
                      <span class="help-block">YYYY-MM-DD HH:MM:SS format</span>
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
