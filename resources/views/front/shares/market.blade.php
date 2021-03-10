<?php
  use App\Repositories\SharesRepository;
  use Carbon\Carbon;
  $repo = new SharesRepository;
  $state = $repo->getCurrentShareState();
  $lastUpdate = Carbon::createFromFormat('Y-m-d H:i:s', $state->updated_at);
  // $today = $repo->getTodaySales(true);
  $buyPrices = $repo->getAvailableBuyPrice();
?>

@extends('front.app')

@section('title')
  @lang('sharesMarket.title') | {{ config('app.name') }}
@stop

@section('breadcrumb')
  <ul class="breadcrumb">
    <li><a href="#">@lang('breadcrumbs.front')</a></li>
    <li><a href="{{ route('home', ['lang' => \App::getLocale()]) }}">@lang('breadcrumbs.dashboard')</a></li>
    <li class="active">@lang('breadcrumbs.sharesMarket')</li>
  </ul>
@stop

@section('content')
  <main>
    @include('front.include.sidebar')
    <div class="main-container">
      @include('front.include.header')
      <div class="main-content" autoscroll="true" bs-affix-target="" init-ripples="" style="">
        <section>
          <div class="page-header">
            <h1><i class="md md-trending-up"></i> @lang('sharesMarket.title')</h1>
          </div>

          <div class="row m-b-40">
            <div class="col-md-4">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h2 class="panel-title grey-text">@lang('common.currentShareTitle')</h2>
                  <h1 class="m-t-10 m-b-5 f30">{{ number_format($state->current_price, 3) }}</h1>
                  <div class="row">
                    <div class="col-xs-6">
                      <div class="progress m-b-5">
                        <div class="progress-bar" style="width: 100%;"></div>
                      </div>
                    </div>
                  </div>
                  <p class="small grey-text no-margin">
                    @lang('common.lastDate'): {{ date('d') . ' ' . date('F') . ' ' . date('Y') }}
                  </p>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h2 class="panel-title grey-text">@lang('sharesMarket.next')</h2>
                  <?php $next = $state->raise_limit - $state->current_accumulate; ?>
                  <h1 class="m-t-10 m-b-5 f30">{{ substr($next, -3) }}</h1>
                  <div class="row">
                    <div class="col-xs-6">
                      <div class="progress m-b-5">
                        <?php $percent = ($state->current_accumulate / $state->raise_limit) * 100; ?>
                        <div class="progress-bar" style="width:{{ $percent }}%;"></div>
                      </div>
                    </div>
                  </div>
                  <p class="small grey-text no-margin">
                    @lang('common.shares')
                  </p>
                </div>
              </div>
            </div>

            {{-- <div class="col-md-4">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h2 class="panel-title grey-text">@lang('sharesMarket.today')</h2>
                  <h1 class="m-t-10 m-b-5 f30">{{ number_format($today, 0) }}</h1>
                  <div class="row">
                    <div class="col-xs-6">
                      <div class="progress m-b-5">
                        <div class="progress-bar" style="width: 100%;"></div>
                      </div>
                    </div>
                  </div>
                  <p class="small grey-text no-margin">
                    @lang('common.shares')
                  </p>
                </div>
              </div>
            </div> --}}
          </div>

          <div class="row m-b-40">
            <div class="col-md-4">
              <div class="card small">
                <div class="purple p-10">
                  <div class="pull-right">
                    <div> <i class="md md-trending-up text-rgb-5"></i></div>
                  </div>
                  <h4 class="no-margin white-text w600">@lang('sharesMarket.sales')</h4>
                  <div class="f11" style="opacity:0.8"> <i class="md md-av-timer"></i> {{ $lastUpdate->format('d F H:i') }} </div>
                  <div class="p-10 p-t-30">
                    <div id="chart-shares" data-url="{{ route('shares.graph') }}"></div>
                  </div>
                </div>
                <div class="card-content p-10">
                  <div class="row">
                    <div class="col-md-6 text-center" style="border-right: 1px #F0F0F0 solid;">
                      <h3 class="no-margin w300" id="sharesTotalSales"></h3>
                      <p class="grey-text w600">@lang('sharesMarket.totalSales')</p>
                    </div>
                    <div class="col-md-6 text-center">
                      <h3 class="no-margin w300 theme-text">{{ number_format($member->shares->amount, 0) }}</h3>
                      <p class="grey-text w600">@lang('sharesMarket.current')</p>
                    </div>
                  </div>
                </div>
                <div class="card-footer p-10">
                  <div class="row">
                    <div class="col-md-12">
                      <p>@lang('sharesMarket.searchPrice')</p>
                      <form role="form" onsubmit="return false;" id="refreshGraphForm">
                        <div class="input-group">
                          <select class="form-control" name="search_from1">
                            @for ($i=0.1; $i<=0.9; $i+=0.1)
                              <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                          </select>
                          <span class="input-group-addon">+</span>
                          <select class="form-control" name="search_from2">
                            @foreach (range(0, 99) as $i)
                              <?php $j = str_pad($i, 2, '0',  STR_PAD_LEFT); ?>
                              <option value="{{ $j }}">{{ $j }}</option>
                            @endforeach
                          </select>
                        </div>

                        <div class="form-group m-t-10">
                          <button type="submit" id="refreshGraphBtn" class="btn btn-primary">
                            <span class="btn-preloader">
                              <i class="md md-cached md-spin"></i>
                            </span>
                            <span><i class="md md-search"></i> Search</span>
                          </button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h2 class="panel-title grey-text">@lang('sharesMarket.buy')</h2>
                </div>

                <div class="panel-body">
                  @if (count($buyPrices) > 0)
                    <form role="form" onsubmit="return false;" data-parsley-validate class="action-form shares-form" id="sharesBuyForm" http-type="post" data-url="{{ route('shares.postBuy') }}">
                      <fieldset>
                        <div class="form-group">
                          <label class="control-label">@lang('sharesMarket.price')</label>
                          <select class="form-control" name="price" required="">
                            @if (count($buyPrices) > 0)
                              @foreach ($buyPrices as $price)
                                <?php $price['price'] = number_format($price['price'], 3); ?>
                                <option value="{{ $price['price'] }}">{{ $price['price'] }}</option>
                              @endforeach
                            @endif
                          </select>
                        </div>

                        <div class="form-group">
                          <label class="control-label">@lang('sharesMarket.quantity')</label>
                          <input type="number" min="10" class="form-control" required="" name="quantity" value="10" max="1000">
                          <span class="help-block">@lang('sharesMarket.quantityNotice')</span>
                        </div>

                        <div class="form-group">
                          <label class="control-label">@lang('sharesMarket.total')</label>
                          <h3 class="theme-text no-m-t">$&nbsp;<span class="total-text">0</span></h3>
                        </div>

                        <div class="form-group">
                          <label class="control-label">@lang('sharesMarket.security')</label>
                          <input type="password" name="s" class="form-control" required="">
                        </div>

                        <div class="form-group">
                          <button type="submit" class="btn btn-primary">
                            <span class="btn-preloader">
                              <i class="md md-cached md-spin"></i>
                            </span>
                            <span>@lang('common.submit')</span>
                          </button>
                          <button type="reset" class="btn btn-default">@lang('common.cancel')</button>
                        </div>
                      </fieldset>
                    </form>
                  @else
                    <div class="alert alert-warning">
                      @lang('sharesMarket.noBuy')
                    </div>
                  @endif
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h2 class="panel-title grey-text">@lang('sharesMarket.sell')</h2>
                </div>

                <div class="panel-body">
                  <form role="form" onsubmit="return false;" data-parsley-validate class="action-form shares-form" id="sharesSellForm" http-type="post" data-url="{{ route('shares.postSell') }}">
                    <fieldset>
                      <div class="form-group">
                        <label class="control-label">@lang('sharesMarket.price')</label>
                        <select class="form-control" name="price" required="">
                          <?php
                            $current = number_format($state->current_price, 3);
                            $min = $current - 0.003;
                            if ($min < $state->minimum_price) $min = number_format($state->minimum_price, 3);
                            $max = $current + 0.003;
                          ?>
                          @for ($i=$min; $i<=$max; $i+=0.001)
                            <option value="{{ $i }}">{{ $i }}</option>
                          @endfor
                        </select>
                      </div>

                      <div class="form-group">
                        <label class="control-label">@lang('sharesMarket.quantity')</label>
                        <input type="number" min="10" max="{{ (float) $member->package_amount }}" class="form-control" required="" name="quantity" value="10">
                        <span class="help-block">@lang('sharesMarket.quantityNotice')</span>
                      </div>

                      <div class="form-group">
                        <label class="control-label">@lang('sharesMarket.total')</label>
                        <h3 class="theme-text no-m-t">$&nbsp;<span class="total-text">0</span></h3>
                      </div>

                      <div class="form-group">
                        <label class="control-label">@lang('sharesMarket.netTotal')</label>
                        <h3 class="theme-text no-m-t">$&nbsp;<span class="net-total-text">0</span></h3>
                      </div>

                      <div class="form-group">
                        <label class="control-label">@lang('sharesMarket.security')</label>
                        <input type="password" name="s" class="form-control" required="">
                      </div>

                      <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                          <span class="btn-preloader">
                            <i class="md md-cached md-spin"></i>
                          </span>
                          <span>@lang('common.submit')</span>
                        </button>
                        <button type="reset" class="btn btn-default">@lang('common.cancel')</button>
                      </div>
                    </fieldset>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </main>
@stop
