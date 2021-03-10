<?php
  use Carbon\Carbon;
  use App\Services\BlockCypher;
  $service = new BlockCypher;
  $completed = $data['detail']->confirmations >= 6 ? true : false;
?>
<div class="table-responsive">
  <table class="table table-striped table-hover table-bordered">
    <thead>
      <tr class="small">
        <th>AMOUNT TRANSACTED</th>
        <th>FEES</th>
        <th>RECEIVED</th>
        <th>CONFIRMATIONS <span class="md md-info theme-text" data-toggle="popover" title="{{ $data['detail']->confirmations }} confirmations" data-content="Anything over 6 confirmations is considered completed and irreversible."></span></th>
      </tr>
    </thead>

    <tbody>
      <?php $recTime = Carbon::parse($data['detail']->received); ?>
      <tr>
        <td class="bold theme-text">{{ $service->convertToBTC($data['detail']->total) }} {{ strtoupper($data['model']->coin_type) }}</td>
        <td class="bold theme-text">{{ $service->convertToBTC($data['detail']->fees) }} {{ strtoupper($data['model']->coin_type) }}</td>
        <td class="bold theme-text"><span class="md md-alarm"></span> {{ $recTime->diffForHumans() }}</td>
        <td class="bold" @if ($completed) style="color:green;" @else style="color:#A8184F;" @endif>
          @if ($completed)
          <span class="md md-lock"></span>
          @else
          <span class="md md-lock-open"></span>
          @endif {{ $data['detail']->confirmations }}/6</td>
      </tr>
    </tbody>
  </table>
</div>

<div class="table-responsive">
  <table class="table table-striped table-hover">
    <tbody>
      <tr>
        <td>Miner Preference</td>
        <td>:</td>
        <td class="bold">{{ strtoupper($data['detail']->preference) }}</td>
      </tr>

      <tr>
        <td>Block Hash</td>
        <td>:</td>
        <td>{{ $data['detail']->block_hash }}</td>
      </tr>

      <tr>
        <td>Block Height</td>
        <td>:</td>
        <td>{{ number_format($data['detail']->block_height, 0) }}</td>
      </tr>

      <tr>
        <td>Size</td>
        <td>:</td>
        <td>{{ $data['detail']->size }} bytes</td>
      </tr>

      <tr>
        <td>Relayed By</td>
        <td>:</td>
        <td>{{ $data['detail']->relayed_by }}</td>
      </tr>
    </tbody>
  </table>
</div>

<div class="row">
  <div class="col-md-6">
    <ul class="list-group">
      <li class="list-group-item active"><span class="bold">{{ count($data['detail']->inputs) }}</span> inputs consumed.</li>
      @if (count($data['detail']->inputs > 0))
      @foreach ($data['detail']->inputs as $input)
        <li class="list-group-item">
          {{ $service->convertToBTC($input->output_value) . ' ' . strtoupper($data['model']->coin_type) }} from:
          <ul class="list-unstyled">
            @if (count($input->addresses) > 0)
            @foreach ($input->addresses as $address)
              <li class="theme-text">{{ $address }}</li>
            @endforeach
            @endif
          </ul>
        </li>
      @endforeach
      @endif
    </ul>
  </div>

  <div class="col-md-6">
    <ul class="list-group">
      <li class="list-group-item active"><span class="bold">{{ count($data['detail']->outputs) }}</span> outputs created.</li>
      @if (count($data['detail']->outputs > 0))
      @foreach ($data['detail']->outputs as $output)
        <li class="list-group-item">
          {{ $service->convertToBTC($output->value) . ' ' . strtoupper($data['model']->coin_type)  }} to:
          <ul class="list-unstyled">
            @if (count($output->addresses) > 0)
            @foreach ($output->addresses as $address)
              <li class="theme-text">{{ $address }}</li>
            @endforeach
            @endif
          </ul>
        </li>
      @endforeach
      @endif
    </ul>
  </div>
</div>

<script type="text/javascript">$('[data-toggle="popover"]').popover();</script>
