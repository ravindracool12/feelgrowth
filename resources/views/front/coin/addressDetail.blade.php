<?php
  use App\Services\BlockCypher;
  $service = new BlockCypher;
  $info = json_decode($data['model']->info);
?>

<table class="table table-striped table-hover table-bordered">
  <tr>
    <td class="theme-text bold">@lang('coin.detail.address.address')</td>
    <td>:</td>
    <td class="bold">{{ $info->address }}</td>
  </tr>

  @if (isset($data['detail']->balance))
  <tr>
    <td>@lang('coin.detail.address.balance')</td>
    <td>:</td>
    <td>{{ $service->convertToBTC($data['detail']->balance) }} {{ strtoupper($data['wallet']->coin_type) }}</td>
  </tr>
  @endif

  @if (isset($data['detail']->unconfirmed_balance))
  <tr>
    <td>@lang('coin.detail.address.ubalance')</td>
    <td>:</td>
    <td>{{ $service->convertToBTC($data['detail']->unconfirmed_balance) }} {{ strtoupper($data['wallet']->coin_type) }}</td>
  </tr>
  @endif

  @if (isset($data['detail']->final_balance))
  <tr>
    <td>@lang('coin.detail.address.fbalance')</td>
    <td>:</td>
    <td class="theme-text bold">{{ $service->convertToBTC($data['detail']->final_balance) }} {{ strtoupper($data['wallet']->coin_type) }}</td>
  </tr>
  @endif

  @if (isset($data['detail']->total_sent))
  <tr>
    <td>@lang('coin.detail.address.totalSent')</td>
    <td>:</td>
    <td>{{ $service->convertToBTC($data['detail']->total_sent) }} {{ strtoupper($data['wallet']->coin_type) }}</td>
  </tr>
  @endif

  @if (isset($data['detail']->total_received))
  <tr>
    <td>@lang('coin.detail.address.totalReceived')</td>
    <td>:</td>
    <td>{{ $service->convertToBTC($data['detail']->total_received) }} {{ strtoupper($data['wallet']->coin_type) }}</td>
  </tr>
  @endif

  @if (isset($data['detail']->n_tx))
  <tr>
    <td>@lang('coin.detail.address.ntx')</td>
    <td>:</td>
    <td>{{ $data['detail']->n_tx }}</td>
  </tr>
  @endif

  @if (isset($data['detail']->unconfirmed_n_tx))
  <tr>
    <td>@lang('coin.detail.address.untx')</td>
    <td>:</td>
    <td>{{ $data['detail']->unconfirmed_n_tx }}</td>
  </tr>
  @endif

  @if (isset($data['detail']->final_n_tx))
  <tr>
    <td>@lang('coin.detail.address.tntx')</td>
    <td>:</td>
    <td class="theme-text bold">{{ $data['detail']->final_n_tx }}</td>
  </tr>
  @endif
</table>