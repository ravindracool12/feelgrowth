@extends('back.app')

@section('title')
  Freeze Shares List | {{ config('app.name') }}
@stop

@section('breadcrumb')
  <ul class="breadcrumb">
    <li><a href="#">Front Page</a></li>
    <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
    <li class="active">Freeze Shares List</li>
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
            <h1><i class="md md-lock"></i> Freeze Shares List</h1>
          </div>

          <div class="card">
            <div>
              <div class="datatables">
                <table class="table table-full table-full-small dt-responsive display nowrap table-grid" cellspacing="0" width="100%" id="sharesFreezeListTable" role="grid" data-url="{{ route('admin.shares.lockList') }}">
                  <thead>
                    <tr>
                      <th data-id="created_at">Created Date</th>
                      <th data-id="active_date">Active At</th>
                      <th data-id="member.username" data-name="member.username">Username</th>
                      <th data-id="amount">Shares Amount</th>
                      <th data-id="has_process">Has Process?</th>
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
