<aside class="sidebar fixed" style="width:260px;left:0px;">
  <div class="brand-logo">
    <div id="logo">
      <img src="{{ asset('assets/img/logo.png') }}" width="100">
    </div>
  </div>

  <div class="user-logged-in">
    <div class="content">
      <div class="user-name">{{ $user->username }} <span class="text-muted f9">@lang('sidebar.memberTopLabel')</span></div>
      <div class="user-email">@lang('sidebar.package') <span style="color:#fff;">Rs {{ number_format($member->package_amount, 0) }}</span></div>
      <div class="user-actions">
        <a class="m-r-5" href="{{ route('settings.account', ['lang' => \App::getLocale()]) }}">@lang('sidebar.settingsTopLabel')</a>
        <a href="{{ route('logout', ['lang' => \App::getLocale()]) }}">@lang('sidebar.logout')</a>
      </div>
    </div>
  </div>

  <ul class="menu-links">
    <li icon="md md-blur-on">
      <a href="{{ route('home', ['lang' => \App::getLocale()]) }}"><i class="md md-blur-on"></i>&nbsp;<span>@lang('sidebar.home')</span></a>
    </li>

    <li>
      <a href="#" data-toggle="collapse" data-target="#MDMember" aria-expanded="false" aria-controls="MDMember" class="collapsible-header waves-effect"><i class="md md-accessibility"></i>&nbsp;@lang('sidebar.registerTitle')</a>
      <ul id="MDMember" class="collapse">
        <li>
          <a href="{{ route('member.register', ['lang' => \App::getLocale()]) }}">
            <span>@lang('sidebar.registerLink1')</span>
          </a>
        </li>
        <li>
          <a href="{{ route('member.registerHistory', ['lang' => \App::getLocale()]) }}">
            <span>@lang('sidebar.registerLink2')</span>
          </a>
        </li>
        <li>
          <a href="{{ route('member.upgrade', ['lang' => \App::getLocale()]) }}">
            <span>@lang('sidebar.registerLink3')</span>
          </a>
        </li>
      </ul>
    </li>

    <li>
      <a href="#" data-toggle="collapse" data-target="#MDSettings" aria-expanded="false" aria-controls="MDSettings" class="collapsible-header waves-effect"><i class="md md-settings"></i>&nbsp;@lang('sidebar.settingsTitle')</a>
      <ul id="MDSettings" class="collapse">
        <li>
          <a href="{{ route('settings.account', ['lang' => \App::getLocale()]) }}">
            <span>@lang('sidebar.settingsLink1')</span>
          </a>
        </li>
        {{-- <li>
          <a href="{{ route('settings.bank', ['lang' => \App::getLocale()]) }}">
            <span>@lang('sidebar.settingsLink2')</span>
          </a>
        </li> --}}
      </ul>
    </li>

    <li>
      <a href="#" data-toggle="collapse" data-target="#MDGenealogy" aria-expanded="false" aria-controls="MDGenealogy" class="collapsible-header waves-effect"><i class="md md-swap-vert"></i>&nbsp;@lang('sidebar.networkTitle')</a>
      <ul id="MDGenealogy" class="collapse">
        <li>
          <a href="{{ route('network.binary', ['lang' => \App::getLocale()]) }}">
            <span>@lang('sidebar.networkLink1')</span>
          </a>
        </li>
        {{-- <li>
          <a href="{{ route('network.unilevel', ['lang' => \App::getLocale()]) }}">
            <span>@lang('sidebar.networkLink2')</span>
          </a>
        </li> --}}
      </ul>
    </li>

    {{-- <li>
      <a href="#" data-toggle="collapse" data-target="#MDTrading" aria-expanded="false" aria-controls="MDTrading" class="collapsible-header waves-effect"><i class="md md-trending-up"></i>&nbsp;@lang('sidebar.sharesTitle')</a>
      <ul id="MDTrading" class="collapse">
        <li>
          <a href="{{ route('shares.market', ['lang' => \App::getLocale()]) }}">
            <span>@lang('sidebar.sharesLink1')</span>
          </a>
        </li>
        <li>
          <a href="{{ route('shares.lock', ['lang' => \App::getLocale()]) }}">
            <span>@lang('sidebar.sharesLink2')</span>
          </a>
        </li>
        <li>
          <a href="{{ route('shares.statement', ['lang' => \App::getLocale()]) }}">
            <span>@lang('sidebar.sharesLink3')</span>
          </a>
        </li>
      </ul>
    </li> --}}

   {{--  <li>
      <a href="#" data-toggle="collapse" data-target="#MDTransaction" aria-expanded="false" aria-controls="MDTransaction" class="collapsible-header waves-effect"><i class="md md-shopping-cart"></i>&nbsp;@lang('sidebar.transactionTitle')</a>
      <ul id="MDTransaction" class="collapse">
        <li>
          <a href="{{ route('transaction.transfer', ['lang' => \App::getLocale()]) }}">
            <span>@lang('sidebar.transactionLink1')</span>
          </a>
        </li>
        <li>
          <a href="{{ route('transaction.withdraw', ['lang' => \App::getLocale()]) }}">
            <span>@lang('sidebar.transactionLink2')</span>
          </a>
        </li>
        <li>
          <a href="{{ route('transaction.statement', ['lang' => \App::getLocale()]) }}">
            <span>@lang('sidebar.transactionLink3')</span>
          </a>
        </li>
      </ul>
    </li>
 --}}
    {{-- <li>
      <a href="#" data-toggle="collapse" data-target="#MDStatement" aria-expanded="false" aria-controls="MDStatement" class="collapsible-header waves-effect"><i class="md md-assessment"></i>&nbsp;@lang('sidebar.statementTitle')</a>
      <ul id="MDStatement" class="collapse">
        <li>
          <a href="{{ route('bonus.statement', ['lang' => \App::getLocale()]) }}">
            <span>@lang('sidebar.statementLink1')</span>
          </a>
        </li>
        <li>
          <a href="{{ route('summary.statement', ['lang' => \App::getLocale()]) }}">
            <span>@lang('sidebar.statementLink2')</span>
          </a>
        </li>
      </ul>
    </li> --}}

    <li>
      <a href="#" data-toggle="collapse" data-target="#MDCoin" aria-expanded="false" aria-controls="MDCoin" class="collapsible-header waves-effect"><i class="md md-album"></i>&nbsp;@lang('sidebar.coinTitle')</a>
      <ul id="MDCoin" class="collapse">
        <li>
          <a href="{{ route('coin.transaction', ['lang' => \App::getLocale()]) }}">
            <span>@lang('sidebar.coinLink1')</span>
          </a>
        </li>
        <li>
          <a href="{{ route('coin.list', ['lang' => \App::getLocale()]) }}">
            <span>@lang('sidebar.coinLink2')</span>
          </a>
        </li>
      </ul>
    </li>

    <?php
      $announcement = \Cache::remember('announcement.new', 60, function () {
        return \App\Models\Announcement::whereRaw('Date(created_at) = CURDATE()')->first();
      });
    ?>
    <li>
      <a href="{{ route('announcement.list', ['lang' => \App::getLocale()]) }}"><i class="md md-new-releases @if ($announcement) sidebar-has-notif @endif"></i>&nbsp;@lang('sidebar.announcementTitle')</a>
    </li>

    <li icon="md md-settings-power">
      <a href="{{ route('logout', ['lang' => \App::getLocale()]) }}"><i class="md md-settings-power"></i>&nbsp;<span>@lang('sidebar.logout')</span></a>
    </li>
  </ul>
</aside>

<aside class="sidebar-toggle hidden-xs hidden-sm">
  <button type="button" class="m-5" id="toggleNav" title="@lang('common.toggleNav')">
    <span class="sr-only">@lang('common.toggleNav')</span>
    <span class="md md-more-vert"></span>
  </button>
</aside>
