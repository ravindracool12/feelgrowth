@extends('back.app')

@section('title')
  Add Bonus Statement | {{ config('app.name') }}
@stop

@section('breadcrumb')
<ul class="breadcrumb">
  <li><a href="#">Front Page</a></li>
  <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
  <li class="active">Add Bonus Statement</li>
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
            <h1><i class="md md-attach-money"></i> Add Bonus Statement</h1>
          </div>

          <div class="row m-b-40">
            <div class="col-md-6">
              <div class="alert alert-danger">
                Remember to UPDATE member wallet.
              </div>
              <div class="panel panel-default">
                <div class="panel-body">
                  <form role="form" onsubmit="return false;" data-parsley-validate class="action-form shares-form" id="bonusStatementForm" http-type="post" data-url="{{ route('admin.bonus.add') }}">
                    <fieldset>
                      <div class="form-group">
                        <label class="control-label">Member ID</label>
                        <input type="text" name="username" required="" class="form-control">
                      </div>

                      <div class="form-group">
                        <label class="control-label">Type</label>
                        <select class="form-control" name="type" required="">
                          <option value="direct">Direct</option>
                          <option value="override">Override</option>
                          <option value="group">Group</option>
                          <option value="pairing">Pairing</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label class="control-label">Cash</label>
                        <input type="number" step="any" class="form-control" name="cash" required="" value="0">
                        <span class="help-block">use dots(.) for decimals</span>
                      </div>

                      <div class="form-group">
                        <label class="control-label">Promotion</label>
                        <input type="number" step="any" class="form-control" name="promotion" required="" value="0">
                        <span class="help-block">use dots(.) for decimals</span>
                      </div>

                      <div class="form-group">
                        <label class="control-label">Total</label>
                        <input type="number" step="any" class="form-control" name="total" required="">
                        <span class="help-block">use dots(.) for decimals</span>
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
          </div>
        </section>
      </div>
    </div>
  </main>
@stop
