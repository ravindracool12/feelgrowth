<?php
  use Carbon\Carbon;
  $sales = \DB::table('Shares_Sell')->where('id', trim($id))->first();
  $statements = \DB::table('Shares_Sell_Statement')->where('sell_id', trim($id))->get();
?>

@if (count($statements) > 0)
  <div class="table-responsive">
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th colspan="4">@lang('sharesStatement.modalHeader') #{{ $id }}</th>
        </tr>
        <tr>
          <th class="theme-text">@lang('sharesStatement.modal.createdDate')</th>
          <th class="theme-text">@lang('sharesStatement.cash')</th>
          <th class="theme-text">@lang('sharesStatement.purchase')</th>
          <th class="theme-text">@lang('sharesStatement.md')</th>
          <th class="theme-text">@lang('sharesStatement.fee')</th>
          <th class="theme-text">@lang('sharesStatement.modal.quantity')</th>
          <th class="theme-text">@lang('sharesStatement.modal.price')</th>
          <th class="theme-text">@lang('sharesStatement.modal.status')</th>
        </tr>
      </thead>

      <tbody>
        @foreach ($statements as $statement)
          <tr>
            <td>{{ Carbon::createFromFormat('Y-m-d H:i:s', $statement->created_at)->format('Y-m-d') }}</td>
            <td>{{ number_format($statement->cash_point, 2) }}</td>
            <td>{{ number_format($statement->purchase_point,2) }}</td>
            <td>{{ number_format($statement->md_point, 2) }}</td>
            <td>{{ number_format($statement->admin_fee, 2) }}</td>
            <td>{{ number_format($statement->amount, 0) }}</td>
            <td>{{ number_format($statement->share_price, 3) }}</td>
            <td>
              @if ($statement->status == 'sold')
                <span style="color:#f00;">@lang('sharesStatement.modal.statement.sold')</span>
              @elseif ($statement->status == 'return')
                <span style="color:green;">@lang('sharesStatement.modal.statement.return')</span>
              @endif
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@else
<div class="alert alert-info">
  <i class="md md-warning"></i> @lang('sharesStatement.noStatement')
</div>
@endif

<hr>

@if ($sales)
<div class="table-responsive">
  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>@lang('sharesStatement.modal.createdDate')</th>
        <th>@lang('sharesStatement.id')</th>
        <th>@lang('sharesStatement.amount')</th>
        <th>@lang('sharesStatement.amountLeft')</th>
        <th>@lang('sharesStatement.modal.price')</th>
        <th>@lang('sharesStatement.modal.status')</th>
      </tr>
    </thead>

    <tbody>
      <tr>
        <td>{{ Carbon::createFromFormat('Y-m-d H:i:s', $sales->created_at)->format('Y-m-d') }}</td>
        <td>#{{ $sales->id }}</td>
        <td>{{ number_format($sales->amount, 0) }}</td>
        <td>{{ number_format($sales->amount_left, 0) }}</td>
        <td>{{ number_format($sales->share_price, 3) }}</td>
        <td>@if ($sales->has_process) @lang('sharesStatement.modal.status.complete') @else @lang('sharesStatement.modal.status.queue') @endif</td>
      </tr>
    </tbody>
  </table>
</div>
@endif
