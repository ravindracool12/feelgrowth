<aside class="sidebar fixed" style="width:260px;left:0px;">
  <div class="brand-logo">
    <div id="logo">
      <img src="{{ asset('assets/img/logo.png') }}" width="100">
    </div>
  </div>

  <div class="user-logged-in">
    <div class="content">
      <div class="user-name">Admin <span class="text-muted f9">admin</span></div>
      <div class="user-email">admin@email.com</div>
      <div class="user-actions">
        <a class="m-r-5" href="{{ route('admin.settings.account') }}">settings</a>
        <a href="{{ route('admin.logout') }}">logout</a>
      </div>
    </div>
  </div>

  <ul class="menu-links">
    <li icon="md md-blur-on">
      <a href="{{ route('admin.home') }}"><i class="md md-blur-on"></i>&nbsp;<span>Home</span></a>
    </li>

    <li>
      <a href="#" data-toggle="collapse" data-target="#MDSettings" aria-expanded="false" aria-controls="MDSettings" class="collapsible-header waves-effect"><i class="md md-settings"></i>&nbsp;Settings</a>
      <ul id="MDSettings" class="collapse">
        <li>
          <a href="{{ route('admin.settings.account') }}">
            <span>Account Settings</span>
          </a>
        </li>
      </ul>
    </li>

    <li>
      <a href="#" data-toggle="collapse" data-target="#MDMember" aria-expanded="false" aria-controls="MDMember" class="collapsible-header waves-effect"><i class="md md-accessibility"></i>&nbsp;Member</a>
      <ul id="MDMember" class="collapse">
        <li>
          <a href="{{ route('admin.member.register') }}">
            <span>Register ROOT member</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.member.register2') }}">
            <span>Register member</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.member.wallet') }}">
            <span>Wallet List</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.member.list') }}">
            <span>Member List</span>
          </a>
        </li>
      </ul>
    </li>

    <li>
      <a href="#" data-toggle="collapse" data-target="#MDPackage" aria-expanded="false" aria-controls="MDPackage" class="collapsible-header waves-effect"><i class="md md-wallet-giftcard"></i>&nbsp;Package</a>
      <ul id="MDPackage" class="collapse">
        <li>
          <a href="{{ route('admin.settings.package') }}">
            <span>Settings</span>
          </a>
        </li>
      </ul>
    </li>

    <li>
      <a href="#" data-toggle="collapse" data-target="#MDAnnouncement" aria-expanded="false" aria-controls="MDAnnouncement" class="collapsible-header waves-effect"><i class="md md-new-releases"></i>&nbsp;Announcement</a>
      <ul id="MDAnnouncement" class="collapse">
        <li>
          <a href="{{ route('admin.announcement.create') }}">
            <span>Create</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.announcement.list') }}">
            <span>List</span>
          </a>
        </li>
      </ul>
    </li>

    <li>
      <a href="#" data-toggle="collapse" data-target="#MDShares" aria-expanded="false" aria-controls="MDShares" class="collapsible-header waves-effect"><i class="md md-trending-up"></i>&nbsp;Shares</a>
      <ul id="MDShares" class="collapse">
        <li>
          <a href="{{ route('admin.shares.sellAdmin') }}">
            <span>Sell</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.settings.shares') }}">
            <span>Settings</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.shares.split') }}">
            <span>Split</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.shares.buy') }}">
            <span>Buy List</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.shares.sell') }}">
            <span>Sell List</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.shares.lock') }}">
            <span>Freeze List</span>
          </a>
        </li>
      </ul>
    </li>

    <li>
      <a href="#" data-toggle="collapse" data-target="#MDBonus" aria-expanded="false" aria-controls="MDBonus" class="collapsible-header waves-effect"><i class="md md-attach-money"></i>&nbsp;Bonus</a>
      <ul id="MDBonus" class="collapse">
        <li>
          <a href="{{ route('admin.bonus.addStatement') }}">
            <span>Add Statement</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.bonus.all') . '?t=direct' }}">
            <span>Direct Statement</span>
          </a>
        </li>

        <li>
          <a href="{{ route('admin.bonus.all') . '?t=group' }}">
            <span>Group Statement</span>
          </a>
        </li>

        <li>
          <a href="{{ route('admin.bonus.all') . '?t=override' }}">
            <span>Override Statement</span>
          </a>
        </li>

        <li>
          <a href="{{ route('admin.bonus.all') . '?t=pairing' }}">
            <span>Pairing Statement</span>
          </a>
        </li>
      </ul>
    </li>

    <li>
      <a href="#" data-toggle="collapse" data-target="#MDWithdraw" aria-expanded="false" aria-controls="MDWithdraw" class="collapsible-header waves-effect"><i class="md md-assignment-returned"></i>&nbsp;Withdraw</a>
      <ul id="MDWithdraw" class="collapse">
        <li>
          <a href="{{ route('admin.withdraw.addStatement') }}">
            <span>Add Statement</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.withdraw.all') }}">
            <span>Statement</span>
          </a>
        </li>
      </ul>
    </li>

    <li>
      <a href="#" data-toggle="collapse" data-target="#MDTransfer" aria-expanded="false" aria-controls="MDTransfer" class="collapsible-header waves-effect"><i class="md md-swap-vert"></i>&nbsp;Transfer</a>
      <ul id="MDTransfer" class="collapse">
        <li>
          <a href="{{ route('admin.transfer.addStatement') }}">
            <span>Add Statement</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.transfer.all') }}">
            <span>Transfer statement</span>
          </a>
        </li>
      </ul>
    </li>

    <li>
      <a href="#" data-toggle="collapse" data-target="#MDCoin" aria-expanded="false" aria-controls="MDCoin" class="collapsible-header waves-effect"><i class="md md-album"></i>&nbsp;Coin</a>
      <ul id="MDCoin" class="collapse">
        <li>
          <a href="{{ route('admin.coin.transaction') }}">
            <span>Transaction List</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.coin.list') }}">
            <span>Wallet List</span>
          </a>
        </li>
      </ul>
    </li>

    <li icon="md md-settings-power">
      <a href="{{ route('admin.logout') }}"><i class="md md-settings-power"></i>&nbsp;<span>Logout</span></a>
    </li>
  </ul>
</aside>
