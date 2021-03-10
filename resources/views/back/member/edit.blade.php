<?php
  use App\Models\Package;
  $mUser = $model->user;
  $detail = $model->detail;
  $wallet = $model->wallet;
  $shares = $model->shares;
  $packages = Package::all();
?>

@extends('back.app')

@section('title')
  Edit Member | {{ config('app.name') }}
@stop

@section('breadcrumb')
  <ul class="breadcrumb">
    <li><a href="#">Front Page</a></li>
    <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
    <li class="active">Edit Member</li>
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
            <h1><i class="md md-settings"></i> Editing {{ $model->username }}</h1>
          </div>
          <div class="row m-b-40">
            <div class="col-md-6">
              <div class="card">
                <div class="card-content">
                  <p class="text-uppercase theme-text">Basic Detail</p>
                  <form role="form" class="action-form" data-url="{{ route('admin.member.postUpdate', ['id' => $model->id]) }}" http-type="post" data-nationality="true">
                    <fieldset>
                      <input type="hidden" name="is_update_basic" value="true">
                      <div class="form-group">
                        <label class="control-label normal">Ban?</label>
                        <div class="switch">
                          <label class="filled"> No
                          <input type="checkbox" name="is_ban" @if ($mUser->is_ban) checked="checked" @endif> <span class="lever"></span> Yes </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label" for="inputName">Name</label>
                        <input type="text" name="first_name" class="form-control" id="inputName" value="{{ $mUser->first_name }}">
                      </div>

                      <div class="form-group">
                        <label class="control-label" for="inputPhone1">Phone 1</label>
                        <input type="text" name="phone1" class="form-control" id="inputPhone1" value="{{ $detail->phone1 }}">
                      </div>

                      <div class="form-group">
                        <label class="control-label" for="inputPhone1">Phone 2</label>
                        <input type="text" name="phone2" class="form-control" id="inputPhone2" value="{{ $detail->phone2 }}">
                      </div>

                      <div class="form-group">
                        <label class="control-label" for="inputMobile">Mobile Phone</label>
                        <input type="text" name="mobile_phone" class="form-control" id="inputMobile" value="{{ $detail->mobile_phone }}">
                      </div>

                      <div class="form-group">
                        <label class="control-label" id="inputGender">Gender</label>
                        <select class="form-control" name="gender" id="inputGender">
                          <option value="Male" @if ($detail->gender == 'Male') selected="" @endif>Male</option>
                          <option value="Female" @if ($detail->gender == 'Female') selected="" @endif>Female</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label class="control-label" id="inputId">Identification Card Number</label>
                        <input type="text" name="identification_number" class="form-control" id="inputId" value="{{ $detail->identification_number }}">
                      </div>

                      <?php $countries = config('misc.countries'); ksort($countries); ?>
                      <div class="form-group">
                        <label class="control-label" for="inputNationality">Nationality</label>
                        <select class="form-control dd-icon" name="nationality" id="inputNationality">
                          @foreach ($countries as $country => $value)
                            <option value="{{ $country }}" @if ($detail->nationality == $country) selected="" @endif data-imagesrc="{{ asset('assets/img/flags/' . $country . '.png') }}" data-description="Selected Country">{{ $country }}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="form-group">
                        <label class="control-label" id="inputBName">Beneficiary Name</label>
                        <input type="text" name="beneficiary_name" class="form-control" id="inputBName" value="{{ $detail->beneficiary_name }}">
                      </div>

                      <div class="form-group">
                        <label class="control-label" for="inputBeneficiaryNationality">Beneficiary Nationality</label>
                        <select class="form-control dd-icon" name="beneficiary_nationality" id="inputBeneficiaryNationality">
                          @foreach ($countries as $country => $value)
                            <option value="{{ $country }}" @if ($detail->beneficiary_nationality == $country) selected="" @endif data-imagesrc="{{ asset('assets/img/flags/' . $country . '.png') }}" data-description="Selected Country">{{ $country }}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="form-group">
                        <label class="control-label" id="inputSName">Spouse Name</label>
                        <input type="text" name="spouse_name" class="form-control" id="inputSName" value="{{ $detail->spouse_name }}">
                      </div>

                      <div class="form-group">
                        <label class="control-label" id="inputSDOB">Spouse DOB</label>
                        <input type="text" name="date_of_birth" id="inputSDOB" class="form-control datepicker" value="{{ $detail->spouse_dob }}" data-date-format="YYYY-MM-DD">
                      </div>

                      <div class="form-group">
                        <label class="control-label" id="inputDOB">Date of Birth</label>
                        <input type="text" name="date_of_birth" id="inputDOB" class="form-control datepicker" value="{{ $detail->date_of_birth }}" data-date-format="YYYY-MM-DD">
                      </div>

                      <div class="form-group">
                        <label class="control-label" id="inputJoinDate">Join Date</label>
                        <input type="text" name="created_at" required="" id="inputJoinDate" class="form-control datepicker" value="{{ $model->created_at }}" data-date-format="YYYY-MM-DD">
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

            <div class="col-md-6">
              <div class="card">
                <div class="card-content">
                  <p class="text-uppercase theme-text">Bonus Detail</p>
                  <form role="form" class="action-form" data-url="{{ route('admin.member.postUpdate', ['id' => $model->id]) }}" http-type="post">
                    <fieldset>
                      <div class="form-group">
                        <label class="control-label">Original Package</label>
                        <div class="input-group">
                          <select class="form-control" name="original_amount">
                            <option value="0" @if ($model->original_amount == 0) selected="" @endif>0</option>
                            @foreach ($packages as $package)
                              <option value="{{ $package->package_amount }}" @if ($model->original_amount == $package->package_amount) selected="" @endif>{{ (float) $package->package_amount }}</option>
                            @endforeach
                          </select>
                          <span class="input-group-addon">USD</span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label">Package</label>
                        <div class="input-group">
                          <select class="form-control" name="package_amount">
                            @foreach ($packages as $package)
                              <option value="{{ $package->package_amount }}" @if ($model->package_amount == $package->package_amount) selected="" @endif>{{ (float) $package->package_amount }}</option>
                            @endforeach
                          </select>
                          <span class="input-group-addon">USD</span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label">Direct</label>
                        <div class="input-group">
                          <input type="number" class="form-control" value="{{ (float) $model->direct_percent }}" name="direct_percent" required="">
                          <span class="input-group-addon">%</span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label">Group Level</label>
                        <div class="input-group">
                          <input type="number" class="form-control" value="{{ (integer) $model->group_level }}" name="group_level" required="">
                          <span class="input-group-addon">level(s)</span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label">Pairing</label>
                        <div class="input-group">
                          <input type="number" class="form-control" value="{{ (float) $model->pairing_percent }}" name="pairing_percent" required="">
                          <span class="input-group-addon">%</span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label">Max Pairing</label>
                        <input type="number" class="form-control" value="{{ (float) $model->max_pair }}" name="max_pair" required="">
                      </div>

                      <div class="form-group">
                        <label class="control-label">Max Pairing Bonus</label>
                        <div class="input-group">
                          <input type="number" class="form-control" value="{{ (float) $model->max_pairing_bonus }}" name="max_pairing_bonus" required="">
                          <span class="input-group-addon">USD</span>
                        </div>
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
          </div>

          <div class="row m-b-40">
            <div class="col-md-6">
              <div class="card">
                <div class="card-content">
                  <p class="text-uppercase theme-text">Wallet Detail</p>
                  <form role="form" class="action-form" data-url="{{ route('admin.member.postUpdate', ['id' => $model->id]) }}" http-type="post">
                    <fieldset>
                      <input type="hidden" name="is_update_wallet" value="true">
                      <div class="form-group">
                        <label class="control-label">Register Point</label>
                        <div class="input-group">
                          <input type="number" step="any" class="form-control" name="register_point" value="{{ (float) $wallet->register_point }}" required="">
                          <span class="input-group-addon">USD</span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label">Lock Register</label>
                        <div class="switch">
                          <label class="filled"> 
                          No <input type="checkbox" name="lock_register" @if ($wallet->lock_register) checked="checked" @endif> <span class="lever"></span> Yes </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label">Purchase Point</label>
                        <div class="input-group">
                          <input type="number" step="any" class="form-control" name="purchase_point" value="{{ (float) $wallet->purchase_point }}" required="">
                          <span class="input-group-addon">USD</span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label">Promotion Point</label>
                        <div class="input-group">
                          <input type="number" step="any" class="form-control" name="promotion_point" value="{{ (float) $wallet->promotion_point }}" required="">
                          <span class="input-group-addon">USD</span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label">Lock Promotion</label>
                        <div class="switch">
                          <label class="filled"> 
                          No <input type="checkbox" name="lock_promotion" @if ($wallet->lock_promotion) checked="checked" @endif> <span class="lever"></span> Yes </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label">Cash Point</label>
                        <div class="input-group">
                          <input type="number" step="any" class="form-control" name="cash_point" value="{{ (float) $wallet->cash_point }}" required="">
                          <span class="input-group-addon">USD</span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label">Lock Cash</label>
                        <div class="switch">
                          <label class="filled"> 
                          No <input type="checkbox" name="lock_cash" @if ($wallet->lock_cash) checked="checked" @endif> <span class="lever"></span> Yes </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label">MD Point</label>
                        <div class="input-group">
                          <input type="number" step="any" class="form-control" name="md_point" value="{{ (float) $wallet->md_point }}" required="">
                          <span class="input-group-addon">USD</span>
                        </div>
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

            <div class="col-md-6">
              <div class="card">
                <div class="card-content">
                  <p class="text-uppercase theme-text">Shares Detail</p>
                  <form role="form" class="action-form" data-url="{{ route('admin.member.postUpdate', ['id' => $model->id]) }}" http-type="post">
                    <fieldset>
                      <div class="form-group">
                        <label class="control-label">Amount</label>
                        <div class="input-group">
                          <input type="number" class="form-control" name="amount" value="{{ (integer) $shares->amount }}" required="">
                          <span class="input-group-addon">shares</span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label">Shares Limit</label>
                        <div class="input-group">
                          <input type="number" class="form-control" name="share_limit" value="{{ (integer) $shares->share_limit }}" required="">
                          <span class="input-group-addon">shares</span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label">Shares Limit</label>
                        <div class="input-group">
                          <input type="number" class="form-control" name="max_share_sale" value="{{ (integer) $shares->max_share_sale }}" required="">
                          <span class="input-group-addon">shares</span>
                        </div>
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
          </div>

          <div class="row m-b-40">
            <div class="col-md-6">
              <div class="card">
                <div class="card-content">
                  <p class="text-uppercase theme-text">Account Password</p>
                  <form role="form" class="action-form" data-url="{{ route('admin.member.postUpdate', ['id' => $model->id]) }}" http-type="post" data-parsley-validate="">
                    <fieldset>
                      <div class="form-group">
                        <label class="control-label" for="inputPassword">New Password</label>
                        <input type="password" name="password" id="inputPassword" class="form-control" minlength="5">
                      </div>

                      <div class="form-group">
                        <label class="control-label">Retype New Password</label>
                        <input type="password" data-parsley-equalto="#inputPassword" class="form-control" minlength="5">
                      </div>

                      <div class="form-group">
                        <label class="control-label" for="inputSecurity">New Security Password</label>
                        <input type="password" name="secret_password" id="inputSecurity" class="form-control" minlength="5">
                      </div>

                      <div class="form-group">
                        <label class="control-label">Retype New Security Password</label>
                        <input type="password" data-parsley-equalto="#inputSecurity" class="form-control" minlength="5">
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
          </div>
        </section>
      </div>
    </div>
  </main>
@stop
