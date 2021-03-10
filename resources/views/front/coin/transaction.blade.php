<?php $coinWallets = $member->coinWallet()->get(); ?>
@extends('front.app')

@section('title')
@lang('coin.tx.title') | {{ config('app.name') }}
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
          <h1><i class="md md-album"></i> @lang('coin.tx.title')</h1>
          <p class="lead">@lang('coin.tx.sub')</p>
        </div>

        <div class="row m-b-40">
          <div class="col-md-4">
            <div class="well white">
              <h3>@lang('coin.tx.createNew')</h3>
              <form class="action-form" http-type="put" data-parsley-validate="" role="form" id="coinTxCreateForm" data-url="{{ route('coin.transaction.create', ['lang' => \App::getLocale()]) }}">
                <fieldset>
                  <div class="form-group">
                    <label class="control-label" for="inputFrom">@lang('coin.tx.createNew.from')</label>
                    <select class="form-control" name="from_address" id="inputFrom">
                      @if (count($coinWallets) > 0)
                      @foreach ($coinWallets as $wallet)
                      <optgroup label="{{ $wallet->wallet_name }}">
                        <?php $coinAddresses = $wallet->addresses()->get(); ?>
                        @if (count($coinAddresses) > 0)
                        @foreach ($coinAddresses as $address)
                        <?php $addressInfo = json_decode($address->info); ?>
                        <option value="{{ $address->id }}">{{ '(' . strtoupper($wallet->coin_type) . ') ' . $addressInfo->address }}</option>
                        @endforeach
                        @endif
                      </optgroup>
                      @endforeach
                      @endif
                    </select>
                  </div>

                  <div class="form-group">
                    <label class="control-label" for="inputTo">@lang('coin.tx.createNew.to')</label>
                    <input type="text" class="form-control" name="to_address" required="" id="inputTo">
                  </div>

                  <div class="form-group">
                    <label class="control-label" for="inputAmount">@lang('coin.tx.createNew.amount')</label>
                    <input type="number" class="form-control" step="any" name="amount" value="0" min="0" required="" id="inputAmount">
                    <span class="help-block">@lang('coin.tx.createNew.help')</span>
                  </div>

                  <div class="form-group">
                    <label class="control-label" for="totalLabel">@lang('coin.tx.createNew.total')</label>
                    <h3 class="theme-text" style="margin-top:0;" id="totalLabel">0</h3>
                  </div>

                  <div class="form-group">
                    <label class="control-label" for="inputS">@lang('register.spassword')</label>
                    <input type="password" name="s" class="form-control" required="" id="inputS">
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
                    <table class="table table-full table-full-small dt-responsive display nowrap table-grid" id="transactionTableList" cellspacing="0" width="100%" role="grid" data-url="{{ route('coin.transaction.list', ['lang' => \App::getLocale()]) }}">
                      <thead>
                        <tr>
                          <th data-id="created_at">@lang('coin.tx.table.date')</th>
                          <th data-id="amount">@lang('coin.tx.table.amount')</th>
                          <th data-id="from_address" data-sortable="false">@lang('coin.tx.table.from')</th>
                          <th data-id="to_address" data-sortable="false">@lang('coin.tx.table.to')</th>
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

<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" style="z-index:99999;">
  <div class="modal-dialog" role="document" style="width:80%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="showModalLabel">@lang('coin.tx.modal.title')</h4>
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
