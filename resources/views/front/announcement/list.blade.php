<?php 
  $lang = \App::getLocale();
?>

@extends('front.app')

@section('title')
  @lang('announcement.title') | {{ config('app.name') }}
@stop

@section('breadcrumb')
  <ul class="breadcrumb">
    <li><a href="#">@lang('breadcrumbs.front')</a></li>
    <li><a href="{{ route('home', ['lang' => \App::getLocale()]) }}">@lang('breadcrumbs.dashboard')</a></li>
    <li class="active">@lang('breadcrumbs.announcementList')</li>
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
          <h1><i class="md md-new-releases"></i> @lang('announcement.title')</h1>
        </div>

        <div class="card">
          <div class="card-content">
            <div class="datatables">
              <table class="table table-full table-full-small dt-responsive display nowrap table-grid" cellspacing="0" width="100%" role="grid" id="announcementListTable" data-url="{{ route('announcement.getList', ['lang' => \App::getLocale()]) }}">
                <thead>
                  <tr>
                    <th data-id="created_at">@lang('announcement.listDate')</th>
                    <th data-id="title_{{ $lang }}">@lang('announcement.listTitle')</th>
                    <th data-id="action">@lang('announcement.listAction')</th>
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
