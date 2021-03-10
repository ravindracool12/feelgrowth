<a class="btn btn-warning btn-flat-border" title="Detail" href="{{ route('admin.transfer.edit', ['id' => $model->id]) }}">
  <i class="md md-mode-edit"></i> Edit
</a>

<button class="btn btn-delete btn-danger btn-flat-bordered" data-url="{{ route('admin.withdraw.remove', ['id' => $model->id]) }}">
  <i class="md md-delete"></i> Remove  
</button>
