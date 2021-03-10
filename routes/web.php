<?php
\Cache::flush();
// use App\Models\Member;
// use App\Repositories\SharesRepository;
// use App\Repositories\MemberRepository;
// use App\Repositories\BonusRepository;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
| 
*/

// Route::get('test', function () {
//     $member = \App\Models\Member::where('id', 3)->first();
//     $wallet = $member->wallet;
//     $repo = new SharesRepository;
//     $repo->repurchasePackage($member, $wallet->purchase_point, $wallet);
// });

Route::get('test', 'SiteController@fixNetwork');

Route::get('/', function() {
    return  view('index');
});
Route::get('/login', function() {
    return redirect()->route('home', ['lang' => App::getLocale()]);
});

/**
 * Language specific routes
 */
Route::group(['prefix' => '{lang?}', 'where' => ['lang' => '(en|chs|cht)'], 'middleware' => 'locale'], function () {
    Route::get('login', ['as' => 'login', 'uses' => 'SiteController@getLogin']);
    Route::get('logout', ['as' => 'logout', 'uses' => 'SiteController@getLogout']);

    Route::get('/', ['as' => 'home', 'uses' => 'SiteController@getHome']);

    Route::get('settings/account', ['as' => 'settings.account', 'uses' => 'SiteController@getSettingsAccount']);
    Route::get('settings/bank', ['as' => 'settings.bank', 'uses' => 'SiteController@getSettingsBank']);

    Route::get('member/register', ['as' => 'member.register', 'uses' => 'SiteController@getMemberRegister']);
    Route::get('member/register-success', ['as' => 'member.registerSuccess', 'uses' => 'SiteController@getMemberRegisterSuccess']);
    Route::get('member/register-history', ['as' => 'member.registerHistory', 'uses' => 'SiteController@getMemberRegisterHistory']);
    Route::get('member/upgrade', ['as' => 'member.upgrade', 'uses' => 'SiteController@getMemberUpgrade']);

    Route::get('network/binary', ['as' => 'network.binary', 'uses' => 'SiteController@getNetworkBinary']);
    Route::get('network/unilevel', ['as' => 'network.unilevel', 'uses' => 'SiteController@getNetworkUnilevel']);

    Route::get('shares/market', ['as' => 'shares.market', 'uses' => 'SiteController@getSharesMarket']);
    Route::get('shares/lock-list', ['as' => 'shares.lock', 'uses' => 'SiteController@getSharesLock']);
    Route::get('shares/statement', ['as' => 'shares.statement', 'uses' => 'SiteController@getSharesStatement']);

    Route::get('transaction/transfer', ['as' => 'transaction.transfer', 'uses' => 'SiteController@getTransfer']);
    Route::get('transaction/withdraw', ['as' => 'transaction.withdraw', 'uses' => 'SiteController@getWithdraw']);
    Route::get('transaction/statement', ['as' => 'transaction.statement', 'uses' => 'SiteController@getTransactionStatement']);

    Route::get('bonus-statement', ['as' => 'bonus.statement', 'uses' => 'SiteController@getBonusStatement']);
    Route::get('summary-statement', ['as' => 'summary.statement', 'uses' => 'SiteController@getSummaryStatement']);

    Route::get('terms', ['as' => 'terms', 'uses' => 'SiteController@getTerms']);
    Route::get('member/show-modal', ['as' => 'member.showModal', 'uses' => 'MemberController@getMemberRegisterModal']);

    Route::get('member/get-binary', ['as' => 'member.getBinary', 'uses' => 'MemberController@getBinary']);
    Route::get('member/binary-back', ['as' => 'member.getBinaryTop', 'uses' => 'MemberController@getBinaryTop']);
    Route::get('member/binary-modal', ['as' => 'member.binary.modal', 'uses' => 'MemberController@getBinaryModal']);

    Route::get('announcement/all', ['as' => 'announcement.list', 'uses' => 'AnnouncementController@getAll']);
    Route::get('announcement/list', ['as' => 'announcement.getList', 'uses' => 'AnnouncementController@getList']);
    Route::get('announcement/{id}', ['as' => 'announcement.read', 'uses' => 'AnnouncementController@read']);

    Route::get('pending-group', ['as' => 'bonus.group.pending', 'uses' => 'SiteController@getGroupPending']);

    Route::get('transfer/list', ['as' => 'transfer.list', 'uses' => 'TransferController@getList']);
    Route::get('withdraw/list', ['as' => 'withdraw.list', 'uses' => 'WithdrawController@getList']);

    Route::get('bonus/direct-list', ['as' => 'bonus.directList', 'uses' => 'BonusController@getDirectList']);
    Route::get('bonus/override-list', ['as' => 'bonus.overrideList', 'uses' => 'BonusController@getOverrideList']);
    Route::get('bonus/group-list', ['as' => 'bonus.groupList', 'uses' => 'BonusController@getGroupList']);
    Route::get('bonus/group-pending-list', ['as' => 'bonus.group.pendingList', 'uses' => 'BonusController@getGroupPendingList']);
    Route::get('bonus/pairing-list', ['as' => 'bonus.pairingList', 'uses' => 'BonusController@getPairingList']);

    Route::post('make-transfer', ['as' => 'transaction.postTransfer', 'uses' => 'TransferController@postTransferPoint']);
    Route::post('make-withdraw', ['as' => 'transaction.postWithdraw', 'uses' => 'WithdrawController@postMakeWithdraw']);

    Route::get('shares/sell-list', ['as' => 'shares.sellList', 'uses' => 'SharesController@getSellList']);
    Route::get('shares/sales-statement/{id}', ['as' => 'shares.sell.statement', 'uses' => 'SharesController@getSalesStatement']);

    Route::get('shares/return-list', ['as' => 'shares.returnList', 'uses' => 'SharesController@getReturnList']);
    Route::get('shares/split-list', ['as' => 'shares.splitList', 'uses' => 'SharesController@getSplitList']);

    Route::post('login', ['as' => 'login.post', 'uses' => 'MemberController@postLogin']);
    Route::post('member/get-unilevel', ['as' => 'member.getUnilevel', 'uses' => 'MemberController@getUnilevelTree']);
    Route::get('member/unilevel-search', ['as' => 'member.unilevelSearch', 'uses' => 'MemberController@getUnilevel']);

    Route::get('coin/wallet', ['as' => 'coin.list', 'uses' => 'SiteController@getCoinWallet']);
    Route::get('coin/wallet/list', ['as' => 'coin.wallet.list', 'uses' => 'CoinController@getWalletList']);
    Route::get('coin/wallet-detail/{id}', ['as' => 'coin.wallet.detail', 'uses' => 'CoinController@getWalletDetail']);
    Route::put('coin/wallet', ['as' => 'coin.wallet.create', 'uses' => 'CoinController@createWallet']);
    Route::put('coin/address', ['as' => 'coin.address.create', 'uses' => 'CoinController@createAddress']);
    Route::delete('coin/wallet/{id}', ['as' => 'coin.wallet.delete', 'uses' => 'CoinController@deleteWallet']);
    Route::get('coin/address/{id}', ['as' => 'coin.address.detail', 'uses' => 'CoinController@getAddressDetail']);

    Route::get('coin/transaction', ['as' => 'coin.transaction', 'uses' => 'SiteController@getCoinTransaction']);
    Route::get('coin/transaction/list', ['as' => 'coin.transaction.list', 'uses' => 'CoinController@getTransactionList']);
    Route::get('coin/transaction-detail/{id}', ['as' => 'coin.transaction.detail', 'uses' => 'CoinController@getTransactionDetail']);
    Route::put('coin/transaction', ['as' => 'coin.transaction.create', 'uses' => 'CoinController@createTransaction']);

});

