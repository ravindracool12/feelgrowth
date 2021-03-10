<?php
  $route = \Route::currentRouteName();
  if (is_null($route)) $route = 'home';
  if ($route == 'announcement.read' || $route == 'coin.wallet.detail' || $route == 'coin.transaction.detail') {
    $routeEN = route($route, ['lang' => 'en', 'id' => $model->id]);
    $routeCHS = route($route, ['lang' => 'chs', 'id' => $model->id]);
    $routeCHT = route($route, ['lang' => 'cht', 'id' => $model->id]);
  } else {
    $routeEN = route($route, ['lang' => 'en']);
    $routeCHS = route($route, ['lang' => 'chs']);
    $routeCHT = route($route, ['lang' => 'cht']);
  }
?>

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header pull-left">
      <button type="button" class="navbar-toggle pull-left m-15" data-activates=".sidebar"> <span class="sr-only">@lang('common.toggleNav')</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button>
      @yield('breadcrumb')
    </div>
    <ul class="nav navbar-nav navbar-right navbar-right-no-collapse">
      <li class="dropdown pull-right">
        <button class="dropdown-toggle pointer btn btn-round-sm btn-link withoutripple" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="md md-language f20"></i></button>
        <ul class="dropdown-menu">
          <li>
            <a href="{{ $routeEN }}">English</a>
          </li>
          <li>
            <a href="{{ $routeCHS }}">简体中文</a>
          </li>
          <li>
            <a href="{{ $routeCHT }}">繁體中文</a>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</nav>