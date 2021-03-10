<button class="btn btn-info btn-flat-border btn-show" data-url="{{ route('coin.transaction.detail', ['id' => $model->id, 'lang' => \App::getLocale()]) }}" data-toggle="modal" data-target="#showModal">
  <i class="md md-visibility"></i> @lang('coin.detailBtnLbl')
</button>