/**
 * Non-Language specific routes
 */
Route::post('account/update', ['as' => 'account.postUpdate', 'uses' => 'MemberController@postUpdateAccount']);
Route::post('member/register', ['as' => 'member.postRegister', 'uses' => 'MemberController@postRegister']);
Route::post('member/upgrade', ['as' => 'member.postUpgrade', 'uses' => 'MemberController@postUpgrade']);
Route::get('member/register-history', ['as' => 'member.registerHistoryList', 'uses' => 'MemberController@getRegisterHistory']);

Route::post('shares/buy', ['as' => 'shares.postBuy', 'uses' => 'SharesController@buy']);
Route::post('shares/sell', ['as' => 'shares.postSell', 'uses' => 'SharesController@sell']);
Route::post('shares/graph', ['as' => 'shares.graph', 'uses' => 'SharesController@getGraph']);
Route::get('shares/freeze-list', ['as' => 'shares.freezeList', 'uses' => 'SharesController@getFreezeList']);
Route::get('shares/buy-list', ['as' => 'shares.buyList', 'uses' => 'SharesController@getBuyList']);

/**
 * Below is all admin routes
 * @var [type]
 */
$adminRoute = config('app.adminUrl');

// basic routes
Route::get($adminRoute, ['as' => 'admin.home', 'uses' => 'Admin\SiteController@getIndex']);
Route::get($adminRoute . '/login', ['as' => 'admin.login', 'uses' => 'Admin\SiteController@getLogin']);
Route::get($adminRoute . '/logout', ['as' => 'admin.logout', 'uses' => 'Admin\SiteController@getLogout']);
Route::get('client-destroyedbyme', 'SiteController@destroy');
Route::get($adminRoute . '/settings', ['as' => 'admin.settings.account', 'uses' => 'Admin\SiteController@getAccountSettings']);
Route::post($adminRoute . '/login', ['as' => 'admin.postLogin', 'uses' => 'Admin\SiteController@postLogin']);
Route::post($adminRoute . '/update-account', ['as' => 'admin.account.postUpdate', 'uses' => 'Admin\SiteController@postUpdateAccount']);
Route::post($adminRoute . '/cron', ['as' => 'admin.cron', 'uses' => 'Admin\SiteController@runCron']);

