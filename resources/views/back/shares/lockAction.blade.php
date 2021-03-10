@if (!$model->has_process)
  <button class="btn btn-info btn-flat-border btn-unlock" data-url="{{ route('admin.sharesFreeze.unlock', ['id' => $model->id]) }}">
    <i class="md md-lock-open"></i> Unlock
  </button>
@endif

<button class="btn btn-edit btn-warning btn-flat-bordered" data-url="{{ route('admin.sharesFreeze.update', ['id' => $model->id]) }}">
  <i class="md md-mode-edit"></i> Update
</button>

<button class="btn btn-delete btn-danger btn-flat-bordered" data-url="{{ route('admin.sharesFreeze.remove', ['id' => $model->id]) }}">
  <i class="md md-delete"></i> Remove
</button>
