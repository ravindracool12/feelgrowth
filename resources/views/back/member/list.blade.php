@extends('back.app')

@section('title')
  Member List | {{ config('app.name') }}
@stop

@section('breadcrumb')
  <ul class="breadcrumb">
    <li><a href="#">Front Page</a></li>
    <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
    <li class="active">Member List</li>
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
            <h1><i class="md md-group-add"></i> Member List</h1>
          </div>

          <div class="card">
            <div>
              <div class="datatables">
                <table class="table table-full table-full-small dt-responsive display nowrap table-grid" cellspacing="0" width="100%" role="grid" data-url="{{ route('admin.member.getList') }}">
                  <thead>
                    <tr>
                      <th data-id="created_at">Join Date</th>
                      <th data-id="username">Username</th>
                      <th data-id="package_amount">Package</th>
                      <th data-id="direct" data-orderable="false" data-searchable="false">Direct ID</tg>
                      <th data-id="register_by">Registered By</th>
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