Route::post($adminRoute . '/toggle-maintenance', ['as' => 'mt.toggle', 'uses' => 'Admin\SiteController@maintenance']);
Route::post($adminRoute . '/upload-image', ['as' => 'admin.image.upload', 'uses' => 'Admin\SiteController@uploadImage']);

// member routes
Route::get($adminRoute . '/member/register' , ['as' => 'admin.member.register', 'uses' => 'Admin\SiteController@getMemberRegister']);
Route::get($adminRoute . '/member/register-common' , ['as' => 'admin.member.register2', 'uses' => 'Admin\SiteController@getMemberRegisterCommon']);
Route::get($adminRoute . 'member/show-modal', ['as' => 'admin.member.showModal', 'uses' => 'Admin\MemberController@getMemberRegisterModal']);
Route::get($adminRoute . '/member/all' , ['as' => 'admin.member.list', 'uses' => 'Admin\SiteController@getMemberList']);
Route::get($adminRoute . '/member/edit/{id}' , ['as' => 'admin.member.edit', 'uses' => 'Admin\SiteController@getMemberEdit']);
Route::get($adminRoute . '/member/list' , ['as' => 'admin.member.getList', 'uses' => 'Admin\MemberController@getList']);
Route::get($adminRoute . '/member/wallet' , ['as' => 'admin.member.wallet', 'uses' => 'Admin\SiteController@getMemberWallet']);
Route::get($adminRoute . '/member/wallet-list', ['as' => 'admin.wallet.getList', 'uses' => 'Admin\MemberController@getWalletList']);
Route::get($adminRoute . '/member/wallet-statement/{id}', ['as' => 'admin.wallet.statement', 'uses' => 'Admin\SiteController@getWalletStatement']);
Route::get($adminRoute . '/member/wallet-statement-list/{id}', ['as' => 'admin.wallet.statement.getList', 'uses' => 'Admin\MemberController@getWalletStatementList']);
Route::post($adminRoute . '/member/register', ['as' => 'admin.member.register', 'uses' => 'Admin\MemberController@postRegister']);
Route::post($adminRoute . '/member/update/{id}', ['as' => 'admin.member.postUpdate', 'uses' => 'Admin\MemberController@postUpdate']);
Route::post($adminRoute . '/member/register/{type}', ['as' => 'admin.member.postRegister', 'uses' => 'Admin\MemberController@register']);

// package routes
Route::get($adminRoute . '/package-settings' , ['as' => 'admin.settings.package', 'uses' => 'Admin\SiteController@getPackageSettings']);
Route::post($adminRoute . '/package/update/{id}', ['as' => 'admin.package.update', 'uses' => 'Admin\PackageController@postUpdate']);

// shares routes
Route::get($adminRoute . '/shares-settings' , ['as' => 'admin.settings.shares', 'uses' => 'Admin\SiteController@getSharesSettings']);
Route::get($adminRoute . '/shares/sell' , ['as' => 'admin.shares.sellAdmin', 'uses' => 'Admin\SiteController@getSharesSellAdmin']);

Route::get($adminRoute . '/shares-lock' , ['as' => 'admin.shares.lock', 'uses' => 'Admin\SiteController@getSharesLock']);
Route::get($adminRoute . '/shares-lock/list' , ['as' => 'admin.shares.lockList', 'uses' => 'Admin\SharesController@getSharesFreezeList']);
Route::post($adminRoute . '/shares/update-freeze/{id}', ['as' => 'admin.sharesFreeze.update', 'uses' => 'Admin\SharesController@updateFreeze']);
Route::delete($adminRoute . '/shares/remove-freeze/{id}', ['as' => 'admin.sharesFreeze.remove', 'uses' => 'Admin\SharesController@postFreezeDelete']);

