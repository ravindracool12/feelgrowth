@extends('front.app')

@section('title')
@lang('coin.wallet.title') | {{ config('app.name') }}
@stop

@section('breadcrumb')
<ul class="breadcrumb">
  <li><a href="#">@lang('breadcrumbs.front')</a></li>
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
          <h1><i class="md md-album"></i> @lang('coin.wallet.title')</h1>
          <p class="lead">@lang('coin.wallet.sub')</p>
        </div>

        <div class="row m-b-40">
          <div class="col-md-4">
            <div class="well white">
              <h3>@lang('coin.wallet.createNew')</h3>
              <form class="floating-label action-form" http-type="put" data-parsley-validate="" role="form"" data-url="{{ route('coin.wallet.create', ['lang' => \App::getLocale()]) }}">
                <fieldset>
                  <div class="form-group">
                    <label class="control-label" for="inputName">@lang('coin.wallet.createNew.name')</label>
                    <input type="text" name="wallet_name" class="form-control" required="" id="inputName">
                  </div>

                  <div class="form-group">
                    <label class="control-label" for="inputS">@lang('register.spassword')</label>
                    <input type="password" name="s" class="form-control" required="" id="inputS">
                  </div>

                  <div class="form-group">
                    <label class="control-label" for="inputCoin">@lang('coin.wallet.createNew.type')</label>
                    <select class="form-control" name="coin_type">
                      <option value="btc">@lang('coin.wallet.createNew.btc')</option>
                      <option value="eth">@lang('coin.wallet.createNew.eth')</option>
                      <option value="ltc">@lang('coin.wallet.createNew.lite')</option>
                      <option value="doge">@lang('coin.wallet.createNew.doge')</option>
                      <option value="bcy">TestCoin</option>
                    </select>
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
          
          <div class="col-md-8">
            <section class="tables-data">
              <div class="card">
                <div class="card-content">
                  <div class="datatables">
                    <table class="table table-full table-full-small dt-responsive display nowrap table-grid" id="walletTableList" cellspacing="0" width="100%" role="grid" data-url="{{ route('coin.wallet.list', ['lang' => \App::getLocale()]) }}" data-address-url="{{ route('coin.address.create', ['lang' => \App::getLocale()]) }}">
                      <thead>
                        <tr>
                          <th data-id="created_at">@lang('coin.wallet.table.date')</th>
                          <th data-id="wallet_name">@lang('coin.wallet.table.name')</th>
                          <th data-id="coin_type">@lang('coin.wallet.table.type')</th>
                          <th data-id="action" data-searchable="false"></th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
      </section>
    </div>
  </div>
</main>
@stop
