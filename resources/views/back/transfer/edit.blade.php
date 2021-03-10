@extends('back.app')

@section('title')
  Transfer #{{ $model->id }} | {{ config('app.name') }}
@stop

@section('breadcrumb')
  <ul class="breadcrumb">
    <li><a href="#">Front Page</a></li>
    <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
    <li><a href="{{ route('admin.transfer.all') }}">Transfer List</a></li>
    <li class="active">Edit Transfer #{{ $model->id }}</li>
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
                <div class="alert alert-danger">
                  Please EDIT carefully, cannot be rolled back.
                </div>

                <form role="form" class="action-form" data-url="{{ route('admin.transfer.update', ['id' => $model->id]) }}" http-type="post" onsubmit="return false;">
                  <fieldset>
                    <div class="form-group">
                      <label class="control-label">From User ID</label>
                      <input type="text" class="form-control" value="{{ $model->from_username }}" disabled="" readonly="">
                    </div>

                    <div class="form-group">
                      <label class="control-label">To User ID</label>
                      <input type="text" class="form-control" value="{{ $model->to_username }}" disabled="" readonly="">
                    </div>

                    <div class="form-group">
                      <label class="control-label">Type</label>
                      <select class="form-control" name="type" required="">
                        <option value="cash" @if ($model->type == 'cash') selected="" @endif>Cash Point</option>
                        <option value="promotion" @if ($model->type == 'promotion') selected="" @endif>Promotion Point</option>
                        <option value="register" @if ($model->type == 'register') selected="" @endif>Register Point</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label class="control-label">Amount</label>
                      <input type="number" step="any" class="form-control" value="{{ (float) $model->amount }}" required="" name="amount">
                    </div>

                    <div class="form-group">
                      <label class="control-label">Date Created</label>
                      <input type="text" class="form-control" value="{{ $model->created_at }}" required="" name="created_at">
                      <span class="help-block">YYYY-MM-DD HH:MM:SS format</span>
                    </div>

                    <div class="form-group">
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
