@extends('front.app')

@section('title')
  @lang('sharesStatement.title') | {{ config('app.name') }}
@stop

@section('breadcrumb')
<ul class="breadcrumb">
  <li><a href="#">@lang('breadcrumbs.front')</a></li>
    <li><a href="{{ route('home', ['lang' => \App::getLocale()]) }}">@lang('breadcrumbs.dashboard')</a></li>
    <li><a href="{{ route('shares.market', ['lang' => \App::getLocale()]) }}">@lang('breadcrumbs.sharesMarket')</a></li>
    <li class="active">@lang('breadcrumbs.sharesStatement')</li>
</ul>
@stop

@section('content')
<main>
  @include('front.include.sidebar')
  <div class="main-container">
    @include('front.include.header')
    <div class="main-content" autoscroll="true" bs-affix-target="" init-ripples="" style="">
      <section class="tables-data">
        <div class="page-header">
          <h1><i class="md md-account-balance"></i> @lang('sharesStatement.title')</h1>
          <p class="lead">@lang('sharesStatement.subTitle')</p>
        </div>

        <div>
          <ul class="nav nav-tabs nav-justified" role="tablist">
            <li role="presentation" class="active"><a href="#sell" aria-controls="sell" role="tab" data-toggle="tab">@lang('sharesStatement.sellList')</a></li>
            <li role="presentation"><a href="#buy" aria-controls="buy" role="tab" data-toggle="tab">@lang('sharesStatement.buyList')</a></li>
            <li role="presentation"><a href="#return" aria-controls="return" role="tab" data-toggle="tab">@lang('sharesStatement.returnList')</a></li>
          </ul>

          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="sell">
              <div class="card">
                <div class="card-content">
                  <div class="datatables">
                    <table class="table table-full table-full-small dt-responsive display nowrap table-grid" cellspacing="0" width="100%" role="grid" data-url="{{ route('shares.sellList', ['lang' => \App::getLocale()]) }}">
                      <thead>
                        <tr>
                          <th data-id="created_at" data-priority="1">@lang('sharesStatement.sellTitle')</th>
                          <th data-id="id">@lang('sharesStatement.id')</th>
                          <th data-id="amount">@lang('sharesStatement.amount')</th>
                          <th data-id="amount_left">@lang('sharesStatement.amountLeft')</th>
                          <th data-id="share_price">@lang('sharesStatement.price')</th>
                          <th data-id="total" data-priority="1">@lang('sharesStatement.total')</th>
                          <th data-id="action" data-priority="1"></th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div role="tabpanel" class="tab-pane" id="buy">
              <div class="card">
                <div class="card-content">
                  <div class="datatables">
                    <table class="table table-full table-full-small dt-responsive display nowrap table-grid" cellspacing="0" width="100%" role="grid" data-url="{{ route('shares.buyList') }}">
                      <thead>
                        <tr>
                          <th data-id="created_at">@lang('sharesStatement.buyTitle')</th>
                          <th data-id="amount">@lang('sharesStatement.amount')</th>
                          <th data-id="share_price">@lang('sharesStatement.price')</th>
                          <th data-id="total">@lang('sharesStatement.total')</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div role="tabpanel" class="tab-pane" id="return">
              <div class="row">
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-content">
                      <div class="datatables">
                        <table class="table table-full table-full-small dt-responsive display nowrap table-grid" cellspacing="0" width="100%" role="grid" data-url="{{ route('shares.returnList', ['lang' => \App::getLocale()]) }}">
                          <thead>
                            <tr>
                              <th data-id="created_at">@lang('sharesStatement.returnTitle')</th>
                              <th data-id="amount">@lang('sharesStatement.amount')</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="card">
                    <div class="card-content">
                      <div class="datatables">
                        <table class="table table-full table-full-small dt-responsive display nowrap table-grid" cellspacing="0" width="100%" role="grid" data-url="{{ route('shares.splitList', ['lang' => \App::getLocale()]) }}">
                          <thead>
                            <tr>
                              <th data-id="created_at">@lang('sharesStatement.splitTitle')</th>
                              <th data-id="amount">@lang('sharesStatement.amount')</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
        <h4 class="modal-title" id="showModalLabel">@lang('sharesStatement.sellModalTitle')</h4>
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

        <div id="modalContent">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-raised" data-dismiss="modal">@lang('common.close')</button>
      </div>
    </div>
  </div>
</div>
@stop
