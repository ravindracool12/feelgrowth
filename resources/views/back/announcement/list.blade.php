@extends('back.app')

@section('title')
  All Announcent | {{ config('app.name') }}
@stop

@section('breadcrumb')
  <ul class="breadcrumb">
    <li><a href="#">Front Page</a></li>
    <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
    <li class="active">Announcement List</li>
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
          <h1><i class="md md-new-releases"></i> Annoucement Statement</h1>
        </div>

        <div class="card">
          <div class="card-content">
            <div class="datatables">
              <table class="table table-full table-full-small dt-responsive display nowrap table-grid" cellspacing="0" width="100%" role="grid" id="announcementListTable" data-url="{{ route('admin.announcement.getList') }}">
                <thead>
                  <tr>
                    <th data-id="created_at">Created Date</th>
                    <th data-id="title_en">Title</th>
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
