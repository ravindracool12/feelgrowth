<?php 
  $lang = \App::getLocale();
  $title = null;
  $content = null;
  $announcementModel = new \App\Models\Announcement;

  if (isset($model->{"title_$lang"})) $title = $model->{"title_$lang"};
  else $title = $model->title_en;
  if (isset($model->{"content_$lang"})) $content = $model->{"content_$lang"};
  else $content = $model->content_en;
?>

@extends('front.app')

@section('title')
  {{ $title }} | {{ config('app.name') }}
@stop

@section('breadcrumb')
  <ul class="breadcrumb">
    <li><a href="#">@lang('breadcrumbs.front')</a></li>
    <li><a href="{{ route('home', ['lang' => $lang]) }}">@lang('breadcrumbs.dashboard')</a></li>
    <li><a href="{{ route('announcement.list', ['lang' => $lang]) }}">@lang('breadcrumbs.announcementList')</a></li>
    <li class="active">{{ $title }}</li>
  </ul>
@stop

@section('content')
  <main>
    @include('front.include.sidebar')
    <div class="main-container">
      @include('front.include.header')
      <div class="main-content" autoscroll="true" bs-affix-target="" init-ripples="" style="">
        <section>
          <div class="page-header">
            <h1><i class="md md-new-releases"></i> {{ $title }}</h1>
          </div>

          <div class="row m-b-40">
            <?php $before = $announcementModel->where('id', '<', $model->id)->orderBy('id','desc')->first(); ?>
            @if ($before)
            <?php
              if (isset($before->{"title_$lang"})) $beforeTitle = $before->{"title_$lang"};
              else $beforeTitle = $before->title_en;
            ?>
            <div class="col-md-2">
              <a href="{{ route('announcement.read', ['lang' => $lang, 'id' => $before->id]) }}">
                <i class="md md-arrow-back"></i> {{ $beforeTitle }}
              </a>
            </div>
            @endif

            <div class="col-md-8">
              <div class="well white clearfix">
                <p class="theme-text pull-right"><i class="md md-alarm"></i> {{ $model->created_at->format('d F Y H:i A') }}</p>
                <div class="pull-left" style="width: 100%;">
                  {!! $content !!}
                </div>
              </div>
            </div>

            <?php $after = $announcementModel->where('id', '>', $model->id)->orderBy('id','asc')->first(); ?>
            @if ($after)
            <?php
              if (isset($after->{"title_$lang"})) $afterTitle = $after->{"title_$lang"};
              else $afterTitle = $after->title_en;
            ?>
            <div class="col-md-2">
              <a href="{{ route('announcement.read', ['lang' => $lang, 'id' => $after->id]) }}">
                <i class="md md-arrow-forward"></i> {{ $afterTitle }}
              </a>
            </div>
            @endif
          </div>
        </section>
      </div>
    </div>
  </main>
@stop
