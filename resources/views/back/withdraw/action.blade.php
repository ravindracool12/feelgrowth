<button class="btn btn-info btn-flat-border btn-show" title="Detail" data-url="{{ route('admin.withdraw.show', ['id' => $model->id]) }}" data-toggle="modal" data-target="#showModal">
  <i class="md md-visibility"></i> Detail
</button>

<a class="btn btn-warning btn-flat-border" title="Detail" href="{{ route('admin.withdraw.edit', ['id' => $model->id]) }}">
  <i class="md md-mode-edit"></i> Edit
</a>

<button class="btn btn-delete btn-danger btn-flat-bordered" data-url="{{ route('coin.wallet.delete', ['id' => $model->id]) }}">
  <i class="md md-delete"></i> Remove  
</button>
