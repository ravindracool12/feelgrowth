<button class="btn btn-info btn-flat-border btn-show" title="{{ \Lang::get('sharesStatement.detail') }}" data-url="{{ route('shares.sell.statement', ['lang' => \App::getLocale(), 'id' => $model->id]) }}" data-toggle="modal" data-target="#showModal">
  <i class="md md-visibility"></i> @lang('sharesStatement.detail')
</button>
