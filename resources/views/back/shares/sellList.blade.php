@extends('back.app')

@section('title')
  Sell Shares List | {{ config('app.name') }}
@stop

@section('breadcrumb')
  <ul class="breadcrumb">
    <li><a href="#">Front Page</a></li>
    <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
    <li class="active">Sell Shares List</li>
  </ul>
@stop

@section('content')
  <main>
    @include('back.include.sidebar')
    <div class="main-container">
      @include('back.include.header')
      <div class="main-content" autoscroll="true" bs-affix-target="" init-ripples="" style="">
        <section class="tables-data">
          <div class="page-header">
            <h1><i class="md md-lock"></i> Sell Shares List</h1>
          </div>

          <div class="card">
            <div>
              <div class="datatables">
                <table class="table table-full table-full-small dt-responsive display nowrap table-grid" cellspacing="0" width="100%" id="sharesSellListTable" role="grid" data-url="{{ route('admin.shares.sellList') }}">
                  <thead>
                    <tr>
                      <th data-id="created_at">Created Date</th>
                      <th data-id="member.username" data-name="member.username">Username</th>
                      <th data-id="amount">Amount</th>
                      <th data-id="amount_left">Left</th>
                      <th data-id="share_price">Shares Price</th>
                      <th data-id="total">Total</th>
                      <th data-id="action" data-orderable="false" data-searchable="false">
                        Action
                      </th>
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
  </main>
@stop
