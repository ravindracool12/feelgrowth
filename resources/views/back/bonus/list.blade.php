<?php $type = \Input::get('t'); ?>
@extends('back.app')

@section('title')
  All {{ ucwords($type) }} | {{ config('app.name') }}
@stop

@section('breadcrumb')
  <ul class="breadcrumb">
    <li><a href="#">Front Page</a></li>
    <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
    <li class="active">{{ ucwords($type) }}List</li>
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
          <h1><i class="md md-account-balance"></i> Bonus Statement</h1>
          <p class="lead">Your {{ $type }} status.</p>
        </div>

        <div class="card">
          <div class="card-content">
            <div class="datatables">
              <table class="table table-full table-full-small dt-responsive display nowrap table-grid" cellspacing="0" width="100%" role="grid" id="bonusListTable" data-url="{{ route('admin.bonus.getList', ['type' => $type]) }}">
                <thead>
                  <tr>
                    <th data-id="created_at">Created Date</th>
                    <th data-id="username">Username</th>
                    <th data-id="total">Amount</th>
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
@stop
