<a class="btn btn-success btn-flat-border btn-warning" title="Edit" href="{{ route('admin.member.edit', ['id' => $model->member_id]) }}">
  <i class="md md-mode-edit"></i> Edit
</a>

<a class="btn btn-info btn-flat-border" title="Statement" href="{{ route('admin.wallet.statement', ['id' => $model->member_id]) }}">
  <i class="md md-compare"></i> Statement
</a>
