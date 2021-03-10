@extends('back.app')

@section('title')
  Wallet Statement List | {{ config('app.name') }}
@stop

@section('breadcrumb')
  <ul class="breadcrumb">
    <li><a href="#">Front Page</a></li>
    <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
    <li class="active">Wallet Statement List</li>
  </ul>
@stop

@section('content')
  <main>
    @include('back.include.sidebar')
    <div class="main-container">
      @include('back.include.header')
      <div class="main-content" autoscroll="true" bs-affix-target="" init-ripples="" style="">
        <section class="tables-data">
          <?php $member = \DB::table('Member')->where('id', trim($id))->first(); ?>
          <div class="page-header">
            @if ($member)
            <h1><i class="md md-compare"></i> Wallet Statement of {{ $member->username }}</h1>
            @endif
          </div>

          <div class="card">
            <div>
              <div class="datatables">
                <table class="table table-full table-full-small dt-responsive display nowrap table-grid" cellspacing="0" width="100%" role="grid" data-url="{{ route('admin.wallet.statement.getList', ['id' => $id]) }}">
                  <thead>
                    <tr>
                      <th data-id="created_at">Date</th>
                      <th data-id="username">Username</th>
                      <th data-id="register_amount">Register</th>
                      <th data-id="promotion_amount">Promotion</th>
                      <th data-id="type">Type</th>
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
