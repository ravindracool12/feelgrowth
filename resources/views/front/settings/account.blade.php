@extends('front.app')

@section('title')
  @lang('settings.title1') | {{ config('app.name') }}
@stop

@section('breadcrumb')
  <ul class="breadcrumb">
    <li><a href="#">@lang('breadcrumbs.front')</a></li>
    <li><a href="{{ route('home', ['lang' => \App::getLocale()]) }}">@lang('breadcrumbs.dashboard')</a></li>
    <li class="active">@lang('breadcrumbs.settingsPersonal')</li>
  </ul>
@stop

@section('content')
  <main>
    @include('front.include.sidebar')
    <div class="main-container">
      @include('front.include.header')
      <div class="main-content" autoscroll="true" bs-affix-target="" init-ripples="" style="">
        <section>
          <div class="page-header">
            <h1><i class="md md-settings"></i> @lang('settings.title1')</h1>
            <p class="lead">@lang('settings.subTitle1')</p>
          </div>

          <div class="row m-b-40">
            <div class="col-md-6">
              <div class="well white">
                <form data-parsley-validate="" role="form" class="action-form" id="accountBasicForm" http-type="post" data-url="{{ route('account.postUpdate') }}" data-nationality="true">
                  <fieldset>
                    <div class="form-group">
                      <label class="control-label">@lang('settings.name')</label>
                      <input type="text" class="form-control" required="" value="{{ $member->user->first_name }}" name="first_name">
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="inputDOB">@lang('settings.dob')</label>
                      <input type="text" name="date_of_birth" required="" id="inputDOB" class="form-control datepicker" value="{{ $member->detail->date_of_birth }}" data-date-format="YYYY-MM-DD">
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="inputId">@lang('settings.id')</label>
                      <input type="text" name="identification_number" class="form-control" id="inputId" required="" value="{{ $member->detail->identification_number }}">
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="inputGender">@lang('settings.gender')</label>
                      <select class="form-control" name="gender" id="inputGender">
                        <option value="Male" @if ($member->detail->gender == 'Male') selected="" @endif>@lang('settings.gender.male')</option>
                        <option value="Female" @if ($member->detail->gender == 'Female') selected="" @endif>@lang('settings.gender.female')</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="inputPhone">@lang('settings.phone1')</label>
                      <input type="text" name="phone1" class="form-control" id="inputPhone" required="" value="{{ $member->detail->phone1 }}">
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="inputPhone">@lang('settings.phone2')</label>
                      <input type="text" name="phone2" class="form-control" id="inputPhone" value="{{ $member->detail->phone2 }}">
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="inputPhone">@lang('settings.mobile')</label>
                      <input type="text" name="mobile_phone" class="form-control" id="inputPhone" required="" value="{{ $member->detail->mobile_phone }}">
                    </div>

                    <?php $countries = config('misc.countries'); ksort($countries); ?>
                    @if (!is_null($member->detail->nationality))
                    <div class="form-group">
                      <label class="control-label" for="inputNationality">@lang('settings.nationality')</label>
                      <select class="form-control dd-icon">
                        <option data-imagesrc="{{ asset('assets/img/flags/' . $member->detail->nationality . '.png') }}" data-description="{{ \Lang::get('country.' . $member->detail->nationality) }}">{{ $member->detail->nationality }}</option>
                      </select>
                    </div>
                    @else
                    <div class="alert alert-danger">
                      @lang('settings.nationalityError')
                    </div>
                    @endif

                    <div class="form-group">
                      <label class="control-label" for="inputAddress">@lang('settings.address')</label>
                      <textarea name="address" class="form-control" id="inputAddress" required="">{{ $member->detail->address }}</textarea>
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="inputSpouseName">@lang('settings.spouse.name')</label>
                      <input type="text" name="spouse_name" id="inputSpouseName" class="form-control" value="{{ $member->detail->spouse_name }}">
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="inputSpouseDOB">@lang('settings.spouse.dob')</label>
                      <input type="text" name="spouse_dob" id="inputSpouseDOB" class="form-control datepicker" value="{{ $member->detail->spouse_dob }}" data-date-format="YYYY-MM-DD">
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="inputBeneficiaryName">@lang('settings.beneficiary.name')</label>
                      <input type="text" name="beneficiary_name" id="inputBeneficiaryName" class="form-control" value="{{ $member->detail->beneficiary_name }}">
                    </div>

                    <div class="form-group">
                      <label class="control-label m-b-10" for="inputBeneficiaryNationality">@lang('settings.beneficiary.nationality')</label>
                      <select id="inputBeneficiaryNationality" class="form-control dd-icon" name="beneficiary_nationality">
                        @foreach ($countries as $country => $value)
                          <option value="{{ $country }}" @if ($member->detail->beneficiary_nationality == $country) selected="" @endif data-imagesrc="{{ asset('assets/img/flags/' . $country . '.png') }}" data-description="{{ \Lang::get('country.selected') }}">@lang('country.' . $country)</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="inputSecret">@lang('settings.secret')</label>
                      <input type="password" name="s" class="form-control" id="inputSecret" required="">
                    </div>

                    <div class="form-group">
                      <div class="alert alert-info">
                        @lang('settings.passwordNotice')
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="inputPassword">@lang('settings.password')</label>
                      <input type="password" name="password" class="form-control" id="inputPassword" minlength="5">
                    </div>

                    <div class="form-group">
                      <label class="control-label">@lang('settings.repassword')</label>
                      <input type="password" class="form-control" data-parsley-equalto="#inputPassword" minlength="5">
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="inputNewSecret">@lang('settings.newSecret')</label>
                      <input type="password" name="secret_password" class="form-control" id="inputNewSecret" minlength="5">
                    </div>

                    <div class="form-group">
                      <label class="control-label">@lang('settings.reNewSecret')</label>
                      <input type="password" class="form-control" data-parsley-equalto="#inputNewSecret" minlength="5">
                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary">
                        <span class="btn-preloader">
                          <i class="md md-cached md-spin"></i>
                        </span>
                        <span>@lang('common.submit')</span>
                      </button>
                      <button type="reset" class="btn btn-default">@lang('common.cancel')</button>
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
