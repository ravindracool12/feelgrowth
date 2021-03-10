@extends('back.app')

@section('title')
@stop

@section('breadcrumb')
  <ul class="breadcrumb">
    <li><a href="#">Front Page</a></li>
    <li class="active">Dashboard</li>
  </ul>
@stop

@section('content')
  <main>
    @include('back.include.sidebar')
    <div class="main-container">
      @include('back.include.header')
      <div class="main-content" autoscroll="true" bs-affix-target="" init-ripples="" style="">
        <section>
          <div class="page-header">
            <h1><i class="md md-settings"></i> Account Settings</h1>
          </div>

          <div class="row m-b-40">
            <div class="col-md-6">
              <div class="well white">
                <form data-parsley-validate="" role="form" class="form-floating action-form" id="accountBasicForm" http-type="post" data-url="{{ route('admin.account.postUpdate') }}">
                  <fieldset>
                    <div class="form-group">
                      <div class="alert alert-info">
                        Empty password fields below if you do not want to change password.
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label" id="inputPassword">Account Password</label>
                      <input type="password" name="password" class="form-control" id="inputPassword">
                    </div>

                    <div class="form-group">
                      <label class="control-label">Re Password</label>
                      <input type="password" class="form-control" data-parsley-equalto="#inputPassword">
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
