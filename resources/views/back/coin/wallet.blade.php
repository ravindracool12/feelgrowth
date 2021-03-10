@extends('back.app')

@section('title')
Member Coin Wallet | {{ config('app.name') }}
@stop

@section('breadcrumb')
<ul class="breadcrumb">
  <li><a href="#">@lang('breadcrumbs.front')</a></li>
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
          <h1><i class="md md-album"></i> Member Wallet</h1>
          <p class="lead">All member Coin Wallets</p>
        </div>

        <div class="row m-b-40">
          <div class="col-md-12">
            <section class="tables-data">
              <div class="card">
                <div class="card-content">
                  <div class="datatables">
                    <table class="table table-full table-full-small dt-responsive display nowrap table-grid" cellspacing="0" width="100%" role="grid" data-url="{{ route('admin.coin.wallet.list') }}">
                      <thead>
                        <tr>
                          <th data-id="created_at">Created At</th>
                          <td data-id="username">Username</td>
                          <th data-id="wallet_name">Wallet Name</th>
                          <th data-id="coin_type">Coin Type</th>
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
