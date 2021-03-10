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
  <li class="active">Register ROOT Member</li>
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
          <p class="lead">ROOT Member Registration</p>
        </div>
        <div class="well white">
          <form class="action-form" data-parsley-validate="" role="form" id="registerForm" http-type="post" data-url="{{ route('admin.member.postRegister', ['type' => 'root']) }}">
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
@stop
