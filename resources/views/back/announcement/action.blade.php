<a href="{{ route('admin.announcement.edit', ['id' => $model->id]) }}" class="btn btn-flat-border btn-warning">
  <i class="md md-mode-edit"></i> Edit
</a>

<button class="btn btn-flat-border btn-delete btn-danger" data-url="{{ route('admin.announcement.remove', ['id' => $model->id]) }}">
  <i class="md md-delete"></i> Remove
</button>
