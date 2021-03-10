<button class="btn btn-edit btn-warning btn-flat-bordered" data-url="{{ route('admin.sharesBuy.update', ['id' => $model->id]) }}">
  <i class="md md-mode-edit"></i> Update
</button>

<button class="btn btn-delete btn-danger btn-flat-bordered" data-url="{{ route('admin.sharesBuy.remove', ['id' => $model->id]) }}">
  <i class="md md-delete"></i> Remove
</button>
