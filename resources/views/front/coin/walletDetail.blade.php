@extends('front.app')

@section('title')
  @lang('coin.wallet.detail.title') | {{ config('app.name') }}
@stop

@section('breadcrumb')
  <ul class="breadcrumb">
    <li><a href="{{ route('coin.list', ['lang' => \App::getLocale()]) }}">@lang('coin.wallet.detail.list')</a></li>
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
            <h1>@lang('coin.wallet.detail.pageTitle') {{ $model->wallet_name }} ({{ strtoupper($model->coin_type) }})</h1>
            <p class="lead">@lang('coin.wallet.detail.dateTitle') {{ $model->created_at->format('d F Y H:i:s') }}</p>
          </div>

          <?php $addresses = $model->addresses; ?>
          <div class="row m-b-40">
            <div class="col-md-12">
              <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered" id="addressTableList">
                  <thead>
                    <tr>
                      <th>@lang('coin.wallet.detail.table.address')</th>
                      <th>@lang('coin.wallet.detail.table.private')</th>
                      <th>@lang('coin.wallet.detail.table.date')</th>
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
                            <button class="btn btn-primary btn-show" data-url="{{ route('coin.address.detail', ['id' => $address->id, 'lang' => \App::getLocale()]) }}" data-toggle="modal" data-target="#showModal">
                              <i class="md md-visibility"></i> @lang('coin.wallet.detail.table.check')
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
          <h4 class="modal-title" id="showModalLabel">@lang('coin.wallet.modal.address.title')</h4>
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
