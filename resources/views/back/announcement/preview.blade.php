@extends('back.app')

@section('title')
  Edit Announcement | {{ config('app.name') }}
@stop

@section('breadcrumb')
  <ul class="breadcrumb">
    <li><a href="#">Front Page</a></li>
    <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
    <li><a href="{{ route('admin.announcement.list') }}">Announcement List</a></li>
    <li class="active">Announcement Preview</li>
  </ul>
@stop

@section('content')
  <main>
    @include('back.include.sidebar')
    <div class="main-container">
      @include('back.include.header')
      <div class="main-content" autoscroll="true" bs-affix-target="" init-ripples="" style="">
        <section>
          <div class="row m-b-10">
            <div class="col-md-8">
              <div class="well white clearfix">
                <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class="active"><a href="#enPreview" aria-controls="home" role="tab" data-toggle="tab">English</a></li>
                  <li role="presentation"><a href="#chsPreview" aria-controls="profile" role="tab" data-toggle="tab">Chinese Simplified</a></li>
                  <li role="presentation"><a href="#chtPreview" aria-controls="messages" role="tab" data-toggle="tab">Chinese Traditional</a></li>
                </ul>

                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane active" id="enPreview">
                    <h1>{{ $data['title_en'] }}</h1>
                    {!! $data['content_en'] !!}
                  </div>
                  <div role="tabpanel" class="tab-pane" id="chsPreview">
                    <h1>{{ $data['title_chs'] }}</h1>
                    {!! $data['content_chs'] !!}
                  </div>
                  <div role="tabpanel" class="tab-pane" id="chtPreview">
                    <h1>{{ $data['title_cht'] }}</h1>
                    {!! $data['content_cht'] !!}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </main>
@stop
