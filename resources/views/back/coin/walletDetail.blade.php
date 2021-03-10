@extends('back.app')

@section('title')
  Wallet Detail | {{ config('app.name') }}
@stop

@section('breadcrumb')
  <ul class="breadcrumb">
    <li><a href="{{ route('admin.coin.list') }}">Wallet List</a></li>
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
            <h1>Wallet: {{ $model->wallet_name }} ({{ strtoupper($model->coin_type) }})</h1>
            <p class="lead">Owner: <span class="theme-text">{{ $model->username }}</span></p>
            <p class="lead">Created on: {{ $model->created_at->format('d F Y H:i:s') }}</p>
          </div>

          <?php $addresses = $model->addresses; ?>
          <div class="row m-b-40">
            <div class="col-md-12">
              <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered" id="addressTableList">
                  <thead>
                    <tr>
                      <th>Address</th>
                      <th>Private Key</th>
                      <th>Created Date</th>
                      <th></th>
                    </tr>
                  </thead>

                  <tbody>
                    @if (count($addresses) > 0)
                      @foreach ($addresses as $address)
                        <?php $info = json_decode($address->info); ?>
                        <tr>
                          <td>{{ $info->address }}</td>
                          <td>{{ $info->private }}</td>
                          <td>{{ $address->created_at->format('d F Y H:i:s') }}</td>
                          <td>
                            <button class="btn btn-primary btn-show" data-url="{{ route('admin.coin.address.detail', ['id' => $address->id]) }}" data-toggle="modal" data-target="#showModal">
                              <i class="md md-visibility"></i> Check Funds
                            </button>
                          </td>
                        </tr>
                      @endforeach
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </main>

  <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="showModalLabel">Address Detail</h4>
        </div>
        <div class="modal-body">
          <div class="loading text-center">
            <img src="{{ asset('assets/img/loading.gif') }}" alt="Network Loading">
            <br>
            <small class="text-primary">@lang('common.modal.load')</small>
          </div>

          <div class="error text-center">
            <i class="md md-error"></i>
            <br>
            <small class="text-danger">@lang('common.modal.error')</small>
          </div>

          <div id="modalContent"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-raised" data-dismiss="modal">@lang('common.close')</button>
        </div>
      </div>
    </div>
  </div>
@stop
