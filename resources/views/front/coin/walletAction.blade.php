<div class="btn-group">
  <button class="btn btn-success btn-flat-border add-address" data-id="{{ $model->id }}">
    <i class="md md-add"></i> @lang('coin.addAddressBtnLbl')  
  </button>

  <a href="{{ route('coin.wallet.detail', ['id' => $model->id, 'lang' => \App::getLocale()]) }}" class="btn btn-info btn-flat-border" target="_blank">
    <i class="md md-visibility"></i> @lang('coin.detailBtnLbl')
  </a>

{{--   <button class="btn btn-danger btn-delete btn-flat-border" data-url="{{ route('coin.wallet.delete', ['id' => $model->id, 'lang' => \App::getLocale()]) }}">
    <i class="md md-delete"></i> @lang('coin.removeBtnLbl')
  </button> --}}
</div>
