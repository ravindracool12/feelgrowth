@extends('back.app')

@section('title')
All Transaction | {{ config('app.name') }}
@stop

@section('content')
<main>
  @include('back.include.sidebar')
  <div class="main-container">
    @include('back.include.header')
    <div class="main-content" autoscroll="true" bs-affix-target="" init-ripples="" style="">
      <section>
        <div class="page-header">
          <h1><i class="md md-album"></i> Coin Transaction</h1>
          <p class="lead">All transactions</p>
        </div>

        <div class="row m-b-40">
          <div class="col-md-12">
            <section class="tables-data">
              <div class="card">
                <div class="card-content">
                  <div class="datatables">
                    <table class="table table-full table-full-small dt-responsive display nowrap table-grid" id="transactionTableList" cellspacing="0" width="100%" role="grid" data-url="{{ route('admin.coin.transaction.list') }}">
                      <thead>
                        <tr>
                          <th data-id="created_at">Created At</th>
                          <th data-id="amount">Amount</th>
                          <th data-id="is_admin">Type</th>
                          <th data-id="from_address" data-sortable="false">From</th>
                          <th data-id="to_address" data-sortable="false">To</th>
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
        <h4 class="modal-title" id="showModalLabel">Transaction Detail</h4>
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