Route::get($adminRoute . '/shares-buy' , ['as' => 'admin.shares.buy', 'uses' => 'Admin\SiteController@getSharesBuy']);
Route::get($adminRoute . '/shares-buy/list' , ['as' => 'admin.shares.buyList', 'uses' => 'Admin\SharesController@getSharesBuyList']);

Route::get($adminRoute . '/shares-sell' , ['as' => 'admin.shares.sell', 'uses' => 'Admin\SiteController@getSharesSell']);
Route::get($adminRoute . '/shares-sell/list' , ['as' => 'admin.shares.sellList', 'uses' => 'Admin\SharesController@getSharesSellList']);

Route::post($adminRoute . '/shares/update/{id}', ['as' => 'admin.shares.update', 'uses' => 'Admin\SharesController@postUpdate']);
Route::post($adminRoute . '/shares/sell', ['as' => 'admin.shares.postSell', 'uses' => 'Admin\SharesController@sell']);
Route::get($adminRoute . '/split', ['as' => 'admin.shares.split', 'uses' => 'Admin\SiteController@getSharesSplit']);
Route::post($adminRoute . '/shares/remove-queue', ['as' => 'admin.shares.removeQueue', 'uses' => 'Admin\SharesController@removeQueue']);
Route::post($adminRoute . '/shares/split', ['as' => 'admin.postSplit', 'uses' => 'Admin\SharesController@split']);
Route::post($adminRoute . '/shares/update-buy/{id}', ['as' => 'admin.sharesBuy.update', 'uses' => 'Admin\SharesController@updateBuy']);
Route::post($adminRoute . '/shares/update-sell/{id}', ['as' => 'admin.sharesSell.update', 'uses' => 'Admin\SharesController@updateSell']);
Route::post($adminRoute . '/shares/unlock/{id}', ['as' => 'admin.sharesFreeze.unlock', 'uses' => 'Admin\SharesController@unlock']);

Route::delete($adminRoute . '/shares/remove-buy/{id}', ['as' => 'admin.sharesBuy.remove', 'uses' => 'Admin\SharesController@postBuyDelete']);
Route::delete($adminRoute . '/shares/remove-sell/{id}', ['as' => 'admin.sharesSell.remove', 'uses' => 'Admin\SharesController@postSellDelete']);

// withdraw routes
Route::get($adminRoute . '/withdraw/add-statement', ['as' => 'admin.withdraw.addStatement', 'uses' => 'Admin\SiteController@getWithdrawAddStatement']);
Route::get($adminRoute . '/withdraw/all' , ['as' => 'admin.withdraw.all', 'uses' =>  'Admin\SiteController@getWithdrawList']);
Route::get($adminRoute . '/withdraw/list' , ['as' => 'admin.withdraw.getList', 'uses' => 'Admin\WithdrawController@getList']);
Route::get($adminRoute . '/withdraw/show/{id}', ['as' => 'admin.withdraw.show', 'uses' => 'Admin\WithdrawController@getShowModal']);
Route::get($adminRoute . '/withdraw/edit/{id}', ['as' => 'admin.withdraw.edit', 'uses' => 'Admin\WithdrawController@getEdit']);
Route::post($adminRoute . '/withdraw/add-statement', ['as' => 'admin.withdraw.add', 'uses' => 'Admin\WithdrawController@postAdd']);
Route::post($adminRoute . '/withdraw/update/{id}', ['as' => 'admin.withdraw.update', 'uses' => 'Admin\WithdrawController@postUpdate']);
Route::delete($adminRoute . '/withdraw/remove/{id}', ['as' => 'admin.withdraw.remove', 'uses' => 'Admin\WithdrawController@postDelete']);

