@if (!$model)
  <div class="alert alert-danger">
    @lang('register.modal.notFound')
  </div>
@else
  <div class="table-responsive">
    <table class="table table-hover table-striped">
      <tr>
        <td class="theme-text">@lang('register.modal.username')</td>
        <td>:</td>
        <td>{{ $model->username }}</td>
      </tr>

      <tr>
        <td class="theme-text">@lang('register.modal.name')</td>
        <td>:</td>
        <td>{{ $model->user->first_name }}</td>
      </tr>

      <tr>
        <td class="theme-text">@lang('register.modal.join')</td>
        <td>:</td>
        <td>{{ $model->created_at->format('d F Y') }}</td>
      </tr>
    </table>
  </div>
@endif