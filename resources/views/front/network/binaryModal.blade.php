<?php
  use App\Models\Member;
  use Carbon\Carbon;

  $leftChildren = explode(',', $model->left_children);
  $rightChildren = explode(',', $model->right_children);
  $children = Member::whereIn('id', $leftChildren)
    ->orWhereIn('id', $rightChildren)
    ->get();

  $todayLeft = 0;
  $todayRight = 0;
  $totalLeft = 0;
  $totalRight = 0;

  if (count($children) > 0) {
    $today = Carbon::now()->format('Y-m-d');

    foreach ($children as $child) {
      if (in_array($child->id, $leftChildren)) { // left
        $totalLeft += $child->original_amount;
        if ($child->created_at->format('Y-m-d') == $today) {
          $todayLeft += $child->original_amount;
        }
      } elseif (in_array($child->id, $rightChildren)) { // right
        $totalRight += $child->original_amount;
        if ($child->created_at->format('Y-m-d') == $today) {
          $todayRight += $child->original_amount;
        }
      }
    }
  }
?>

<div class="row">
  <div class="col-md-12">
    <table class="table table-striped table-hover">
      <thead class="theme-text">
        <tr>
          <th colspan="3">@lang('binary.modal.info')</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><strong>@lang('binary.modal.id')</strong></td>
          <td>:</td>
          <td>{{ $model->username }}</td>
        </tr>

        <tr>
          <td><strong>@lang('binary.modal.join')</strong></td>
          <td>:</td>
          <td>{{ $model->created_at->format('d F Y') }}</td>
        </tr>

        <tr>
          <td><strong>@lang('binary.modal.package')</strong></td>
          <td>:</td>
          <td>{{ number_format($model->package_amount) }}</td>
        </tr>

        @if ($direct = $model->direct())
        <tr>
          <td><strong>@lang('binary.modal.sponsor')</strong></td>
          <td>:</td>
          <td>{{ $direct->username }}</td>
        </tr>
        @endif
      </tbody>
    </table>
  </div>

  <div class="col-md-12">
    <table class="table table-striped table-hover">
      <thead class="theme-text">
        <tr>
          <th colspan="3">@lang('binary.modal.info2')</th>
        </tr>
        <tr>
          <th></th>
          <th>@lang('binary.modal.left')</th>
          <th>@lang('binary.modal.right')</th>
        </tr>
      </thead>
      <tr>
        <td><strong>@lang('binary.modal.carry')</strong></td>
        <td>{{ number_format($model->left_total, 0) }}</td>
        <td>{{ number_format($model->right_total, 0) }}</td>
      </tr>

      <tr>
        <td><strong>@lang('binary.modal.today')</strong></td>
        <td>{{ number_format($todayLeft, 0) }}</td>
        <td>{{ number_format($todayRight, 0) }}</td>
      </tr>

      <tr>
        <td><strong>@lang('binary.modal.total')</strong></td>
        <td>{{ number_format($totalLeft, 0) }}</td>
        <td>{{ number_format($totalRight, 0) }}</td>
      </tr>
    </table>
  </div>
</div>