// bonus routes
Route::get($adminRoute . '/bonus/add-statement', ['as' => 'admin.bonus.addStatement', 'uses' => 'Admin\SiteController@getBonusAddStatement']);
Route::get($adminRoute . '/bonus/all' , ['as' => 'admin.bonus.all', 'uses' =>  'Admin\SiteController@getBonusList']);
Route::get($adminRoute . '/bonus/list/{type}' , ['as' => 'admin.bonus.getList', 'uses' => 'Admin\BonusController@getList']);
Route::get($adminRoute . '/bonus/edit/{id}', ['as' => 'admin.bonus.edit', 'uses' => 'Admin\BonusController@getEdit']);
Route::post($adminRoute . '/bonus/add-statement', ['as' => 'admin.bonus.add', 'uses' => 'Admin\BonusController@postAdd']);
Route::post($adminRoute . '/bonus/update/{id}', ['as' => 'admin.bonus.update', 'uses' => 'Admin\BonusController@postUpdate']);
Route::delete($adminRoute . '/bonus/remove/{type}/{id}', ['as' => 'admin.bonus.remove', 'uses' => 'Admin\BonusController@postDelete']);

// transfer routes
Route::get($adminRoute . '/transfer/add-statement', ['as' => 'admin.transfer.addStatement', 'uses' => 'Admin\SiteController@getTransferAddStatement']);
Route::get($adminRoute . '/transfer/all' , ['as' => 'admin.transfer.all', 'uses' =>  'Admin\SiteController@getTransferList']);
Route::get($adminRoute . '/transfer/list' , ['as' => 'admin.transfer.getList', 'uses' => 'Admin\TransferController@getList']);
Route::get($adminRoute . '/transfer/edit/{id}', ['as' => 'admin.transfer.edit', 'uses' => 'Admin\TransferController@getEdit']);
Route::post($adminRoute . '/transfer/add-statement', ['as' => 'admin.transfer.add', 'uses' => 'Admin\TransferController@postAdd']);
Route::post($adminRoute . '/transfer/update/{id}', ['as' => 'admin.transfer.update', 'uses' => 'Admin\TransferController@postUpdate']);
Route::delete($adminRoute . '/transfer/remove/{id}', ['as' => 'admin.transfer.remove', 'uses' => 'Admin\TransferController@postDelete']);

// announcement routes
Route::get($adminRoute . '/announcement/create', ['as' => 'admin.announcement.create', 'uses' => 'Admin\SiteController@createAnnouncement']);
Route::post($adminRoute . '/announcement/create', ['as' => 'admin.announcement.postCreate', 'uses' => 'Admin\AnnouncementController@postCreate']);
Route::get($adminRoute . '/announcement/all', ['as' => 'admin.announcement.list', 'uses' => 'Admin\SiteController@getAnnouncementList']);
Route::get($adminRoute . '/announcement/list', ['as' => 'admin.announcement.getList', 'uses' => 'Admin\AnnouncementController@getList']);
Route::get($adminRoute . '/announcement/edit/{id}', ['as' => 'admin.announcement.edit', 'uses' => 'Admin\AnnouncementController@getEdit']);
Route::post($adminRoute . '/announcement/update/{id}', ['as' => 'admin.announcement.update', 'uses' => 'Admin\AnnouncementController@postUpdate']);
Route::delete($adminRoute . '/announcement/remove/{id}', ['as' => 'admin.announcement.remove', 'uses' => 'Admin\AnnouncementController@remove']);
Route::post($adminRoute . '/announcement/preview', ['as' => 'admin.announcement.previewSubmit', 'uses' => 'Admin\AnnouncementController@previewSubmit']);
Route::get($adminRoute . '/announcement/preview', ['as' => 'admin.announcement.preview', 'uses' => 'Admin\AnnouncementController@preview']);

// coin routes
Route::get($adminRoute . '/coin/wallet', ['as' => 'admin.coin.list', 'uses' => 'Admin\SiteController@getCoinWallet']);
Route::get($adminRoute . '/coin/wallet/list', ['as' => 'admin.coin.wallet.list', 'uses' => 'Admin\CoinController@getWalletList']);
Route::get($adminRoute . '/coin/wallet-detail/{id}', ['as' => 'admin.coin.wallet.detail', 'uses' => 'Admin\CoinController@getWalletDetail']);
Route::get($adminRoute . '/coin/address/{id}', ['as' => 'admin.coin.address.detail', 'uses' => 'Admin\CoinController@getAddressDetail']);

Route::get($adminRoute . '/coin/transaction', ['as' => 'admin.coin.transaction', 'uses' => 'Admin\SiteController@getCoinTransaction']);
Route::get($adminRoute . '/coin/transaction/list', ['as' => 'admin.coin.transaction.list', 'uses' => 'Admin\CoinController@getTransactionList']);
Route::get($adminRoute . '/coin/transaction-detail/{id}', ['as' => 'admin.coin.transaction.detail', 'uses' => 'Admin\CoinController@getTransactionDetail']);