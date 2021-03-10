@extends('back.app')

@section('title')
  All Withdraws | {{ config('app.name') }}
@stop

@section('breadcrumb')
  <ul class="breadcrumb">
    <li><a href="#">Front Page</a></li>
    <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
    <li class="active">Withdraw List</li>
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
          <h1><i class="md md-account-balance"></i> Withdraw Statement</h1>
          <p class="lead">Withdraw status.</p>
        </div>

        <div class="card">
          <div class="card-content">
            <div class="datatables">
              <table class="table table-full table-full-small dt-responsive display nowrap table-grid" cellspacing="0" width="100%" role="grid" id="withdrawListTable" data-url="{{ route('admin.withdraw.getList') }}">
                <thead>
                  <tr>
                    <th data-id="created_at">Created Date</th>
                    <th data-id="username">Username</th>
                    <th data-id="amount">Amount</th>
                    <th data-id="admin">Admin Fee</th>
                    <th data-id="status">Status</th>
                    <th data-id="action">Action</th>
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

  <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="showModalLabel">Withdraw Detail</h4>
        </div>
        <div class="modal-body">
          <div class="loading text-center">
            <img src="{{ asset('assets/img/loading.gif') }}" alt="Network Loading">
            <br>
            <small class="text-primary">loading..</small>
          </div>

          <div class="error text-center">
            <i class="md md-error"></i>
            <br>
            <small class="text-danger">Something went wrong</small>
          </div>

          <div id="modalContent">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-raised" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@stop
