@extends('back.app')

@section('title')
  Edit Announcement | {{ config('app.name') }}
@stop

@section('breadcrumb')
  <ul class="breadcrumb">
    <li><a href="#">Front Page</a></li>
    <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
    <li><a href="{{ route('admin.announcement.list') }}">Announcement List</a></li>
    <li class="active">Edit Announcement</li>
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
              <div class="well white">
                <form role="form" data-url="{{ route('admin.announcement.update', ['id' => $model->id]) }}" data-parsley-validate="" onsubmit="return false;" id="editAnnouncementForm" data-upload="{{ route('admin.image.upload') }}">
                  <fieldset>
                    <div class="form-group">
                      <label class="control-label">English Title</label>
                      <input type="text" class="form-control" name="title_en" required="" value="{{ $model->title_en }}">
                    </div>

                    <div class="form-group">
                      <label class="control-label">English Content</label>
                      <textarea name="content_en" class="form-control" id="editorEN" required="">{!! $model->content_en !!}</textarea>
                    </div>

                    <div class="form-group">
                      <label class="control-label">Chinese Simplified Title</label>
                      <input type="text" class="form-control" name="title_chs" required="" value="{{ $model->title_chs }}">
                    </div>

                    <div class="form-group">
                      <label class="control-label">Chinese Simplified Content</label>
                      <textarea name="content_chs" class="form-control" id="editorCHS" required="">{!! $model->content_chs !!}</textarea>
                    </div>

                    <div class="form-group">
                      <label class="control-label">Chinese Traditional Title</label>
                      <input type="text" class="form-control" name="title_cht" required="" value="{{ $model->title_cht }}">
                    </div>

                    <div class="form-group">
                      <label class="control-label">Chinese Traditional Content</label>
                      <textarea name="content_cht" class="form-control" id="editorCHT" required="">{!! $model->content_cht !!}</textarea>
                    </div>

                    <div class="form-group">
                      <label class="control-label">Date</label>
                      <input type="text" name="created_at" class="form-control" required="" value="{{ $model->created_at }}">
                      <span class="help-block">YYYY-MM-DD HH:mm:ss format</span>
                    </div>

                    <div class="form-group">
                      <button type="button" id="preview" data-url="{{ route('admin.announcement.preview') }}" class="btn btn-warning">
                        <span class="btn-preloader">
                          <i class="md md-cached md-spin"></i>
                        </span>
                        <span>Preview</span>
                      </button>
                      
                      <button type="submit" class="btn btn-primary">
                        <span class="btn-preloader">
                          <i class="md md-cached md-spin"></i>
                        </span>
                        <span>Submit</span>
                      </button>
                      <button type="reset" class="btn btn-default">Cancel</button>
                    </div>
                  </fieldset>
                </form>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </main>
@stop
