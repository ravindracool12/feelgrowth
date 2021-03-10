<?php
use App\Models\Package;
$packages = Package::all();
?>

@extends('back.app')

@section('title')
Register New Member | {{ config('app.name') }}
@stop

@section('breadcrumb')
<ul class="breadcrumb">
  <li><a href="#">Front Page</a></li>
  <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
  <li class="active">Register Member</li>
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
          <h1><i class="md md-person-add"></i> Register New Member</h1>
          <p class="lead">Member Registration</p>
        </div>
        <div class="well white">
          <form class="action-form" data-parsley-validate="" role="form" id="registerForm" http-type="post" data-url="{{ route('admin.member.postRegister', ['type' => 'common']) }}">
            <fieldset>
              <div class="form-group">
                <label class="control-label" for="inputPackage">Package</label>
                <div class="input-group">
                  <select class="form-control" name="package_id" id="inputPackage" required="">
                    @if (count($packages) > 0)
                    @foreach ($packages as $package)
                    <option value="{{ $package->id }}">
                      {{ number_format($package->package_amount, 0) }}
                    </option>
                    @endforeach
                    @endif
                  </select>
                  <span class="input-group-addon">USD</span>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label">Email</label>
                <input type="email" name="email" class="form-control" required="">
              </div>

              <div class="form-group">
                <label class="control-label">Username</label>
                <input type="text" name="username" class="form-control" required="">
              </div>

              <div class="form-group">
                <label class="control-label">Upline ID</label>
                <input type="text" name="direct_id" class="form-control" required="">
                <span class="help-block">
                  <button type="button" class="btn btn-success btn-show" data-toggle="modal" data-target="#showModal" data-url="{{ route('admin.member.showModal') }}">
                    <span class="md md-help"></span> Check ID
                  </button>
                </span>
              </div>

              <div class="form-group">
                <label class="control-label">Binary ID</label>
                <input type="text" name="parent_id" class="form-control" required="">
                <span class="help-block">
                  <button type="button" class="btn btn-success btn-show" data-toggle="modal" data-target="#showModal" data-url="{{ route('admin.member.showModal') }}">
                    <span class="md md-help"></span> Check ID
                  </button>
                </span>
              </div>

              <div class="form-group">
                <label class="control-label" for="inputPosition">Position</label>
                <select class="form-control" name="position" id="inputPosition">
                  <option value="left" @if (\Input::get('p') == 'left') selected="" @endif>LEFT</option>
                  <option value="right" @if (\Input::get('p') == 'right') selected="" @endif>RIGHT</option>
                </select>
              </div>

              <div class="form-group">
                <label class="control-label" for="inputSecPassword">Secret Password</label>
                <input type="password" id="inputSecPassword" name="secret_password" class="form-control" required="">
              </div>

              <div class="form-group">
                <label class="control-label">Retype Secret Password</label>
                <input type="password" data-parsley-equalto="#inputSecPassword" class="form-control" required="">
              </div>

              <div class="form-group">
                <label class="control-label" for="inputPassword">Password</label>
                <input type="password" id="inputPassword" name="password" class="form-control" required="">
              </div>

              <div class="form-group">
                <label class="control-label">Re-Password</label>
                <input type="password" data-parsley-equalto="#inputPassword" class="form-control" required="">
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
      </section>
    </div>
  </div>
</main>

<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="showModalLabel">
          <span class="md md-accessibility"></span> @lang('register.modal.title')
        </h4>
      </div>
      <div class="modal-body">
        <div class="loading text-center">
          <img src="{{ asset('assets/img/loading.gif') }}" alt="Network Loading">
          <br>
          <small class="text-primary">@lang('common.modal.load')</small>
        </div>

        <div class="error text-center">
          <i class="md md-error"></i>
          <br>
          <small class="text-danger">@lang('common.modal.error')</small>
        </div>

        <div id="modalContent"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-raised" data-dismiss="modal">@lang('common.close')</button>
      </div>
    </div>
  </div>
</div>
@stop
