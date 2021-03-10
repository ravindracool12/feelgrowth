<a class="btn btn-warning btn-flat-border" title="Detail" href="{{ route('admin.bonus.edit', ['id' => $data['model']->id, 'type' => $data['type']]) }}">
  <i class="md md-mode-edit"></i> Edit
</a>

<button class="btn btn-delete btn-danger btn-flat-bordered" data-url="{{ route('admin.bonus.remove', ['type' => $data['type'], 'id' => $data['model']->id]) }}">
  <i class="md md-delete"></i> Remove  
</button>
